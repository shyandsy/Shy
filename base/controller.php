<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 22:33
 */
namespace Base;

use Base\Object;
use Library\Service;

class Controller extends Object
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}