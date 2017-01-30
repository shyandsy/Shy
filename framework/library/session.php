<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 02:51
 */

namespace Library;
use Illuminate\Support\Facades\File;
use Library\Session\FileSession;

class Session
{
    private static $session = null;

    private function __construct()
    {
    }

    public static function getInstance($session_config)
    {
        if(self::$session == null)
        {
            if($session_config['type'] === 'file')
            {
                self::$session = new Session($session_config);
                session_set_save_handler(new FileSession(), true);
                session_save_path($session_config['path']);
            }
            else
            {
                throw new InvalidConfigException();
            }
        }
        return self::$session;
    }

    public function start()
    {
        session_start();
    }

    public function getId()
    {
        return session_id();
    }

    public function __get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function __set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}