<?php
/**
 * router.php класс, котоый обрабатывает url
 * всех запросов, т.е. разбивает, сортирует,
 * образует ЧПУ для удобной работы с приложением
 * и тд и тп
 */


namespace app\core;

use app\core\View;


class Router {

    protected $routes = [];
    protected $params = [];

    /**
     * Router constructor.
     */
    function __construct(){
        $arr = require 'app/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
        $_GET['id'] = $this->getId();
    }

    public function getId()
    {
        $routes = explode('/',$_SERVER['REQUEST_URI']);
        if (!empty($routes[2])) {
            return $routes[2];
        }
    }

    /**
     * Ветвление
     * @param $route
     * @param $params
     */
    public function add($route, $params){
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    /**
     * @return bool
     */
    public function math(){
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
             }
        }
        return false;
    }

    /**
     * ucfirst() - начало слова с большой буквы
     * это делается для структуры приложения
     * */
    public function run()
    {
        if ($this->math()) {
            $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if(method_exists($path, $action)){
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}