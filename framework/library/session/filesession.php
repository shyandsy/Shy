<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 1/28/2017
 * Time: 03:00
 */

namespace Library\Session;


class FileSession implements ISession
{

    public function close()
    {
        // TODO: Implement close() method.
    }

    public function create_sid()
    {
        // TODO: Implement create_sid() method.
    }

    public function destroy(string $session_id)
    {
        // TODO: Implement destroy() method.
    }

    public function gc(int $max_life_time)
    {
        // TODO: Implement gc() method.
    }

    public function open(string $save_path, string $session_name)
    {
        // TODO: Implement open() method.
    }

    public function read(string $session_id)
    {
        // TODO: Implement read() method.
    }

    public function write(string $session_id, string $session_data)
    {
        // TODO: Implement write() method.
    }
}