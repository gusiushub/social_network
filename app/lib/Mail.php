<?php

namespace app\lib;


class Mail
{
    private $from;
    private $from_name = "";
    private $type = "text/html";
    private $encoding = "utf-8";
    private $notify = false;

    /* Конструктор принимающий обратный e-mail адрес */
    public function __construct($from)
    {
        $this->from = $from;
    }

    /* Изменение обратного e-mail адреса */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /* Изменение имени в обратном адресе */
    public function setFromName($from_name)
    {
        $this->from_name = $from_name;
    }

    /* Изменение типа содержимого письма */
    public function setType($type)
    {
        $this->type = $type;
    }

    /* Нужно ли запрашивать подтверждение письма */
    public function setNotify($notify)
    {
        $this->notify = $notify;
    }

    /* Изменение кодировки письма */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    /* Метод отправки письма */
    public function send($to, $subject, $message)
    {
        // Кодируем обратный адрес (во избежание проблем с кодировкой)
        $from = "=?utf-8?B?".base64_encode($this->from_name)."?="." <".$this->from.">";
        // Устанавливаем необходимые заголовки письма
        $headers = "From: ".$from."\r\nReply-To: ".$from."\r\nContent-type: ".$this->type."; charset=".$this->encoding."\r\n";
        // Добавляем запрос подтверждения получения письма, если требуется
        if ($this->notify) $headers .= "Disposition-Notification-To: ".$this->from."\r\n";
        $subject = "=?utf-8?B?".base64_encode($subject)."?="; // Кодируем тему (во избежание проблем с кодировкой)
        return mail($to, $subject, $message, $headers); // Отправляем письмо и возвращаем результат
    }
}