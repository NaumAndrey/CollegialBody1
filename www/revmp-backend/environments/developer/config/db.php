<?php /** @noinspection ClassConstantCanBeUsedInspection */

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=127.0.0.1;dbname=revmp', // заменить название БД
    'username' => 'postgres',                     // указать пользователя
    'password' => 'postgres',                     // указать пароль
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];