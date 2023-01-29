<!-- add new user modal start -->
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
                        <label>Имя пользователя</label>
                        <input type="text" name="name" class="form-control" placeholder="Василий" required>
                        <div class="invalid-feedback">Имя пользователя обязательное поле для заполнения</div>
                    </div>

                    <div class="mb-3">
                        <label>Фамилия пользователя</label>
                        <input type="text" name="surname" class="form-control" placeholder="Иванов">
                    </div>

                    <div class="mb-3">
                        <label>Пароль</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="invalid-feedback">Пароль обязательное поле для заполнения</div>
                    </div>

                    <div class="mb-3">
                        <label>Повторите пароль</label>
                        <input type="password" name="password_repeat" class="form-control" required>
                        <div class="invalid-feedback">Пароль обязательное поле для заполнения</div>
                    </div>

                    <div class="mb-3">
                        <label>Изображение пользователя</label>
                        <input type="file" accept=".jpg, .jpeg, .png" name="image" id="image" class="form-control">
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
<!-- add new user modal end -->

<div class="container">
    <div class="row my-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="text-secondary fw-bold fs-3">Все пользователи</div>
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_user_modal">Создать пользователя
                    </button>
                </div>
                <div class="card-body">
                    <div class="row" id="show_users">
                        <table id="table_users" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Картинка</th>
                                    <th>Редактировать</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $this->registerJsFile('@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::class]]) ?>