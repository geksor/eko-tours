<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => '/',
    'components' => [
        'view' => [
            'class' => 'frontend\components\View',
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/tury' => 'tours/index',
                '/kontakty' => 'site/about',

                '/tours/booking' => 'tours/booking',
                '/api/rooms' => 'tours/rooms',
                '/tours/<category>' => 'tours/index',
                '/tours/<category>/<alias>' => 'tours/view',
                '/tours/<category>/<alias>/<id>_<period_id>_<date_from>_<date_to>' => 'tours/room',

                '<controller:tours>' => 'tours/index',
                '<controller:accom>' => 'accom/index',


                '/' => 'site/index',
                '<action:\w+>' => 'site/<action>',
            ],
        ],
    ],
    'params' => $params,
    'language' => 'ru-RU',
];
