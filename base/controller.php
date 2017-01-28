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

    public function render($templateName, array $parameters = array())
    {
        if (\ShyCart::$app->getTemplateEngine() === "twig") {
            $twig = $this->service->resolve("twig");
            echo $twig->render($templateName, $parameters);
        } else {
            throw new \Exception("invalid template engine!");
        }

    }
}