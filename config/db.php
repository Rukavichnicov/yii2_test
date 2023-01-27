<?php

return [
    'class' => 'yii\db\Connection',
    // для того чтобы работала база из docker используют название имени контейнера БД
    // для того чтобы подключится из вне используют localhost
    'dsn' => 'mysql:host=db;dbname=yii2basic',
    'username' => 'yii2',
    'password' => 'password',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
