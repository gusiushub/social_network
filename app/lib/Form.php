<?php

namespace app\lib;

use app\core\Db;

class Form
{
    private $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    /**
     * @return bool
     */
    public function regValidate()
    {
        $nameLen = strlen($_POST['login']);
        $count = count($this->db->queryRows("SELECT login FROM users WHERE email='".$_POST['E-mail']."'"));
        if($count==0){
            if (isset(
                $_POST['first_name'],
                $_POST['last_name'] ,
                $_POST['E-mail']    ,
                $_POST['login']     ,
                $_POST['password']) &&
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