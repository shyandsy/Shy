<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 23:23
 */

namespace Shy\Library;

use Shy\Base\Object;

class Response extends Object
{
    private $headers = [];
    private $output = "";

    //private $compress;

    public function addHeader(string $key, string $value)
    {
        $this->headers[$key] = $value;
    }

    public function setOutput(string $output)
    {
        $this->output = $output;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}