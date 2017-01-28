<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/26/2017
 * Time: 22:33
 */
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

use Library\Service;
use Library\Request;
use Library\Response;
use Library\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ShyCart
{
    public static $app;
}

class Application
{

    private static $app = null;
    private $service = null;
    private $base_dir = null;
    private $viewCacheDir = null;
    private $templateEngine = null;

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

    public function run($config)
    {
        //auto loader
        spl_autoload_register("Application::autoloader");

        //error handler
        set_error_handler("Application::errorHandler", E_ALL ^ E_NOTICE);

        //exception handler
        set_exception_handler("Application::exception_handler");

        //base dir
        $this->base_dir = $config['base_dir'];
        $this->viewCacheDir = $config['viewCacheDir'];
        $this->templateEngine = $config['templateEngine'];

        //create service
        $this->service = new Service();

        $db = new Capsule;
        $db->addConnection([
            'driver' => $config['db']['DB_DRIVER'],
            'host' => $config['db']['DB_HOST'],
            'database' => $config['db']['DB_DATABASE'],
            'username' => $config['db']['DB_USERNAME'],
            'password' => $config['db']['DB_PASSWORD'],
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => '',
        ]);

        //twig
        $loader = new Twig_Loader_Filesystem($this->base_dir . '/view/');
        $twig = new Twig_Environment($loader, array(
            'cache' => $this->base_dir . '/view-cache/',
        ));

        //register component
        $this->service->register("request", new Request());
        $this->service->register("response", new Response());
        $this->service->register("config", new Config());
        $this->service->register("db", $db);
        $this->service->register("twig", $twig);

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

        //confirm file exists
        if (file_exists($file)) {
            include_once($file);
        } else {
            $className = "Controller\\Common\\ControllerCommonError";
            $file = __DIR__ . "/controller/common/error.php";
            $method = "index";
            include_once($file);
        }

        //make sure the method is available
        if (is_callable([$className, $method])) {
            $controller = new $className($this->service);
            call_user_func([$controller, $method]);
        } else {
            $className = "Controller\\Common\\ControllerCommonError";
            $file = __DIR__ . "/controller/common/error.php";
            $method = "index";
            include_once($file);

            $controller = new $className($this->service);
            call_user_func([$controller, $method]);
        }
    }

    public function getBaseDir()
    {
        return $this->base_dir;
    }

    public function getViewCacheDir()
    {
        return $this->viewCacheDir;
    }

    public function getTemplateEngine()
    {
        return $this->templateEngine;
    }
}


$app = Application::getInstance();
ShyCart::$app = $app;
$app->run($config);