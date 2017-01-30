<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 03:58
 */

namespace Library;

use Library\Log\FileLog;

/*
 * information:
 *  call stack
 *  context
 *  error postion, file and line
 * log level:
 *  FATAL
 *  ERROR
 *  WARN
 *  INFO
 *  DEBUG
 *  TRACE
 */

class Log
{
    private static $logger = null;

    private function __construct()
    {
    }

    public static function getInstance($config)
    {
        if (self::$logger == null)
        {
            if($config['type'] === 'file'){
                self::$logger = new FileLog();
                self::$logger->open($config);
            }else{
                throw new InvalidConfigException();
            }
        }
        return self::$logger;
    }

    public function fatal()
    {
        self::$logger->fatal();
    }

    public function error()
    {
        self::$logger->error();
    }

    public function warn()
    {
        self::$logger->warn();
    }

    public function info()
    {
        self::$logger->info();
    }

    public function debug()
    {
        self::$logger->debug();
    }

    public function trace()
    {
        self::$logger->trace();
    }
}