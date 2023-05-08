<?php

use codemix\localeurls\UrlManager;
use uzdevid\dashboard\models\User;

return [
    'db' => require __DIR__ . '/../database/system.php',
    'request' => [
        'enableCsrfValidation' => false,
        'cookieValidationKey' => 'kvYpAoXKhEZsdKNqlgdw2uxcwRW8u3t6f',
        'baseUrl' => '',
    ],
    'mailer' => require __DIR__ . '/../mailer.php',
    'user' => [
        'identityClass' => User::class,
        'enableAutoLogin' => true,
        'loginUrl' => ['/system/login'],
    ],
    'formatter' => [
        'timeZone' => 'Asia/Tashkent',
        'dateFormat' => 'dd.MM.Y',
        'datetimeFormat' => 'HH:i d.MM.Y',
        'timeFormat' => 'HH:i',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\DbMessageSource',
                'sourceMessageTable' => '{{%source_message}}',
                'messageTable' => '{{%message}}',
                'enableCaching' => false,
                'cachingDuration' => 3600,
                'forceTranslation' => true,
            ],
        ],
    ],
    'urlManager' => [
        'class' => UrlManager::class,
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'languages' => ['uz', 'ru', 'en'],
        'enableDefaultLanguageUrlCode' => true,
        'on languageChanged' => 'uzdevid\dashboard\models\User::languageChanged',
        'rules' => [
            '/<menu:\d+>/<module>/<controller>/<action>' => '<module>/<controller>/<action>',
            '/<menu:\d+>/<controller>/<action>' => '<controller>/<action>',
            '/<menu:\d+>/<controller>' => '<controller>',
            '/<menu:\d+>' => 'site/index',
        ],
    ]
];