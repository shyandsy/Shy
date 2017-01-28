<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 23:23
 */

namespace Library;

use Base\Object;

class Request extends Object
{
    private $get = [];
    private $post = [];
    private $files = [];
    private $server = [];

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->server = $_SERVER;
    }

    public function get($name)
    {
        return isset($this->get[$name]) ? $this->get[$name] : null;
    }

    public function post($name)
    {
        return isset($this->post[$name]) ? $this->post[$name] : null;
    }

    public function files($name)
    {
        return isset($this->files[$name]) ? $this->files[$name] : null;
    }

    public function server($name)
    {
        return isset($this->server[$name]) ? $this->server[$name] : null;
    }
}