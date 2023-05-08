<?php

return [
    'db' => require __DIR__ . '/../database/system.php',
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'formatter' => [
        'timeZone' => 'Asia/Tashkent',
        'dateFormat' => 'dd.MM.Y',
        'datetimeFormat' => 'HH:i d.MM.Y',
        'timeFormat' => 'HH:i',
    ],
    'log' => [
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
];