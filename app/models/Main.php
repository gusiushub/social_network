<?php

namespace app\models;

use app\core\Model;
use app\core\View;
use app\lib\Db;
use app\lib\Files;
use app\lib\Form;
use app\lib\Users;
use app\core\DataBase;
use PDO;

class Main extends Model
{
    private $user;
    private $file;
    private $form;
    private $connect;

    public function __construct()
    {
        $this->db = new Db;
        $this->user = new Users;
        $this->file = new Files;
        $this->form = new Form;
        $this->connect = new DataBase;
    }

    /**
     * @return array
     */
    public function userId()
    {
        $sql = 'SELECT * FROM users WHERE id=:id';
        $params = [
            ':id' => $_GET['id']
        ];
        return $this->connect->prepare($sql,$params);
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
        $params = [
            ':id' => $_SESSION['id']
        ];
        $sql = "UPDATE users SET avatar='".$filename."' WHERE id=:id";
        return $this->connect->prepare($sql,$params);
    }

    public function userPosts()
    {
        $sql = "SELECT * FROM posts WHERE user_id=:id ORDER BY id DESC";
        $params = [
            ':id' => $_GET['id']
        ];
        return $this->connect->prepare($sql, $params);
    }

    public function post()
    {
        if (!empty($_POST['title']) && !empty($_POST['content'])) {
            $sql = "INSERT INTO posts (title, content, date, user_id) VALUES (:title,:content,:date, :user_id)";
            $params = [
                ':title'   => $_POST['title'] ,
                ':content' => $_POST['content'],
                ':date'    => date('Y-m-d',time()),
                ':user_id' => $_SESSION['id']
            ];
            return $this->connect->prepare($sql,$params);
        }
        echo 'заполните все поля поля';
    }

    public function signUp()
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=network','root','');
            $sql = "INSERT INTO users (first_name, last_name, email, login, password) VALUES (?, ?, ?, ?, ?)";
            $params = array(
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['E-mail'],
                $_POST['login'],
                $_POST['password']
            );
            $result = $db->prepare($sql);

            if ($this->checkRegisterForm()) {
                View::redirect('/');
                return $q = $result->execute($params);
            }
            else {
                echo 'Пользователь с e-mail '.$_POST['E-mail'].'уже существует';
            }
        }
        catch(PDOException $e)
        {
            die("Error: ".$e->getMessage());
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