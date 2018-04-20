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
        $count = count($this->db->queryRows("SELECT login FROM users WHERE email='".htmlspecialchars($_POST['E-mail'])."'"));
        $login = $this->db->queryRow("SELECT login FROM users WHERE login='".htmlspecialchars($_POST['login'])."'");
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
                    if($login == false){
                        return true;
                    }else {
                        return false;
                    }
                }
            }
            return false;
        }
        return false;
    }

    /**
     * Фильтр данных из форм для
     * предотвращения xss атак
     * @param $var данные из формы
     * @param int $sql
     * @return mixed|string
     */
    public function filterForm($var, $sql = 0)
    {
        $var = strip_tags($var);
        $var=str_replace ("\n"," ", $var);
        $var=str_replace ("\r","", $var);
        $var = htmlentities($var);
        if ( $sql == 1) {
            $var = mysql_real_escape_string($var);
        }
        return $var;
    }
}