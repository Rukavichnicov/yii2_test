<?php

namespace app\controllers;


use app\models\User;
use Yii;
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

    public function actionView($id)
    {
        $model = User::findOne($id);

        if ($model === null) {
            return ['error' => "Пользователь с id $id не найден"];
        }

        return $model;
    }

    public function actionCreate()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_CREATE;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->validate()) {
            if ($model->hasUploadedFile()) {
                $model->image = $model->saveImageInStorage();
            }
            $model->save(false);
            return ['message' => "Пользователь успешно создан"];
        } else {
            $errors = $model->errors;
            return ['error' => $errors];
        }
    }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        $model->scenario = User::SCENARIO_UPDATE;
        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->validate()) {
            if ($model->hasUploadedFile()) {
                if ($model->hasImage()) {
                    $model->deleteImageFromStorage();
                }
                $model->image = $model->saveImageInStorage();
            }
            $model->save(false);
            return ['message' => "Пользователь успешно обновлен"];
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

        if (!$model->delete()) {
            return ['error' => "Ошибка удаления записи с id $id"];
        }
        if ($model->hasImage()) {
            $model->deleteImageFromStorage();
        }

        return ['message' => "success"];
    }

    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH', 'POST'],
            'delete' => ['DELETE'],
        ];
    }

}