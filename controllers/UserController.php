<?php

namespace app\controllers;


use app\models\User;
use yii\data\Pagination;
use yii\db\StaleObjectException;
use yii\rest\Controller;

class UserController extends Controller
{
    public $modelClass = 'app\models\User';

    public function actionIndex()
    {
        $models = User::find();
        $pagination = new Pagination([
            'totalCount' => $models->count(),
            'pageSize' => 10,
        ]);
        $users = $models->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return [
            'users' => $users,
            'pagination' => $pagination,
        ];
    }

    public function actionCreate()
    {
        $model = new User();
        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->validate()) {
            if ($model->hasUploadedFile()) {
                if ($model->validateUploadedFile()) {
                    $model->image = $model->upload();
                } else {
                    return ['error' => ['image' => 'Загружаемый файл должен быть картинкой, размером не более 10 МB']];
                }
            }
            $model->save();
            return ['message' => "Пользователь успешно создан"];
        } else {
            $errors = $model->errors;
            return ['error' => $errors];
        }
    }

    /**
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $model = User::findOne($id);

        if ($model->hasImage()) {
            $model->deleteImageFromStorage();
        }

        if (!$model->delete()) {
            return ['error' => "Ошибка удаления записи с id $id"];
        }

        return ['message' => "success"];
    }
}