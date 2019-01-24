<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@uploads'   => '@frontend/web/uploads',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'yandexMapsApi' => [
            'class' => 'mirocow\yandexmaps\Api',
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'ru-RU',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'Europe/Moscow',
        ],
    ],
    'modules' => [
        'stat' => [
            'class' => akiraz2\stat\Module::className(),
            'ownStat' => true, //false by default
            'ownStatCookieId' => 'yii2_counter_id', // 'yii2_counter_id' default
            'onlyGuestUsers' => false, // true default
            'countBot' => false, // false default
            'appId' => ['app-frontend'], // by default count visits only from Frontend App (in backend app we dont need it)
            'blackIpList' => [] // ['127.0.0.1'] by default
        ],
    ],
];
