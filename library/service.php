<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 23:24
 */

namespace Library;

use Base\Object;

class Service extends Object
{
    private $components = [];

    public function register(string $name, object $component)
    {
        $this->components[$name] = $component;
    }

    public function resolve(string $name)
    {
        return $this->components[$name];
    }
}