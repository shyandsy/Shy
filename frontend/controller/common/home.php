<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/27/2017
 * Time: 00:22
 */
namespace Controller\Common;
use Shy\Base\Controller;

class ControllerCommonHome extends Controller
{
    public function index()
    {
        $data['title'] = "title";
        \Shy::$app->log->error("error information");
        \Shy::$app->log->fatal("fatal information");
        \Shy::$app->log->warn("warn information");
        \Shy::$app->log->info("info information");
        \Shy::$app->log->debug("debug information");
        \Shy::$app->log->trace("trace information");

        //test session
        if(\Shy::$app->session->xx === null)
            \Shy::$app->session->xx = "123455xsahduahduashdu<br>";
        else
            echo \Shy::$app->session->xx . "<br>";

        echo \Shy::$app->config->get("site_url") . "<br>";
        echo \Shy::$app->request->get('o') . "<br>";

        $this->render("common/home.html", $data);
    }
}