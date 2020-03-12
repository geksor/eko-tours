<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/jquery-ui.css',
        'public/css/style.css',
        'public/css/nap.css',
        'public/css/mobile.css',
        'public/css/jquery.fancybox.min.css',
        'public/css/owl.carousel.min.css',
        'public/js/air-datepicker/css/datepicker.min.css',
    ];
    public $js = [
        'public/js/slideout.js',
        'public/js/owl.carousel.min.js',
        'public/js/jquery.fancybox.min.js',
        'public/js/modernizr.custom.js',
        'public/js/classie.js',
        'public/js/modalEffects.js',
        'public/js/air-datepicker/js/datepicker.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
    ];
}
