<?php

$config = [
    'id' => 'dashboard-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@uzdevid' => '@vendor/uzdevid',
        '@npm' => '@vendor/npm-asset'
    ],
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@yii/i18n/migrations',
                '@uzdevid/yii2-dashboard/migrations',
                '@uzdevid/yii2-dashboard-access-control/migrations',
                '@uzdevid/yii2-dashboard-modify-log/migrations',
            ],
        ],
    ],
    'components' => require __DIR__ . '/components/console.php',
    'params' => require __DIR__ . '/params/console.php',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
