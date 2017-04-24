<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 03:00
 */

namespace Shy\Library\Session;

class FileSession implements \SessionHandlerInterface
{
    private $save_path;

    public function open($save_path, $session_name)
    {echo "111";
        $this->save_path = $save_path;
        if (!is_dir($this->save_path)) {
            mkdir($this->save_path, 0777);
        }

        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($session_id)
    {
        return (string)@file_get_contents("$this->save_path/sess_$session_id");
    }

    public function write($session_id, $session_data)
    {
        return file_put_contents("$this->save_path/sess_$session_id", $session_data) === false ? false : true;
    }

    public function destroy($session_id)
    {
        $file = "$this->save_path/sess_$session_id";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }

    public function gc($max_life_time)
    {
        foreach (glob("$this->save_path/sess_*") as $file) {
            if (filemtime($file) + $max_life_time < time() && file_exists($file)) {
                unlink($file);
            }
        }

        return true;
    }
}