<?php
/**
 * Класс для работы с пользователями
 * */

namespace app\lib;

use app\core\View;
use app\core\Db;

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
        return $this->db->queryRows("SELECT * FROM users ");
    }

    public function getIdUsers()
    {
        return $this->db->queryRows("SELECT id FROM users ");
    }

    public function getLoginUsers()
    {
        return $this->db->queryRows("SELECT login FROM users ");
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
        $user = $this->db->queryRow('SELECT * FROM users WHERE login = :login', array(':login' => $_POST['login']));
        if(!empty($user)){
            if($user['password']==null and $user['password']==''){
                echo 'Не верный пароль';
            }elseif ($user['password'] == $_POST['password'] ){
                $this->setUserSession($user);
                $this->activeStatus();
                View::redirect('/user/'.$_SESSION['id']);
                return true;
            }
        }
    }

    public function activeStatus()
    {
        $this->db->update('users', array('active' => $_SESSION['active']), 'id=:id', array(':id' => $_SESSION['id']));
    }

    /**
     * @param $user
     */
    protected function setUserSession($user)
    {
        $_SESSION['id']=$user['id'];
        $_SESSION['first_name']=$user['first_name'];
        $_SESSION['login']=$user['login'];
        $_SESSION['active']=1;
    }

    protected function findUser()
    {

    }

    protected function addFriend()
    {
        return ;
    }

    public function getActiveStatus()
    {
        $status = $this->db->queryRow('SELECT active FROM users WHERE id=:id', array(':id' => $_GET['id']));
        return $status['active'];
    }
}