<?php

namespace app\lib;

use app\core\Db;

class Form
{
    private $data = array();
    private $db;

    public function __construct($row = null)
    {
        $this->db = new Db;
        $this->data = $row;
    }

    /**
     * @return bool валидация формы регистрации
     */
    public function regValidate()
    {
        $nameLen = strlen($_POST['login']);
        $count = count($this->db->queryRows("SELECT login FROM users WHERE email='".htmlspecialchars($_POST['E-mail'])."'"));
        $login = $this->db->queryRow("SELECT login FROM users WHERE login='".htmlspecialchars($_POST['login'])."'");
        if($count==0){
            if (isset(
                        $_POST['first_name'],
                        $_POST['last_name'] ,
                        $_POST['E-mail']    ,
                        $_POST['login']     ,
                        $_POST['password']) &&
                        $_POST['password'] === $_POST['password2']){
                if($nameLen < 1 or $nameLen > 15){
                    return false;
                }else {
                    if($login == false){
                        return true;
                    }else {
                        return false;
                    }
                }
            }
            return false;
        }
        return false;
    }

    /**
     * Фильтр данных из форм для
     * предотвращения xss атак
     * @param $var данные из формы
     * @param int $sql
     * @return mixed|string
     */
    public function filterForm($var, $sql = 0)
    {
        $var = strip_tags($var);
        $var=str_replace ("\n"," ", $var);
        $var=str_replace ("\r","", $var);
        $var = htmlentities($var);
        if ( $sql == 1) {
            $var = mysql_real_escape_string($var);
        }
        return $var;
    }

    /**
     * Данный метод используется как FILTER_CALLBACK
     * преобразует все специальные символы HTML,
     * что эффективно блокирует атаки XSS. Также
     * он заменяет символы новой строки тегами <br />.
     * @param $str
     * @return bool|mixed|string
     */
    public static function validateText($str)
    {
        if(mb_strlen($str,'utf8')<1)
            return false;
        // Кодируем все специальные символы html (<, >, ", & .. etc) и преобразуем
        // символ новой строки в тег <br>:
        $str = nl2br(htmlspecialchars($str));
        // Удаляем все оставщиеся символы новой строки
        $str = str_replace(array(chr(10),chr(13)),'',$str);
        return $str;
    }

    /**
     * Данный метод используется для проверки данных,
     *  передаваемых через AJAX.
     * Это возвращение true/false (истина/лож) в зависимости
     * от данных является действительным, и заполняеться
     * Масив $arr передается в качестве paremter
     * (обратите внимание, амперсанд выше)
     * Либо действительно ввод данных, или сообщения об ошибках.
     *
     * @param $arr
     * @return bool
     */
    public static function validateAjax(&$arr)
    {
        $errors = array();
        $data   = array();

        if(!($data['email'] =
            filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)))
        {
            $errors['email'] = 'Please enter a valid Email.';
        }

        if(!($data['url'] =
            filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL)))
        {
            // Если поле URL не соответствует не правильный URL
            $url = '';
        }

        // Использование фильтров с пользовательской
        // функцией обратного вызова:

        if(!($data['body'] =
            filter_input(INPUT_POST,'body',FILTER_CALLBACK,
                array('options'=>'Comment::validate_text'))))
        {
            $errors['body'] = 'Ошибака комментариев.';
        }

        if(!($data['name'] =
            filter_input(INPUT_POST,'name',FILTER_CALLBACK,
                array('options'=>'Comment::validate_text'))))
        {
            $errors['name'] = 'Ошибка имени.';
        }

        if(!empty($errors)){

            //Если есть ошибки, записываем $errors в массив $arr:

            $arr = $errors;
            return false;
        }


        foreach($data as $k=>$v){
            $arr[$k] = mysql_real_escape_string($v);
        }

        // Убедимся, что письма в нижнем регистре
        // (для правильного хэш Gravatar):
        $arr['email'] = strtolower(trim($arr['email']));

        return true;
    }
}