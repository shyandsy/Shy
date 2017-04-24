<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/29/2017
 * Time: 12:24
 */
namespace Shy\Exception;

class InvalidConfigException extends ShyException
{
    public function __construct()
    {
        parent::__construct("invalid configuration");
    }
}