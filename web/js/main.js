$(function () {
    // fetch all users ajax request
    fetchAllUsers();

    function fetchAllUsers() {
        let elementList = document.querySelector('.pageactive');
        let elementLink = elementList.getElementsByClassName('page-link');
        let href = elementLink[0].getAttribute('href');
        let getParam = href.substring(10);

        $.ajax({
            url: '/users' + getParam,
            method: 'get',
            success: function (response) {
                $('#table_users').append(`
                  <tbody id="table_body">${response['users'].map(function (n) {
                        if (n.image != null) {
                            n.image = `<img class="img-fluid" src="${'/uploads/images/users/' + n.image}" width="250" alt="${'Картинка пользователя с id' + n.id}">`;
                        } else {
                            n.image = ''
                        }
                        return `
                    <tr>
                      <td>${n.id}</td>
                      <td>${n.name}</td>
                      <td>${n.surname}</td>
                      <td>
                        ${n.image}
                      </td>
                      <td>
                      <a href="#" id="${n.id}"
                       data-bs-toggle="modal"
                        data-bs-target="#edit_user_modal"
                         class="btn btn-success btn-sm user_edit_btn">Редактировать</a>
                         </td>

                      <td>
                      <a href="#" id="${n.id}" class="btn btn-danger btn-sm user_delete_btn">Удалить</a>
                      </td>

                    </tr>`
                    }
                ).join('')}
                  </tbody>
                `);
            }
        });
    }

    // add new user ajax request
    $("#add_user_form").submit(function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('was-validated');
        } else {
            $.ajax({
                url: '/users',
                method: 'post',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.error) {

                    } else {
                        $("#add_user_modal").modal('hide');
                        $("#add_user_form")[0].reset();
                        $("#image").removeClass('is-invalid');
                        $("#image").next().text('');
                        $("#add_user_form").removeClass('was-validated');
                        Swal.fire(
                            'Добавлено',
                            response.message,
                            'success'
                        );
                        $('.modal-backdrop').remove();
                        let el = document.getElementById('table_body');
                        el.remove();
                        fetchAllUsers();
                    }
                }
            });
        }
    });

    // edit user ajax request
    $(document).delegate('.user_edit_btn', 'click', function (e) {
        e.preventDefault();
        const id = $(this).attr('id');
        $.ajax({
            url: '/users/' + id,
            method: 'get',
            success: function (response) {
                $("#pid").val(response.id);
                $("#name").val(response.name);
                $("#surname").val(response.surname);
            }
        });
    });

    // update user ajax request
    $("#edit_user_form").submit(function (e) {
        e.preventDefault();
        const id = $("#pid").attr('value');
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('was-validated');
        } else {
            $.ajax({
                url: '/users/' + id,
                method: 'post',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    $("#edit_user_modal").modal('hide');
                    Swal.fire(
                        'Updated',
                        response.message,
                        'success'
                    );
                    $('.modal-backdrop').remove();
                    let el = document.getElementById('table_body');
                    el.remove();
                    fetchAllUsers();
                }
            });
        }
    });

    // delete user ajax request
    $(document).delegate('.user_delete_btn', 'click', function (e) {
        e.preventDefault();
        const id = $(this).attr('id');
        Swal.fire({
            title: 'Вы дейстительно хотите удалить пользователя с id: ' + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да, удалить!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/users/' + id,
                    method: 'delete',
                    success: function (response) {
                        let el = document.getElementById('table_body');
                        el.remove();
                        fetchAllUsers();
                    }
                });
            }
        })
    });
});