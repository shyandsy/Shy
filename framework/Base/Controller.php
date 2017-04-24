<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 22:33
 */
namespace Shy\Base;
use Shy\Exception\ShyCartException;

class Controller extends Object
{
    public function render($templateName, array $parameters = array())
    {
        if (\Shy::$app->getTemplateEngine() === "twig")
        {
            echo \Shy::$app->twig->render($templateName, $parameters);
        }
        else
        {
            throw new ShyCartException("invalid template engine!");
        }
    }
}