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
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=jobby',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ]
        ]
    ]
);
return $config;

/*return [
    'id' => 'app-backend-tests',
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
    ],
];*/
