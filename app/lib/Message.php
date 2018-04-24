<?php

namespace app\lib;

use app\core\Db;
//use app\lib\Users;
use PDO;

class Message
{
    protected $db;
    protected $data;

    public function __construct()
    {
        $config   = require '/../config/db.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['db_name'],
                                              $config['username'], $config['password']);
        $this->db->exec("SET CHARACTER SET utf8");
    }

    /**
     * @param $mes
     * @return mixed
     */
    public function textMsg($mes)
    {
        return $mes;
    }

    /**
     * Принимаем постовые данные. Очистим сообщение от html тэгов
     * и приведем id получателя к типу integer
     */
    public function sendMessage()
    {
        if(!empty($_POST['message'])) {
            $message = htmlspecialchars($_POST['message']);

            //$to=(int)$_POST['to'];

            $this->db->exec("SET CHARACTER SET utf8");

            $sql = "insert into messages (u_from,u_to,message,flag) values
    (:u_from,:u_to,:message,:flag)";
            $sth = $this->db->prepare($sql);
            $sth->bindValue(':u_from', $_SESSION['id']);// 1 - ID отправителя
            $sth->bindValue(':u_to', $_GET['id']);//1 - $to
            $sth->bindValue(':message', $message);
            $sth->bindValue(':flag', 0);
            $sth->execute();
            $error = $sth->errorInfo();
            /**
             * Проверка результата запроса
             */
            if ($error[0] == 0) {
                echo 'Сообщение успешно отправлено';
            } else {
                echo 'Ошибка отправки сообщения';
            }
        }
    }

    /**
     * кому(смс)
     */
    public function forUser()
    {
        $this->data = new Users;
        /**
         * Номер пользователя,для которого отображать сообщения
         */
        $u_id=$_SESSION['id'];
        $this->db->exec("SET CHARACTER SET utf8");
        /**
         * Достаем сообщения
         */
        $sql="select * from messages where u_to=:u_to order by id desc";
        $sth=$this->db->prepare($sql);
        $sth->bindParam(':u_to',$u_id,PDO::PARAM_INT);
        $sth->execute();
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row){
            $a = $this->data->userId($row['u_from']);
            echo $a['login'].' : '.$row['message'].'<br><br>';
        }
        $lastSms = $res[0];
        $_GET['mess']=$lastSms['id'];
    }

    /**
     * кому(смс)
     */
    public function toUserMsg()
    {
        $this->data = new Users;
        /**
         * Номер пользователя,для которого отображать сообщения
         */
        $u_id=$_GET['id'];
        $this->db->exec("SET CHARACTER SET utf8");
        /**
         * Достаем сообщения
         */
        $sql="select * from messages where u_to=:u_to order by id desc";
        $sth=$this->db->prepare($sql);
        $sth->bindParam(':u_to',$u_id,PDO::PARAM_INT);
        $sth->execute();
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row){
            $a = $this->data->userId($row['u_from']);
            echo $a['login'].' : '.$row['message'].'<br><br>';
        }
        $lastSms = $res[0];
        $_SESSION['message']=$lastSms['id'];
    }
    /**
     * выввод полученного сообщения
     */
    public function readMessage()
    {
        /**
         * Номер пользователя
         */
        $u_id=$_GET['id'];
        /**
         * Получаем номер сообщения. Приводим его типу Integer
         */
        $id_mess=(int)$_POST['message'];
        $this->db->exec("SET CHARACTER SET utf8");
        /**
         * Достаем сообщение. Помимо номера сообщения ориентируемся и на id пользователя
         * Это исключит возможность чтения чужого сообщения, методом подбора id сообщения
         */
        $sql="select * from messages where u_to = :u_to and id = :id_mess";
        $sth=$this->db->prepare($sql);
        $sth->bindParam(':u_to',$u_id,PDO::PARAM_INT);
        $sth->bindParam(':id_mess',$id_mess,PDO::PARAM_INT);
        $sth->execute();
        $res=$sth->fetch(PDO::FETCH_ASSOC);
        /**
         * Установим флаг о прочтении сообщения
         */
        $sql="update messages set flag = 1 where  u_to = :u_to and id = :id_mess";
        $sth=$this->db->prepare($sql);
        $sth->bindParam(':u_to',$u_id,PDO::PARAM_INT);
        $sth->bindParam(':id_mess',$id_mess,PDO::PARAM_INT);
        $sth->execute();
        /**
         * Выводим сообщение с датой отправки
         */
        if($res['id']<>'' or $res['u_from']==$_SESSION['id']){
            echo '<div>'.$res['message'].'</div>Дата отправки: '.$res['data'];
        }else{
            echo 'Данного сообщения не существует или оно предназначено не вам.';
        }
    }

    /**
     * @return mixed вывести диалог
     */
    public function getDialog()
    {
        $db = new Db;
        return $db->queryRows("SELECT * FROM messages WHERE u_from IN(".$_SESSION['id'].") AND u_to IN(".$_GET['id'].") OR u_from IN(".$_GET['id'].") AND u_to IN(".$_SESSION['id'].") ORDER BY id DESC");
    }
}