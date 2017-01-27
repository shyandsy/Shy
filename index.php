<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 22:33
 */


use Library\Service;
use Library\Request;
use Library\Response;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Application
{

    private static $app = null;
    private $service = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$app === null) {
            self::$app = new Application();
        }
        return self::$app;
    }


    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        echo "error<br>";
    }

    public static function autoloader($class)
    {
        $path = str_replace("\\", "/", $class);
        $path = __DIR__ . "/" . strtolower($path) . ".php";

        if (file_exists($path)) {
            include_once($path);
        } else {
            echo $path . " does not exists";
        }
    }

    public static function exception_handler($exception)
    {
        echo "exception<br>";
        var_dump($exception);
        echo "Uncaught exception: ", $exception->getMessage(), "\n";
    }

    public function run()
    {
        //auto loader
        spl_autoload_register("Application::autoloader");

        //error handler
        //set_error_handler("Application::errorHandler", E_ALL ^ E_NOTICE);

        //exception handler
        //set_exception_handler("Application::exception_handler");

        //create service
        $this->service = new Service();

        //register component
        $this->service->register("request", new Request());
        $this->service->register("response", new Response());

        //execute controller
        $request = $this->service->resolve("request");
        $route = $request->get("route");

        if ($route == null) { //default home page
            $file = __DIR__ . "/controller/common/home.php";
            include_once($file);
            $folder = "common";
            $class = "home";
            $method = "index";

        } else {
            $tokens = explode("/", $route);
            $num = count($tokens);

            if ($num == 2 || $num == 3) {
                $folder = $tokens[0];
                $class = $tokens[1];
                $method = isset($tokens[2]) ? $tokens[2] : "index";
            } else {
                $folder = "common";
                $class = "error";
                $method = "index";
            }
        }

        $className = "Controller\\{$folder}\\Controller{$folder}{$class}";
        $file = __DIR__ . "/controller/{$folder}/{$class}.php";

        try {
            if (file_exists($file)) {
                include_once($file);
            } else {
                $className = "Controller\\Common\\ControllerCommonError";
                $file = __DIR__ . "/controller/common/error.php";
                $method = "index";
                include_once($file);
            }
        }catch(Exception $e){
            ;//尼玛file_exists返回false还不行还要出个error，吃饱撑的！！
        }

        if(is_callable([$className, $method])){
            $controller = new $className($this->service);
            call_user_func([$controller, $method]);
        }else{
            throw new \Exception("not found the executable object");
        }
    }
}


$webapp = Application::getInstance();
$webapp->run();