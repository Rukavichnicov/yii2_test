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
<?php //$this->registerJsFile('@web/js/main.js',
//    ['depends' => [\yii\web\JqueryAsset::class]]) ?>