<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$_ENV['SYSTEM_DB_HOST']};dbname={$_ENV['SYSTEM_DB_NAME']}",
    'username' => $_ENV['SYSTEM_DB_USER'],
    'password' => $_ENV['SYSTEM_DB_PASS'],
    'charset' => 'utf8mb4',
];
