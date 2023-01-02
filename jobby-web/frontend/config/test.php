<?php
$config =  yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    [
        'id' => 'app-frontend-tests',
        'components' => [
            'assetManager' => [
                'basePath' => __DIR__ . '/../web/assets',
            ],
            'urlManager' => [
                'showScriptName' => true,
            ],
            'request' => [
                'cookieValidationKey' => 'test',
            ],
            'mailer' => [
                'messageClass' => \yii\symfonymailer\Message::class
            ],
            'db' => [
                'class' => \yii\db\Connection::class,
                'dsn' => 'mysql:host=localhost;dbname=jobby',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ]
        ]
    ]
);
return $config;
//return [
//    'id' => 'app-frontend-tests',
//    'components' => [
//        'assetManager' => [
//            'basePath' => __DIR__ . '/../web/assets',
//        ],
//        'urlManager' => [
//            'showScriptName' => true,
//        ],
//        'request' => [
//            'cookieValidationKey' => 'test',
//        ],
//        'mailer' => [
//            'messageClass' => \yii\symfonymailer\Message::class
//        ],
//        'db' => [
//            'class' => \yii\db\Connection::class,
//            'dsn' => 'mysql:host=localhost;dbname=jobby',
//            'username' => 'root',
//            'password' => '',
//            'charset' => 'utf8',
//        ]
//    ],
//];
