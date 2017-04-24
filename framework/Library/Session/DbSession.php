<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 03:00
 */

namespace Shy\Library\Session;
use Shy\Exception\ShyException;

class DbSession implements \SessionHandlerInterface
{
    public function open($save_path, $name)
    {
        throw new ShyException();
    }

    public function close()
    {
        throw new ShyException();
    }

    public function read($session_id)
    {
        throw new ShyException();
    }

    public function write($session_id, $session_data)
    {
        throw new ShyException();
    }

    public function destroy($session_id)
    {
        throw new ShyException();
    }

    public function gc($maxlifetime)
    {
        throw new ShyException();
    }
}