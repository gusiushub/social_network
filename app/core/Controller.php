<?php
/**
 * Контроллер, один из трех компонентов MVC
 * служит для связи моделей и видов. В контроллере как и в моделях
 * нежелательно использовать html или css. Из этого можно сделать
 * вывод, что из всех трех компонентов он задействуется перевым.
 */
namespace app\core;

abstract class Controller
{
    public $route;
    public $view;
    public $acl;
    public $model;

    /**
     * Controller constructor.
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        if(!$this->checkAcl()){
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function loadModel($name)
    {
        $path = 'app\models\\'.ucfirst($name);
        if(class_exists($path)) {
            return new $path;
        }
    }

    /**
     * Проверка на права доступа
     * @return bool возвращает true/false
     * true(у нас есть доступ к данной странице)
     * false вернет ошибку 403
     */
    public function checkAcl()
    {
        $this->acl = require 'app/acl/'.$this->route['controller'].'.php';
        if($this->isAcl('all')){
            return true;
        }
        elseif (isset($_SESSION['authorize']) and $this->isAcl('authorize')){
            return true;
        }
        elseif (!isset($_SESSION['authorize']) and $this->isAcl('guest')){
            return true;
        }
        elseif (isset($_SESSION['admin']) and $this->isAcl('admin')){
            return true;
        }
        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function isAcl($key)
    {
        return in_array($this->route['action'],$this->acl[$key]);
    }
}