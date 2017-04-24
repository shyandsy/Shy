<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/30/2017
 * Time: 02:22
 */

namespace Shy\Library\Cache;

interface ICache
{
    public function open($config);
    public function get($key);
    public function set($key, $value);
    public function expire($key, $timeout = 3600);
}