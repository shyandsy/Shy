<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 22:33
 */
namespace Base;

use Base\Object;
use Exception\ShyCartException;
use ShyCart;

class Controller extends Object
{
    public function render($templateName, array $parameters = array())
    {
        if (\ShyCart::$app->getTemplateEngine() === "twig")
        {
            echo ShyCart::$app->twig->render($templateName, $parameters);
        }
        else
        {
            throw new ShyCartException("invalid template engine!");
        }
    }
}