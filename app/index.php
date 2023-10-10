<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
// Определение корневой директории вашего приложения
$rootDir = dirname(__DIR__);

// Подключение автозагрузчика Composer
require($rootDir . '/vendor/autoload.php');
require($rootDir . '/vendor/yiisoft/yii2/Yii.php');

// Подключение файла с настройками приложения
$config = require($rootDir . '/app/config/web.php');

// Создание экземпляра приложения Yii2 и его запуск
(new yii\web\Application($config))->run();