<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/30/2017
 * Time: 02:17
 */

namespace Shy\Library;
use Shy\Base\Object;
use Shy\Exception\InvalidConfigException;
use Shy\Library\Cache\FileCache;

class Cache extends Object
{
    private static $cache = null;
    private $adapter;

    private function __construct()
    {
    }

    public function getInstance($config)
    {
        if(self::$cache === null)
        {
            self::$cache = new Cache();
            if($config['type'] === "file")
            {
                self::$cache->adapter = new FileCache($config);
            }
            else
            {
                throw new InvalidConfigException();
            }
        }
        return self::$cache;
    }
}