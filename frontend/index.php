<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 22:33
 */
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/framework/shycart.php';
require __DIR__ . '/config.php';


$app = Application::getInstance();
$app->run($config);