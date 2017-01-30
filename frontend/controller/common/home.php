<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/27/2017
 * Time: 00:22
 */
namespace Controller\Common;

use Base\Controller;

class ControllerCommonHome extends Controller
{
    public function index()
    {
        $data['title'] = "title";
        $this->log->error("error");

        //test session
        if($this->session->xx === null)
            $this->session->xx = "aaaa";
        else
            echo $this->session->xx;

        echo $this->config->get("site_url");

        $this->render("common/home.html", $data);
    }
}