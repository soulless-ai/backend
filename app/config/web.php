<?php
return [
    'id' => 'yii2-app-advanced',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'corsFilter' => [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'OPTIONS', 'DELETE'],
                'Access-Control-Allow-Credentials' => false
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
        ],
        'response' => [
            'class' => 'yii\web\Response',
        ],
        'session' => [
            'name' => 'advanced-yii2-app-advanced',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logFile' => '@runtime/logs/app.log', 
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routes.php'), 
        ],
        'queue' => [
            'class' => 'yii\queue\file-queue\FileQueue',
            'path' => '@runtime/queue',
        ],
    ],
];