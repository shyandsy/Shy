<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/27/2017
 * Time: 00:22
 */
namespace Controller\Common;

use Base\Controller;
use \ShyCart;
class ControllerCommonHome extends Controller
{
    public function index()
    {
        $data['title'] = "title";
        ShyCart::$app->log->error("error");

        //test session
        if(ShyCart::$app->session->xx === null)
            ShyCart::$app->session->xx = "aaaa";
        else
            echo ShyCart::$app->session->xx;

        echo ShyCart::$app->config->get("site_url");

        $this->render("common/home.html", $data);
    }
}