<?php
/**
 * Класс для работы с пользователями
 * */

namespace app\lib;

use app\core\View;
use app\core\Db;
use PDO;

class Users
{
    private $db;
    private $form;

    public function __construct()
    {
        $this->db   = new Db;
        $this->form = new Form;
    }

    /**
     * @param $id пользователя
     * @return пользователь по id
     */
    public function userId($id)
    {
        return $this->db->queryRow('SELECT * FROM users WHERE id=:id', array(':id' => $id));
    }

    /**
     * @return array всех пользователей
     */
    public function getAllUsers()
    {
        return $this->db->queryRows("SELECT * FROM users ");
    }

    /**
     * регистрация пользователя
     * т.е. внесение данных в бд
     */
    public function signUp()
    {
        if ($this->checkRegisterForm()) {
            View::redirect('/');
            $this->db->insert('users', array(
                                                    'first_name' => $_POST['first_name'],
                                                    'last_name'  => $_POST['last_name'],
                                                    'email'      => $_POST['E-mail'],
                                                    'login'      => $_POST['login'],
                                                    'password'   => md5($_POST['password'])
            )); }
        else {
            echo 'Пользователь с e-mail '.$_POST['E-mail'].'уже существует';
        }
    }

    /**
     * проверка формы регистрации
     * */
    protected function checkRegisterForm()
    {
        return $this->form->regValidate();
    }

    /**
     * @param $id
     * @return null
     */
    public function select($id)
    {
        return $this->db->queryRows('SELECT first_name FROM users WHERE id ='.$id);
    }

    /**
     * @param $user
     * определить сессию для пользователя
     */
    private function setUserSession($user)
    {
        $_SESSION['id']         = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['login']      = $user['login'];
        $_SESSION['active']     = 1;
    }

    /**
     * @return bool авторизация пользователя
     */
    public function login()
    {
        $user = $this->db->queryRow('SELECT * FROM users WHERE login = :login',
                                    array(':login' => htmlspecialchars($_POST['login'])));
        if(!empty($user)){
            if($user['password'] == null and $user['password']==''){
                echo 'Введите пароль';
            }elseif ($user['password'] == md5($_POST['password']) ){
                $this->setUserSession($user);
                $this->activeStatus();
                View::redirect('/user/'.$_SESSION['id']);
                return true;
            }
        }
    }

    /**
     * выход из акаунта
     */
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

    protected function activeStatus()
    {
        $this->db->update('users', array('active' => $_SESSION['active']),
                         'id=:id', array(':id'    => $_SESSION['id']));
    }

    /**
     * @return добавить пользователя в друзья
     */
    public function addFriend()
    {
        return $this->db->insert('friends', array('user_id'   => $_SESSION['id'],
                                                       'friend_id' => $_GET['id']));
    }

    /**
     * @return null
     */
    public function getFriends()
    {
        return $this->db->queryRows('SELECT * FROM friends WHERE user_id='.htmlspecialchars($_GET['id']));
    }

    /**
     * @return null
     */
    public function findFriend()
    {
        return $this->db->queryRow('SELECT friend_id FROM friends WHERE friend_id='.$_GET['id']);
    }

    /**
     * @return mixed
     */
    public function getActiveStatus()
    {
        $status = $this->db->queryRow('SELECT active FROM users WHERE id=:id', array(':id' => $_GET['id']));
        return $status['active'];
    }

    /**
     * @return int число друзей
     */
    public function countFriends()
    {
        return count($this->getFriends());
    }

    /**
     * @return null
     */
    public function getSubscribers()
    {
        return $this->db->queryRows('SELECT * FROM friends WHERE friend_id='.$_GET['id']);
    }

    /**
     * @param $id
     * @return подписки
     */
    public function getSubscriptions($id)
    {
        return $this->db->queryRows('SELECT * FROM friends WHERE user_id='.$id);
    }

    /**
     * @param $id
     * @return подписчика по id
     */
    public function Subscribers($id)
    {
        return $this->db->queryRow("SELECT * FROM users WHERE id='".$id."'");
    }

    /**
     * @return int кол-во подписчиков
     */
    public function countSubscribers()
    {
        return count($this->getSubscribers());
    }

    /**
     * @param $id
     * @return название блога
     */
    public function getBlogName($id)
    {
        return $this->db->queryRow('SELECT blog_name FROM users WHERE id=:id', array(':id'=>$id));
    }

    public function updateBlogName()
    {
        return $this->db->update('users', array('blog_name' => htmlspecialchars($_POST['nameBlog'])), 'id=:id',
                                                                        array(':id' => $_SESSION['id']));
    }
}