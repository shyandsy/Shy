<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/30/2017
 * Time: 02:32
 */

namespace Shy\Library\Cache;

class FileCache extends Object implements ICache
{
    private $directory;
    private $expire;

    /*
     * $config['type'] file
     * $config['directory'] the path of cache directory
     * $config['expire'] expire time
     */
    public function open($config)
    {
        $this->directory = $config['path'];
        $this->expire = $config['expire'];
        /*
        if(isset($config['path']))
        {
            $this->file = @fopen($config['path'], 'a');
            if(!$this->file)
            {
                throw new InvalidConfigException();
            }
        }
        else
        {
            throw new InvalidConfigException();
        }
        */
    }

    public function get($key)
    {
        $filename = $this->directory . "/cache_" . $key;
    }

    public function set($key, $value)
    {
        $filename = $this->directory . "/cache_" . $key;
    }

    public function expire($key, $timeout = 3600)
    {
        // TODO: Implement expire() method.
    }
}