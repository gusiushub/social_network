<?php

namespace app\models;

use app\core\Model;
use app\core\View;
use app\core\Db;
use app\lib\Files;
use app\lib\Form;
use app\lib\Users;

class Main extends Model
{
    private $user;
    private $file;
    private $form;

    public function __construct()
    {
        $this->db = new Db;
        $this->user = new Users;
        $this->file = new Files;
        $this->form = new Form;
    }

    /**
     * @return array
     */
    public function userId()
    {
        return $this->db->queryRow('SELECT * FROM users WHERE id=:id', array(':id' => $_GET['id']));
    }

    /**
     * авторизация
     */
    public function login()
    {
        $this->user->login();
    }

    /**
     * выход из аккаунта
     */
    public function logout()
    {
        unset($_SESSION['first_name']);
        unset($_SESSION['login']);
        unset($_SESSION['avatar']);
        $_SESSION['active']=0;
        $this->user->activeStatus();
        unset($_SESSION['id']);
        View::redirect('/');
    }

    /**
     * загрузка файла
     * */
    public function upLoadFile()
    {
        return $this->file->upLoad();
    }

    public function updateAvatar($filename)
    {
        return $this->db->update('users', array('avatar' => $filename), 'id=:id', array(':id' => $_SESSION['id']));
    }

    public function userPosts()
    {
        return $this->db->queryRows('SELECT * FROM posts WHERE user_id=:id
                                            ORDER BY id DESC', array('id' => $_GET['id']));
    }

    public function post()
    {
        if (!empty($_POST['title']) && !empty($_POST['content'])) {
            return $this->db->insert('posts', array(  'title' => $_POST['title'],
                                                            'content' => $_POST['content'],
                                                            'date' => date('Y-m-d',time()),
                                                            'user_id' => $_SESSION['id']));
        }
        echo 'заполните все поля поля';
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

    /**
     * проверка формы регистрации
     * */
    protected function checkRegisterForm()
    {
        return $this->form->regValidate();
    }
    public function activeStatus()
    {
        return $this->user->getActiveStatus();
    }

}