<?php

use yii\console\Application as consoleApplication;
use yii\web\Application as webApplication;
use yii\web\User;

class Yii {
    public static consoleApplication|__Application|webApplication $app;
}

/**
 * @property yii\rbac\DbManager $authManager
 * @property User|__WebUser $user
 */
class __Application { }

/**
 * @property \uzdevid\dashboard\models\User $identity
 */
class __WebUser { }
