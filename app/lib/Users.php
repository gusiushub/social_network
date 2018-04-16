<?php
/**
 * Класс для работы с пользователями
 * */

namespace app\lib;

use app\core\View;
use app\core\Db;

class Users
{

    private $db;
    private $form;

    public function __construct()
    {
        $this->db   = new Db;
        $this->form = new Form;
    }

    public function userId()
    {
        return $this->db->queryRow('SELECT * FROM users WHERE id=:id', array(':id' => $_GET['id']));
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

    public function signUp()
    {
        if ($this->checkRegisterForm()) {
            View::redirect('/');
            return $this->db->insert('users', array(   'first_name' => $_POST['first_name'],
                'last_name' =>$_POST['last_name'],
                'E-mail'=>$_POST['E-mail'],
                'login' =>$_POST['login'],
                'password' => $_POST['password']));
        }
        else {
            echo 'Пользователь с e-mail '.$_POST['E-mail'].'уже существует';
        }
    }

    protected function checkRegisterForm()
    {
        return $this->form->regValidate();
    }


    public function login()
    {
        $user = $this->db->queryRow('SELECT * FROM users WHERE login = :login', array(':login' => $_POST['login']));
        if(!empty($user)){
            if($user['password'] == null and $user['password']==''){
                echo 'Не верный пароль';
            }elseif ($user['password'] == $_POST['password'] ){
                $this->setUserSession($user);
                $this->activeStatus();
                View::redirect('/user/'.$_SESSION['id']);
                return true;
            }
        }
    }

    protected function activeStatus()
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

    public function addFriend()
    {
        return $this->db->insert('friends', array('user_id' => $_SESSION['id'], 'friend_id' => $_GET['id']));
    }

    public function getFriends()
    {
        return $this->db->queryRows('SELECT * FROM friends WHERE user_id='.$_GET['id']);
    }

    public function findFriend()
    {
        return $this->db->queryRow('SELECT friend_id FROM friends WHERE friend_id='.$_GET['id']);
    }

    public function getActiveStatus()
    {
        $status = $this->db->queryRow('SELECT active FROM users WHERE id=:id', array(':id' => $_GET['id']));
        return $status['active'];
    }

    public function countFriends()
    {
        return count($this->getFriends());
    }

    public function getSubscribers()
    {
        return $this->db->queryRows('SELECT * FROM friends WHERE friend_id='.$_GET['id']);
    }

    public function countSubscribers()
    {
        return count($this->getSubscribers());
    }

    public function logout()
    {
        unset($_SESSION['first_name']);
        unset($_SESSION['login']);
        unset($_SESSION['avatar']);
        $_SESSION['active']=0;
        $this->activeStatus();
        unset($_SESSION['id']);
        View::redirect('/');
    }



}