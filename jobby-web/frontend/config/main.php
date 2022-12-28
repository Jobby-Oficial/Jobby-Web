<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'jobby-frontend',
    'name' => 'Jobby',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'modules' => [
        'imagemanager' => [
            'class' => 'noam148\imagemanager\Module',
            //set accces rules ()
            'canUploadImage' => true,
            'canRemoveImage' => function(){
                return true;
            },
            //add css files (to use in media manage selector iframe)
            'cssFiles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
            ],
        ],
    ],
    'components' => [
        'stripe' => [
            'class' => 'ruskid\stripe\Stripe',
            'publicKey' => "pk_test_51MEWfnFthQJvgqebbhoYd6WVBaTVKHajb8ybomDEuPXUwMusCaS7FBZWYBowZTfYsX5c3KctzQyI3ZiFKGlXHnZL001ErGWk1O",
            'privateKey' => "sk_test_51MEWfnFthQJvgqeb8M25raRvAwOZMln5zwSbOPjQyRy729EBN3palSsC0caDkqKNIJH3Q5wau9H52pKmFnKcE6Ig00uzxlpdzf",
        ],
        'imagemanager' => [
            'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
            //set media path (outside the web folder is possible)
            'mediaPath' => 'assets/img/media/imagemanager',
            //path relative web folder to store the cache images
            'cachePath' => 'assets/images',
            //use filename (seo friendly) for resized images else use a hash
            'useFilename' => true,
            //show full url (for example in case of a API)
            'absoluteUrl' => false,
        ],
        'request' => [
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
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailtrap.io',
                'username' => 'c526b0bf8b16a6',
                'password' => '858d9b024841ba',
                'port' => '2525',
                'encryption' => 'tls',
            ],
            'useFileTransport' => false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/login' => 'site/login',
                '/logout' => 'site/logout',
                '/services' => 'service/index',
                '/privacy' => 'site/privacy',
                '/terms' => 'site/terms',
                '/profile/<id:\d+>' => 'user/view',
                '/service/<id:\d+>' => 'service/view',
                '/support' => 'site/support',
                '/favorite' => 'site/create-favorite',
                '/favorite/<id:\d+>' => 'site/delete-favorite',
                '/plan' => 'plan/index',
            ],
        ],
    ],
    'params' => $params,
];
