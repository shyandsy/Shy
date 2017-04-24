<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 22:33
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require dirname(__DIR__) . '/framework/Shy.php';
require __DIR__ . '/config.php';

$app = Shy\Application::getInstance();
$app->run($config);