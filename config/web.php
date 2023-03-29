<?php

use uzdevid\dashboard\models\User;
use uzdevid\dashboard\Module as SystemModule;
use uzdevid\dashboard\modules\api\Module as SystemAPIModule;
use codemix\localeurls\UrlManager;

$config = [
    'id' => 'dashboard',
    'name' => 'Dashboard',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Tashkent',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@uploadsDir' => '@app/web'
    ],
    'layoutPath' => '@vendor/uzdevid/yii2-dashboard/views/layouts',
    'modules' => [
        'system' => [
            'class' => SystemModule::class,
            'modules' => [
                'api' => [
                    'class' => SystemAPIModule::class,
                    'components' => [
                        'request' => [
                            'class' => 'yii\web\Request',
                            'enableCookieValidation' => false,
                            'parsers' => [
                                'application/json' => 'yii\web\JsonParser',
                                'application/xml' => 'yii\web\XmlParser'
                            ]
                        ],
                        'response' => [
                            'class' => 'yii\web\Response',
                            'formatters' => [
                                'json' => [
                                    'class' => 'yii\web\JsonResponseFormatter',
                                    'prettyPrint' => YII_DEBUG,
                                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ],
    ],
    'components' => [
        'db' => require __DIR__ . '/database/system.php',
        'request' => [
            'enableCsrfValidation' => false,
            'cookieValidationKey' => 'kvYpAoXKhEZsdKNqlgdw2uxcwRW8u3t6f',
            'baseUrl' => '',
        ],
        'mailer' => require __DIR__ . '/mailer.php',
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
            'loginUrl' => ['/system/login'],
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.Y',
            'datetimeFormat' => 'HH:i d.MM.Y',
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
                    'sourceMessageTable' => '{{%yii_source_message}}',
                    'messageTable' => '{{%yii_message}}',
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
            'on languageChanged' => 'app\models\system\User::languageChanged',
            'rules' => [
                '/<menu:\d+>/<module>/<controller>/<action>' => '<module>/<controller>/<action>',
                '/<menu:\d+>/<controller>/<action>' => '<controller>/<action>',
                '/<menu:\d+>/<controller>' => '<controller>',
                '/<menu:\d+>' => 'site/index',
            ],
        ],
    ],
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
