<?php

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
     * @return bool
     */
    public function checkAcl()
    {
        $this->acl = require 'app/acl/'.$this->route['controller'].'.php';
        if($this->isAcl('all')){
            return true;
        }
        elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')){
            return true;
        }
        elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')){
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