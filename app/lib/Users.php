<?php

namespace app\lib;

use app\core\View;
use app\lib\Db;
use PDO;
use app\core\DataBase;

class Users
{

    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    /**
     * @return array всех пользователей
     */
    public function getAllUsers()
    {
        return $this->db->row("SELECT * FROM users ");
    }

    public function getIdUsers()
    {
        return $this->db->row("SELECT id FROM users ");
    }

    public function getLoginUsers()
    {
        return $this->db->row("SELECT login FROM users ");
    }

    /**
     * @return array имя и фамилия пользователя
     */
    public function getNameUsers()
    {
        return $this->db->row("SELECT first_name, last_name FROM users ");
    }

    public function login()
    {
        $data = new DataBase;
        $params = [
            ':login' => $_POST['login']
        ];
        $sql = 'SELECT * FROM users WHERE login = :login';
        $user = $data->prepare($sql,$params);
        if($user[0]['password']==null and $user[0]['password']==''){
            echo 'Не верный пароль';
        }elseif ($user[0]['password'] == $_POST['password'] ){
            $this->setUserSession($user);
            $this->activeStatus();
            View::redirect('/user/'.$_SESSION['id']);
            return true;
        }
    }

    public function activeStatus()
    {
        $db = new PDO('mysql:host=localhost;dbname=network','root','');
        $sql ='UPDATE users SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->bindParam(':active', $_SESSION['active'], PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param $user
     */
    protected function setUserSession($user)
    {
        $_SESSION['id']=$user[0]['id'];
        $_SESSION['first_name']=$user[0]['first_name'];
        $_SESSION['login']=$user[0]['login'];
        $_SESSION['active']=1;
    }

    protected function findUser()
    {
        //
    }

    protected function addFriend()
    {
        //
    }

    public function getActiveStatus()
    {
        $data = new DataBase;
        $params = [
            ':id' => $_GET['id']
        ];
        $sql = 'SELECT active FROM users WHERE id=:id';
        $status = $data->prepare($sql, $params);
        return $status[0]['active'];
    }
}