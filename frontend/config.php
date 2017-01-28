<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/27/2017
 * Time: 01:33
 */

$config = [
    "base_dir" => __DIR__,                      //项目根目录
    "viewCacheDir" => __DIR__ . "/view-cache",  //项目view-cache
    "debug" => true,
    "db" => [
        "DB_DRIVER" => "mysql",
        "DB_HOST" => "192.168.216.133",
        "DB_DATABASE" => "shycart",
        "DB_USERNAME" => "shycart",
        "DB_PASSWORD" => "bEWaAG6ahyb1bzz1BotD",
    ],
    "templateEngine" => "twig"
];