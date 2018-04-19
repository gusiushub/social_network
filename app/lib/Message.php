<?php

namespace app\lib;

use app\lib\Users;
use PDO;

class Message
{
    protected $db;
    protected $data;

    public function __construct()
    {
        $config   = require '/../config/db.php';

        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['db_name'].'', $config['username'], $config['password']);
        $this->db->exec("SET CHARACTER SET utf8");
    }

    /**
     * Принимаем постовые данные. Очистим сообщение от html тэгов
     * и приведем id получателя к типу integer
     */
    public function sendMessage()
    {
        $message= htmlspecialchars($_POST['message']);
        //$to=(int)$_POST['to'];

        $this->db->exec("SET CHARACTER SET utf8");

        $sql="insert into messages (u_from,u_to,message,flag) values
    (:u_from,:u_to,:message,:flag)";
        $sth=$this->db->prepare($sql);
        $sth->bindValue(':u_from', 1);// 1 - ID отправителя
        $sth->bindValue(':u_to', 3);//1 - $to
        $sth->bindValue(':message', $message);
        $sth->bindValue(':flag', 0);
        $sth->execute();
        $error=$sth->errorInfo();
        /**
         * Проверка результата запроса
         */
        if($error[0]==0){
            echo 'Сообщение успешно отправлено';
        }else{
            echo 'Ошибка отправки сообщения';
        }
    }

    public function forUser()
    {
        $this->data=new Users;
        /**
         * Номер пользователя,для которого отображать сообщения
         */
        $u_id=1;
        $this->db->exec("SET CHARACTER SET utf8");
        /**
         * Достаем сообщения
         */
        $sql="select * from messages where u_to=? order by id desc";
        $sth=$this->db->prepare($sql);
        $sth->bindParam(1,$u_id,PDO::PARAM_INT);
        $sth->execute();
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row){
            $a = $this->data->useId($row['u_from']);
            echo $a['login'].' : '.$row['message'].'<br><br>';
        }
    }

    public function readMessage()
    {
        /**
         * Номер пользователя
         */
        $u_id=1;

        /**
         * Получаем номер сообщения. Приводим его типу Integer
         */
        $id_mess=(int)$_GET['id'];

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
        if($res['id']<>''){
            echo '<div>'.$res['message'].'</div>Дата отправки: '.$res['data'];
        }else{
            echo 'Данного сообщения не существует или оно предназначено не вам.';
        }
    }
}