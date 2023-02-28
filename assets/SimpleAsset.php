<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SimpleAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/vendor/bootstrap/css/bootstrap.min.css',
        '/vendor/bootstrap-icons/bootstrap-icons.css',
        '/css/dashboard.css',
        '/css/main.css',
    ];
    public $js = [
        '/vendor/bootstrap/js/bootstrap.bundle.min.js',
        '/vendor/tinymce/tinymce.min.js',
        '/js/dashboard.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}