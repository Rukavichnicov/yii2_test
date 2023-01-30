### Установка проекта через докер

Запустите установку

    docker-compose run --rm php composer install    
    
Запустите контейнер

    docker-compose up -d
    
Сайт можно запустить по URL:

    http://127.0.0.1:80

Конфигурация
-------------

### Database

Отредактируйте файл `config/db.php` например:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=db;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
Если вы хотите чтобы создались фиктивные данные перед выполнением
миграции раскомментируйте
```php
$this->insertFakeUsers();
файл m230127_171113_create_user.php
```

Запустите миграции следующими командами:

```php
docker compose run --rm php bash
yii migrate
```

