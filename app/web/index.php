<?php

// Определение корневой директории вашего приложения
$rootDir = dirname(__DIR__);

// Подключение автозагрузчика Composer
require($rootDir . '/vendor/autoload.php');

// Подключение файла с настройками приложения
$config = require($rootDir . '/app/config/main.php');

// Создание экземпляра приложения Yii2 и его запуск
(new yii\web\Application($config))->run();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>TestGLOBALPAS</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Тестовое задание.">
    <meta name="keywords" content="Тест, Test">
    <meta name="author" content="Avezov Say">
    <link rel="icon" href="images/favicon.png">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicon.png">
    <meta property="og:url" content="">
    <meta property="og:title" content="TestGLOBALPAS">
    <meta property="og:description" content="Тестовое задание.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#D1823B">
    <meta name="msapplication-TileImage" content="images/favicon.png">
  </head>
  <body>
    <p>BACK</>p
  </body>
</html>