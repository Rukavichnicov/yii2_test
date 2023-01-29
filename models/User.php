<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Url;

class User extends ActiveRecord
{
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return '{{user}}';
    }

    public function fields(): array
    {
        return ['id', 'name', 'surname', 'image'];
    }

    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Пожалуйста введите имя пользователя'],
            ['password', 'required', 'message' => 'Пожалуйста введите пароль'],
            ['password_repeat', 'required', 'message' => 'Пожалуйста введите повтор пароля'],

            ['password', 'compare', 'compareAttribute' => 'password_repeat', 'message' => 'Пароль и его повтор должны совпадать'],

            ['name', 'string', 'max' => 100, 'message' => 'Имя должно быть строкой не более 100 символов'],
            ['surname', 'string', 'max' => 100, 'message' => 'Фамилия должна быть строкой не более 100 символов'],
            ['password', 'string', 'max' => 100, 'message' => 'Пароль должен быть строкой не более 100 символов'],
            ['password_repeat', 'string', 'max' => 100, 'message' => 'Повтор пароля должен быть строкой не более 100 символов'],

            [['image'], 'image', 'maxSize' => 1024 * 1024 * 10, 'message' => 'Загружаемый файл должен быть картинкой, размером не более 10 МB'],

            ['surname', 'default', 'value' => null],
            [['name', 'surname'], 'trim'],
        ];
    }
}
