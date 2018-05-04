<?php

namespace app\models;

use app\core\Model;
use app\lib\Article;
use app\lib\Files;
use app\lib\Form;
use app\lib\Users;
use app\lib\Message;
use app\lib\Mail;

class Main extends Model
{
    private $user;
    private $file;
    private $form;
    private $article;
    private $message;
    private $mail;

    public function __construct()
    {
        $this->user    = new Users;
        $this->file    = new Files;
        $this->form    = new Form;
        $this->article = new Article;
        $this->message = new Message;
        $this->mail    = new Mail;
    }

    /**
     * @param $id
     * @return \app\lib\пользователь
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
     * @return null добавить друга
     */
    public function addFriend()
    {
        return $this->user->addFriend();
    }

    /**
     * @return null вывести друзей
     */
    public function getFriends()
    {
        return $this->user->getFriends();
    }

    /**
     * @return null найти друга
     */
    public function findFriend()
    {
        return $this->user->findFriend();
    }

    /**
     * @return int кол-во друзей
     */
    public function countFriends()
    {
        return $this->user->countFriends();
    }

    /**
     * @return mixed изменить название блога
     */
    public function updateBlogName()
    {
        return$this->user->updateBlogName();
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

    /**
     * @param $data
     * @return \app\lib\подписки
     */
    public function getSubscriptions($data)
    {
        return $this->user->getSubscriptions($data);
    }

    /**
     * прочитать сообщение
     */
    public function readMessage()
    {
         $this->message->readMessage();
    }

    /**
     * отправить сообщение
     */
    public function sendMessage()
    {
         $this->message->sendMessage();
    }

    /**
     * кому(сообщение)
     */
    public function toUserMsg()
    {
        $this->message->toUserMsg();
    }

    /**
     * от кого (смс)
     */
    public function msgForUser()
    {
         $this->message->forUser();
    }

    /**
     * @param $id
     * @return null
     */
    public function select($id)
    {
        return $this->user->select($id);
    }

    /**
     * @param $id delete post
     */
    public function deletePost($id)
    {
         $this->article->delPost($id);
    }

    /**
     * @param $id
     * @return \app\lib\название
     */
    public function getBlogName($id)
    {
        return $this->user->getBlogName($id);
    }

    /**
     * @return array получить всех юзеров
     */
    public function allUsers()
    {
        return $this->user->getAllUsers();
    }

    /**
     * @param $mes
     */
    public function textMsg($mes)
    {
        $this->message->textMsg($mes);
    }

    /**
     * @return mixed вывести диалог
     */
    public function getDialog()
    {
        return $this->message->getDialog();
    }

    /**
     *
     */
    public function restore()
    {
        $this->mail->restore();
    }

}