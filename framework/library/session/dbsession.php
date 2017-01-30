<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 03:00
 */

namespace Library\Session;


use Exception\ShyCartException;

class DbSession implements \SessionHandlerInterface
{
    public function open($save_path, $name)
    {
        throw new ShyCartException();
    }

    public function close()
    {
        throw new ShyCartException();
    }

    public function read($session_id)
    {
        throw new ShyCartException();
    }

    public function write($session_id, $session_data)
    {
        throw new ShyCartException();
    }

    public function destroy($session_id)
    {
        throw new ShyCartException();
    }

    public function gc($maxlifetime)
    {
        throw new ShyCartException();
    }
}