<?php
/**
 * Created by PhpStorm.
 * User: zolow
 * Date: 02.04.2018
 * Time: 2:43
 */

/**
 * временный файл для включения
 * ошибок на время разработки
 */
require 'app/lib/Dev.php';

use app\core\Router;
use app\lib\Db;

// функция автозагрузки классов
spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();
$router = new Router;
$router->run();


