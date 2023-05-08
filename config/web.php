<?php

$config = [
    'id' => 'dashboard',
    'name' => 'Dashboard',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Tashkent',
    'aliases' => [
        '@uzdevid' => '@vendor/uzdevid',
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@uploadsDir' => '@app/web'
    ],
    'layoutPath' => '@vendor/uzdevid/yii2-dashboard/views/layouts',
    'modules' => require __DIR__ . '/modules.php',
    'components' => require __DIR__ . '/components/web.php',
    'params' => require __DIR__ . '/params/web.php',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
