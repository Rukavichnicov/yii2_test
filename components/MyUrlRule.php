<?php

namespace app\components;

use yii\rest\UrlRule;

class MyUrlRule extends UrlRule
{
    public $patterns = [
        'PUT,PATCH,POST {id}' => 'update',
        'DELETE {id}' => 'delete',
        'GET,HEAD {id}' => 'view',
        'POST' => 'create',
        'GET,HEAD' => 'index',
        '{id}' => 'options',
        '' => 'options',
    ];
}
