<?php

namespace app\models;

use app\core\Model;
use app\lib\Article;
use app\lib\Files;
use app\lib\Form;
use app\lib\Users;
use app\lib\Message;

class Main extends Model
{
    private $user;
    private $file;
    private $form;
    private $article;
    private $message;

    public function __construct()
    {
        $this->user    = new Users;
        $this->file    = new Files;
        $this->form    = new Form;
        $this->article = new Article;
        $this->message = new Message;
    }

    /**
     * @return array
     */
    public function userId($id)
    {
        return $this->user->userId($id);
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
        $this->user->logout();
    }

    /**
     * загрузка файла
     * */
    public function upLoadFile()
    {
        return $this->file->upLoad();
    }

    /**
     * @param $filename
     * @return mixed
     */
    public function updateAvatar($filename)
    {
        return $this->file->updateAvatar($filename);
    }

    /**
     * @return null
     */
    public function userPosts()
    {
        return $this->article->userPosts();
    }

    /**
     * @return null
     */
    public function post()
    {
        return $this->article->post();
    }

    /**
     * Регистрация
     */
    public function signUp()
    {
        $this->user->signUp();
    }

    /**
     * @return mixed
     */
    public function activeStatus()
    {
        return $this->user->getActiveStatus();
    }

    /**
     * @return null
     */
    public function addFriend()
    {
        return $this->user->addFriend();
    }

    /**
     * @return null
     */
    public function getFriends()
    {
        return $this->user->getFriends();
    }

    /**
     * @return null
     */
    public function findFriend()
    {
        return $this->user->findFriend();
    }

    /**
     * @return int
     */
    public function countFriends()
    {
        return $this->user->countFriends();
    }

    /**
     * @return null
     */
    public function getSubscribers()
    {
        return $this->user->getSubscribers();
    }

    /**
     * @return int
     */
    public function countSubscribers()
    {
        return count($this->user->getSubscribers());
    }

    /**
     * @param $id
     * @return null
     */
    public function Subscribers($id)
    {
        return $this->user->Subscribers($id);
    }


    public function getSubscriptions($data)
    {
        return $this->user->getSubscriptions($data);
    }

    public function readMessage()
    {
         $this->message->readMessage();
    }

    public function sendMessage()
    {
         $this->message->sendMessage();
    }

    public function msgForUser()
    {
         $this->message->forUser();
    }

    public function select($id)
    {
        return $this->user->select($id);
    }

}