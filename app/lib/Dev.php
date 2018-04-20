<?php

// удалить при релизе

/**
 * временный файл для включения
 * ошибок на время разработки
 */

 ini_set('display_errors', 1);
 error_reporting(E_ALL);

 function debug($str){
     echo '<pre>';
     var_dump($str);
     echo '</pre>';
     exit;
 }