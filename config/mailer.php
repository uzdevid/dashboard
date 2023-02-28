<?php

use yii\symfonymailer\Mailer;

return [
    'class' => Mailer::class,
    'useFileTransport' => false,
    'viewPath' => '@app/mail',
    'transport' => [
        'scheme' => 'smtps',
        'host' => $_ENV['MAILER_HOST'],
        'username' => $_ENV['MAILER_USER'],
        'password' => $_ENV['MAILER_PASS'],
        'port' => $_ENV['MAILER_PORT'],
        'dsn' => $_ENV['MAILER_DSN'],
    ],
];