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
    'defaultRoute' => 'site/index',
    'components' => [
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
            // 'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'WwM2vRgv723fUcxibOnG',
            'csrfParam' => '_frontendCSRF',
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
                'login'                                     => 'auth/index',
                'search'                                    => 'search/index',
                'contact'                                   => 'contact/index',
                'account'                                   => 'account/index',
                'category/<cats:(.*)>/<subcategory:(.*)>'   => 'category/index',
                'category/<cats:(.*)>'                      => 'category/index/',
                'product/<slug:(.*)>'                       => 'product/index/',
                'checkout'                                  => 'cart/checkout',
                'cart/voucher'                              => 'cart/voucher',
                'cart/destroy'                              => 'cart/destroy',
                'cart/delete/<item:(.*)>'                   => 'cart/delete',
                'cart/update/<item:(.*)>/<qty:(.*)>'        => 'cart/update',
                'cart/add/<item:(.*)>/<qty:(.*)>'           => 'cart/add',
                'cart/add/<item:(.*)>'                      => 'cart/add',
                'cart/add/'                                 => 'cart/add',
                'cart/'                                     => 'cart/index',
                'cart'                                      => 'cart/index',
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // 'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '', // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => '',
                'password' => '',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
            // 'viewPath' => 'app/view/layouts/mail',
            'useFileTransport' => false,
        ], 
        
    ],
    'params' => $params,
];
