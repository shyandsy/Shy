<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 02:41
 */
namespace Shy;
use Shy\Library\Service;
use Shy\Library\Request;
use Shy\Library\Response;
use Shy\Library\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
use Shy\Exception\InvalidConfigException;
use Shy\Library\Log;
use Shy\Library\Session;

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
        if (self::$app === null)
        {
            self::$app = new Application();
        }
        return self::$app;
    }


    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        switch ($errno)
        {
            case E_USER_ERROR:

                echo "<b>Error: </b> [$errno] $errstr<br />\n";
                echo "  Fatal error on line $errline in file $errfile";
                echo "Aborting...<br />\n";
                exit(1);
                break;

            case E_USER_WARNING:
                echo "<b>Warning: </b> [$errno] $errstr<br />\n";
                break;

            case E_USER_NOTICE:
                echo "<b>Notice: </b> [$errno] $errstr<br />\n";
                break;

            default:
                echo "Unknown error type: [$errno] $errstr<br />\n";
                break;
        }
    }

    public static function exception_handler($exception)
    {
        $message = $exception->getMessage();
        $code = $exception->getCode();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $callstack = $exception->getTrace();
        $callstack = array_reverse($callstack);

        $template = "
        <div>
            <h4 style='margin:0px;'>Exception message: %s</h4>
            <p style='margin:0px'>code: %s</p>
            <p style='margin:0px'>file: %s</p>
            <p style='margin:0px'>line: %s</p>
            <p style='margin:0px'>call stack:</p>
            <table style='border:1px solid #ccc;border-collapse:separate;border-spacing:40px 5px;'>
                <tr style='border-bottom: 1px solid #ddd;margin:10px 30px;'>
                    <th style='text-align:left;'>File</th>
                    <th style='text-align:left;'>Line</th>
                    <th style='text-align:left;'>Position</th>
                </th>
        ";
        $output = sprintf($template, $message, $code, $file, $line);

        foreach($callstack as $item)
        {
            $output .= "<tr style='border-bottom: 1px solid #ddd;padding:10px 30px;'>";
            $output .= "<td>" . $item['file'] . "</td>";
            $output .= "<td>" . $item['line'] . "</td>";
            $output .= "<td>" . $item['class'] . $item['type'] . $item['function'] . "</td>";
            $output .= "</tr>";
        }

        $output .= "
            </table>
        </div>";
        echo $output;
    }

    public function run($config)
    {
        //version check
        if (version_compare(PHP_VERSION, '7.0.0') < 0)
        {
            echo "The lowerest php version is 7, but your version is" . PHP_VERSION . "\n";
            exit();
        }

        if(isset($config['debug']) && $config['debug'])
        {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }

        //error handler
        set_error_handler("Shy\\Application::errorHandler", E_ALL ^ E_NOTICE);

        //exception handler
        set_exception_handler("Shy\\Application::exception_handler");

        //base dir
        $this->base_dir = $config['base_dir'];
        $this->viewCacheDir = $config['viewCacheDir'];
        $this->templateEngine = $config['templateEngine'];

        //create service
        $this->service = new Service();

        $db = new Capsule();
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
        $db->setAsGlobal();

        //twig
        $loader = new \Twig_Loader_Filesystem($this->base_dir . '/view/');
        $twig = new \Twig_Environment($loader, array(
            'cache' => $this->base_dir . '/view-cache/',
        ));

        //register component
        $this->service->register("request", new Request());
        $this->service->register("response", new Response());
        $this->service->register("db", $db);
        $this->service->register("twig", $twig);
        $this->service->register("log", Log::getInstance($config['log']));
        $this->service->register("session", Session::getInstance($config['session']));
        $this->service->register("config", Config::getInstance($this->service));

        //set app into Shy
        \Shy::$app = $this;

        //execute controller
        $route = \Shy::$app->request->get("route");

        if ($route == null) { //default home page
            $file = $this->base_dir . "/controller/common/home.php";
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
        $file = $this->base_dir . "/controller/{$folder}/{$class}.php";

        //confirm file exists
        if (file_exists($file)) {
            include_once($file);
        } else {
            $className = "Controller\\Common\\ControllerCommonError";
            $file = $this->base_dir . "/controller/common/error.php";
            $method = "index";
            include_once($file);
        }

        //make sure the method is available
        if (is_callable([$className, $method])) {
            $controller = new $className($this->service);
            call_user_func([$controller, $method]);
        } else {
            $className = "Controller\\Common\\ControllerCommonError";
            $file = $this->base_dir . "/controller/common/error.php";
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

    public function __get($key)
    {
        assert($this->service != false);
        if($this->service)
        {
            return $this->service->resolve($key);
        }
        else
        {
            throw new \Exception\ShyCartException("application run should be executed before get");
        }
    }
}