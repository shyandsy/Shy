<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/27/2017
 * Time: 07:47
 */

namespace Library;

use Base\Object;
use Illuminate\Database\Capsule\Manager as Capsule;

class Config extends Object
{
    private static $config;
    private $data = [];
    private $db;

    private function __construct($service){
        $this->db = $service->resolve("db");
        $settings = Capsule::table('setting')->get();
        foreach($settings as $setting){
            if($setting->serialized){
                $this->data[$setting->key] = unserialize($setting->value);
            }else{
                $this->data[$setting->key] = $setting->value;
            }
        }
    }

    public static function getInstance($service){
        if(self::$config === null){
            self::$config = new Config($service);
        }
        return self::$config;
    }

    public function add(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get(string $key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function has(string $key)
    {
        return isset($this->data[$key]);
    }
}