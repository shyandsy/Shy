<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/29/2017
 * Time: 12:24
 */
namespace Shy\Exception;

use Shy\Base\Object;

class ShyException extends \Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getName()
    {
        return "Exception";
    }
}