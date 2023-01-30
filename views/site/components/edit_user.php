<div class="modal fade" id="edit_user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Редактирование пользователя</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post" enctype="multipart/form-data" id="edit_user_form" novalidate>
                <input type="hidden" name="id" id="pid">
                <div class="modal-body p-5">
                    <div class="mb-3">
                        <label for="name">Имя пользователя</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        <div class="invalid-feedback">Имя пользователя обязательное поле для заполнения</div>
                    </div>
                    <div class="mb-3">
                        <label for="surname">Фамилия пользователя</label>
                        <input type="text" name="surname" id="surname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image">Изображение пользователя</label>
                        <input type="file" accept=".jpg, .jpeg, .png" name="image" id="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" id="edit_user_btn">Обновить данные</button>
                </div>
            </form>
        </div>
    </div>
</div>