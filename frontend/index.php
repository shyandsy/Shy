<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 22:33
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/framework/shycart.php';
require __DIR__ . '/config.php';


$app = Application::getInstance();
ShyCart::$app = $app;
$app->run($config);