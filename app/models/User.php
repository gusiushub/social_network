<?php

namespace app\models;

use app\core\Db;
use app\lib\Users;
use app\core\Model;

class User extends Model
{
    public function __construct()
    {
        $this->db = new Db;
    }

    public function allUsers()
    {
        $users = new Users;
        return $users->getAllUsers();
    }
}