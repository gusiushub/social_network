<?php

namespace app\lib;

use app\core\Db;

class Form
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    public function regValidate()
    {
        $nameLen = strlen($_POST['login']);
        $count = count($this->db->queryRows("SELECT login FROM users WHERE email='".$_POST['E-mail']."'"));
        if($count==0){
            if (!empty($_POST['first_name']) &&
                !empty($_POST['last_name']) &&
                !empty($_POST['E-mail']) &&
                !empty($_POST['login']) &&
                !empty($_POST['password']) &&
                $_POST['password']===$_POST['password2']){

                if($nameLen < 1 or $nameLen > 15){
                    return false;
                }else {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
}