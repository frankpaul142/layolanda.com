<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'es',
    'timeZone' => 'America/Guayaquil',
    'components' => [
            'urlManager' => [
          'showScriptName' => false,
          'enablePrettyUrl' => true,
        ], 
        'formatter' => [
          
            'decimalSeparator' => "&",
            //'numberFormatterOptions' => [2],
            'thousandSeparator' => '',
            'currencyCode' => 'USD',
       ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fapa1411',
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'my_application_cart',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
                        'transport' => [
            'class' => 'Swift_SmtpTransport',
            // 'host' => 'mail.layolanda.com',
            // 'username' => 'info@layolanda.com',
            // 'password' => 'Layoli8485',
            'host' => 'localhost',
            'username' => '',
            'password' => '',
            'port' => '25'
            // 'encryption' => 'tls',
        ],
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
        'db' => require(__DIR__ . '/db.php'),
            'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\DbMessageSource',
                'db' => 'db',
                'sourceLanguage' => 'es_ES', // Developer language
                'sourceMessageTable' => '{{%language_source}}',
                'messageTable' => '{{%language_translate}}',
                'cachingDuration' => 86400,
                'enableCaching' => false,

            ],
        ],
    ],
       'translatemanager' => [
        'class' => 'lajax\translatemanager\Component'
    ]
    ],
    'params' => $params,
        'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout'=>'admin',
        ],
           'seo' => [
            'class' => 'linchpinstudios\seo\Module',
            // 'layout'=>'admin',
        ],
                   'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ],
      'translatemanager' => [
        'class' => 'lajax\translatemanager\Module',
        'scanRootParentDirectory' => false,
        'roles' => ['@'],
        'allowedIPs' => ['127.0.0.1','181.39.219.202','186.4.200.137','186.4.200.137','186.101.142.211','181.196.52.127','181.175.253.167','190.152.204.138','186.46.207.9','190.152.204.201','181.113.99.89'],
    ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
   

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
