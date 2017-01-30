<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 02:56
 */
namespace Library\Log;

interface ILog
{
    public function open($log_config);
    public function close();
    public function fatal($message);
    public function error($message);
    public function warn($message);
    public function info($message);
    public function debug($message);
    public function trace($message);
}