<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/27/2017
 * Time: 07:47
 */

namespace Library;

use Base\Object;

class Config extends Object
{
    private $config;

    public function set(string $key, $value)
    {
        $this->config[$key] = $value;
    }

    public function get(string $key)
    {
        return isset($this->config[$key]) ? $this->config[$key] : null;
    }

    public function has(string $key)
    {
        return isset($this->config[$key]);
    }
}