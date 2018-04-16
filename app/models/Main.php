<?php

namespace app\models;

use app\core\Model;
use app\lib\Article;
use app\lib\Files;
use app\lib\Form;
use app\lib\Users;

class Main extends Model
{
    private $user;
    private $file;
    private $form;
    private $article;

    public function __construct()
    {
        $this->user    = new Users;
        $this->file    = new Files;
        $this->form    = new Form;
        $this->article = new Article;
    }

    /**
     * @return array
     */
    public function userId()
    {
        return $this->user->userId();
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

    public function updateAvatar($filename)
    {
        return $this->file->updateAvatar($filename);
    }

    public function userPosts()
    {
        return $this->article->userPosts();
    }

    public function post()
    {
        return $this->article->post();
    }

    public function signUp()
    {
        $this->user->signUp();
    }

    public function activeStatus()
    {
        return $this->user->getActiveStatus();
    }

    public function addFriend()
    {
        return $this->user->addFriend();
    }

    public function getFriends()
    {
        return $this->user->getFriends();
    }

    public function findFriend()
    {
        return $this->user->findFriend();
    }

    public function countFriends()
    {
        return $this->user->countFriends();
    }

    public function getSubscribers()
    {
        return $this->user->getSubscribers();
    }

    public function countSubscribers()
    {
        return count($this->user->getSubscribers());
    }

    public function Subscribers($id)
    {
        return $this->user->Subscribers($id);
    }
    public function getSubscriptions()
    {
        return $this->user->getSubscriptions();
    }

}