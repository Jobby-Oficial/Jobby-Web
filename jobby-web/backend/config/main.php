<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\Module',
        ],
    ],
    'components' => [
        /*'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
                ],
            ],
        ],*/
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
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
                '/' => 'site/index',
                '/login' => 'site/login',

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/guests',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST register' => 'register',
                        'POST login' => 'login',
                        'GET services' => 'get-services',
                        'GET services-gallery' => 'get-services-gallery'
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/users',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'PUT {id}/update-user' => 'update-user'
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/services',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST detail' => 'get-service-from-user-id',
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/favorites',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST detail' => 'get-favorite-from-user-id',
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/jobs-status',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    /* 'extraPatterns' => [
                        'POST detail' => 'get-favorite-from-user-id',
                    ], */

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/schedules',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST client' => 'get-schedules-from-client-id',
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/services-gallery',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    /* 'extraPatterns' => [
                        'POST detail' => 'get-favorite-from-user-id',
                    ], */

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/plans',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    /*'extraPatterns' => [
                        'GET users' => 'users',
                    ],*/

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/avaliations',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST client' => 'get-avaliations-from-user-id',
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/reports',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    /*'extraPatterns' => [
                        'GET users' => 'users',
                    ],*/

                ],
            ],
        ],
    ],
    'params' => $params,
];
