<div class="modal fade" id="add_user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Добавить пользователя</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post" enctype="multipart/form-data" id="add_user_form" novalidate>
                <div class="modal-body p-5">
                    <div class="mb-3">
                        <label for="name_add">Имя пользователя</label>
                        <input type="text" id="name_add" name="name" class="form-control" placeholder="Василий" required>
                        <div class="invalid-feedback">Имя пользователя обязательное поле для заполнения</div>
                    </div>

                    <div class="mb-3">
                        <label for="surname_add">Фамилия пользователя</label>
                        <input type="text" name="surname" id="surname_add" class="form-control" placeholder="Иванов">
                    </div>

                    <div class="mb-3">
                        <label for="password_add">Пароль</label>
                        <input type="password" name="password" id="password_add" class="form-control" required>
                        <div class="invalid-feedback">Пароль обязательное поле для заполнения</div>
                    </div>

                    <div class="mb-3">
                        <label for="password_repeat_add">Повторите пароль</label>
                        <input type="password" name="password_repeat" id="password_repeat_add" class="form-control" required>
                        <div class="invalid-feedback">Пароль обязательное поле для заполнения</div>
                    </div>

                    <div class="mb-3">
                        <label for="image_add">Изображение пользователя</label>
                        <input type="file" accept=".jpg, .jpeg, .png" name="image" id="image_add" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" id="add_user_btn">Добавить пользователя</button>
                </div>
            </form>
        </div>
    </div>
</div>