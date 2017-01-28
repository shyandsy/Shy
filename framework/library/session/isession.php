<?php

/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 02:56
 */
namespace Library\Session;
interface ISession
{
    public function close();
    public function create_sid();
    public function destroy (string $session_id);
    public function gc(int $max_life_time);
    public function open(string $save_path, string $session_name);
    public function read(string $session_id);
    public function write(string $session_id, string $session_data);
}