<?php

namespace app\lib;

use app\core\Db;

class Find
{
    public function find()
    {
        header ("Content-type:text/html; charset=utf-8");
        if (isset ($_POST['query']) && !empty($_POST['query'])) {
            // Открываем соединение с базой данных
            $connect = new Db;
            $search_result = $this->search ($_POST['query']);
            echo $search_result;
        }
    }

    private function search($query)
    {
        $text = '';

        // Проводим фильтрацию данных
        $query = trim($query);                     // Обрезаем пробелы и спецсиволы
        $query = strip_tags($query);               // Удаляем HTML и PHP теги
        $query = mysql_real_escape_string($query); // Экранируем специальные символы


        //Поисковый запрос не пустой?
        if (!empty($query)){
            if (strlen($query) < 4) {
                $text = 'короткий поисковый запрос';
            }elseif (strlen($query) > 128) {
                $text = 'длинный поисковый запрос';
            } else {
                //Формируем строку поискового запроса
                $sql = "SELECT first_name, last_name FROM users WHERE first_name LIKE '%$query%'
              OR last_name LIKE '%$query%'";
                // и выполняем его
                $result = mysql_query($sql);
                $end_result = '';
                if(mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_object($result)){
                        $end_result .=  $row->title. "\n";
                    }
                    $text =  $end_result;
                } else {
                    $text =  'По вашему запросу ничего не найдено';
                }
            }
        }else {
            $text = 'Задан пустой поисковый запрос.';
        }
        //Возвращаем сформированную строку поисковой выдачи
        return $text;
    }

}