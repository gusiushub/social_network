<?php


namespace app\lib;

use app\core\Db;

class Mail
{
    private $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    public function restore()
    {
        if(isset($_POST['restoreForEmail'])){
            if ($this->findUserForEmail($_POST['restoreForEmail'])){
                $this->sendMail($_POST['restoreForEmail'],'Смена пароля',$this->newPassword($_POST['restoreForEmail']));
                $this->db->update('users', array('password' => md5($this->newPassword($_POST['restoreForEmail']))), 'email=:email', array(':email' => $_POST['restoreForEmail']));
            }
        }
    }

    private function findUserForEmail($email)
    {
        return $this->db->queryRow("SELECT * FROM users WHERE email='".$email."'");
    }

    private function newPassword($email)
    {
        $user = $this->findUserForEmail($email);
        return substr(md5($user['login']),0,6);
    }

    public function sendMail($to,$subject,$message)
    {
        mail($to,$subject,$message);
    }
}