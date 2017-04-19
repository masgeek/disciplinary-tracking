<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/oracle_conn.php');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'en', //allows for translation,
    'aliases' => [
        '@bower' => 'vendor/bower-asset',
    ],
    'modules' => [
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            'maxAge' => 'debug',
            'accessRoles' => ['admin'],
            'trackActions' => ['*'],
            // Actions to ignore. '*' is allowed as the last character to use as wildcard (eg 'debug/*')
            'ignoreActions' => ['audit/*', 'debug/*'],
            'accessIps' => ['127.0.0.1', '192.168.*'],
            // Role or list of roles with access to the viewer, null for everyone (if the user matches)
            //'accessRoles' => ['admin'],
            // User ID or list of user IDs with access to the viewer, null for everyone (if the role matches)
            'accessUsers' => [1, 2, 200, 100],
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'tracking' => [
            'class' => 'app\modules\tracking\tracker',

        ],
        'setups' => [
            'class' => 'app\modules\setup\setups',
        ],
        'report' => [
            'class' => 'app\modules\reporting\report',
            'defaultRoute' => 'report/report-case', //default controller
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DDihOSMwiDx4wt5-vW9v7a3eSgOGwlen',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\USER',
            'enableAutoLogin' => true,
            //'authTimeout' => 400,
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'writeCallback' => function ($session) {
                return [
                    'user_id' => \Yii::$app->user->identity->username,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'is_trusted' => $session->get('is_trusted', false),
                ];
            },
            'timeout' => 60 * 60 * 24 * 7, // 1 weeks
            'sessionTable' => 'DT_YII_SESSION',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'formatter' => [
            'dateFormat' => 'dd/MMM/yyyy',
            'timeFormat' => 'h:mm:ss a',
            'datetimeFormat' => 'dd/MMM/yyyy H:mm:ss',
            //'defaultTimeZone'=>'America/Chicago'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,//YII_DEBUG ? true : false,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '.html',
            'rules' => [
                //default rules

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                //custom rules
                '/' => 'site/index',
                'index' => 'site/index',
                'discipline' => 'disciplinarytype/index',
                'casetypes' => 'casetype/index',
                'incident' => 'report/report/report-case',
                'first-case' => 'report/report/first-case',
                'first-office' => 'report/progress/first-office',
                'student-info' => 'tracking/ajax/student-details'

            ],
        ]


    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '41.89.65.170', '41.89.65.87'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '41.89.65.170', '41.89.65.87'],
        'generators' => [
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => ['mymodel' => '@app/mygenerators/model/beforesave']
            ]
        ]
    ];
}

return $config;
