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
}
