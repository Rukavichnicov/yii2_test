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
});