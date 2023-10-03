<?php

// Определение корневой директории вашего приложения
$rootDir = dirname(__DIR__);

// Подключение автозагрузчика Composer
require($rootDir . '/vendor/autoload.php');

// Подключение файла с настройками приложения
$config = require($rootDir . '/app/config/main.php');

// Создание экземпляра приложения Yii2 и его запуск
(new yii\web\Application($config))->run();