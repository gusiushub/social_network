<?php

/**
 * временный файл для включения
 * ошибок на время разработки
 * удалить при релизе(отключить в точке входа)
 */

 ini_set('display_errors', 1);
 error_reporting(E_ALL);

 function debug($str){
     echo '<pre>';
     var_dump($str);
     echo '</pre>';
     exit;
 }