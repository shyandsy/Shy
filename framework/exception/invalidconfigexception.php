<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/29/2017
 * Time: 12:24
 */
namespace Exception;
use Exception\ShyCartException;

class InvalidConfigException extends ShyCartException
{
    public function __construct()
    {
        parent::__construct("invalid configuration");
    }
}