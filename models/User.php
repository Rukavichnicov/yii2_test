<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class User extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    private const PATH_USERS_IMAGES = 'uploads/images/users/';
    public $password_repeat;
    private $uploadeFile;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->uploadeFile = UploadedFile::getInstanceByName("image");
    }

    public static function tableName()
    {
        return '{{user}}';
    }

    public function fields(): array
    {
        return ['id', 'name', 'surname', 'image'];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[static::SCENARIO_CREATE] = ['id', 'name', 'surname', 'image', 'password_repeat'];
        $scenarios[static::SCENARIO_UPDATE] = ['name', 'surname', 'image'];
        return $scenarios;
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

//            Почему то не работает при отправке файлов через ajax
            ['image', 'file', 'mimeTypes' => 'image/*', 'maxSize' => 1024 * 1024 * 10, 'message' => 'Загружаемый файл должен быть картинкой, размером не более 10 МB'],

            ['surname', 'default', 'value' => null],
            [['name', 'surname'], 'trim'],
            ['password', 'trim'],
        ];
    }

    public function hasUploadedFile()
    {
        return !empty($this->uploadeFile);
    }

    public function validateUploadedFile()
    {
        if ($this->hasUploadedFile()) {
            $upload = $this->uploadeFile;
            $rightType = ($upload->type == 'image/jpeg' || $upload->type == 'image/png' || $upload->type == 'gif');
            $rightSize = $upload->size < 1024 * 1024 * 10;
            if ($rightType && $rightSize) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }

    }

    public function upload()
    {
        $upload = $this->uploadeFile;
        $fileName = $this->createNameUploadedFile($upload->extension);
        $upload->saveAs(self::PATH_USERS_IMAGES . $fileName);
        return $fileName;
    }

    public function createNameUploadedFile(string $extension)
    {
        $fileName = uniqid() . '.' . $extension;
        return $fileName;
    }

    public function deleteImageFromStorage()
    {
        unlink(\Yii::$app->basePath . '/web/' . self::PATH_USERS_IMAGES . $this->image);
    }

    public function hasImage(): bool
    {
        return !empty($this->image);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            }
            return true;
        } else {
            return false;
        }
    }
}
