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
    /*
     * 当没有debug设置时，debug默认设置为false
     */
    "debug" => true,
    /*
     * database配置
     *  DB_DRIVER:数据库驱动
     *  DB_HOST:数据库地址
     *  DB_DATABASE:数据库
     *  DB_USERNAME:用户名
     *  DB_PASSWORD:密码
     */
    "db" => [
        "DB_DRIVER" => "mysql",
        "DB_HOST" => "192.168.216.133",
        "DB_DATABASE" => "shycart",
        "DB_USERNAME" => "shycart",
        "DB_PASSWORD" => "bEWaAG6ahyb1bzz1BotD",
    ],
    "templateEngine" => "twig",
    "log" => [
        "type" => "file",
        "path" => __DIR__ . "/error.log"
    ],
    "session" => [
        "type" => "file",
        "path" => dirname(__DIR__) . "/tmp/session_folder"
    ]
];