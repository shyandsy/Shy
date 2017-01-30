<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 03:00
 */

namespace Library\Log;
use Exception\InvalidConfigException;

class FileLog implements ILog
{
    private $file;

    /*
     * 配置
     * $log_config['path']      日志文件路径
     */
    public function open($log_config)
    {
        $this->file = @fopen($log_config['path'], 'a');
        if(!$this->file)
        {
            throw new InvalidConfigException();
        }
    }

    public function close()
    {
        @fclose($this->file);
    }

    public function fatal($message)
    {
        @fwrite($this->file, date('Y-m-d G:i:s') . ' - fatal - ' . print_r($message, true) . "\n");
    }

    public function error($message)
    {
        @fwrite($this->file, date('Y-m-d G:i:s') . ' - error - ' . print_r($message, true) . "\n");
    }

    public function warn($message)
    {
        @fwrite($this->file, date('Y-m-d G:i:s') . ' - warn - ' . print_r($message, true) . "\n");
    }

    public function info($message)
    {
        @fwrite($this->file, date('Y-m-d G:i:s') . ' - info - ' . print_r($message, true) . "\n");
    }

    public function debug($message)
    {
        @fwrite($this->file, date('Y-m-d G:i:s') . ' - debug - ' . print_r($message, true) . "\n");
    }

    public function trace($message)
    {
        @fwrite($this->file, date('Y-m-d G:i:s') . ' - trace - ' . print_r($message, true) . "\n");
    }
}