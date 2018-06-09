<?php
/**
 * Created by PhpStorm.
 * User: zolow
 * Date: 02.04.2018
 * Time: 2:43
 */

require_once '/app/lib/Dev.php';
require_once '/app/composer/vendor/autoload.php';

use app\core\Router;
use app\core\Db;

// функция автозагрузки классов
spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

$router = new Router;
//$db = Router::connect();
$db = new Db();
$router->run();





