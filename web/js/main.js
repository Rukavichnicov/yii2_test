$(function () {
    // fetch all users ajax request
    fetchAllUsers();

    function fetchAllUsers() {
        $.ajax({
            url: '/users',
            method: 'get',
            success: function (response) {
                $('#table_users').append(`
                  <tbody id="table_body">${response['users'].map(n => `
                    <tr>
                      <td>${n.id}</td>
                      <td>${n.name}</td>
                      <td>${n.surname}</td>
                      <td>
                        <img src="${+n.image}">
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

                    </tr>`).join('')}
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
                $("#name").val(response.name);
                $("#surname").val(response.surname);
            }
        });
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