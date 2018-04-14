<?php

namespace app\controllers;


use app\core\Controller;
use app\lib\Db;
use app\models\Main;

class MainController extends Controller
{
    public function indexAction()   
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Авторизация', $vars);
    }

    public function registerAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Регистрация', $vars);
    }

    public function userAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Профиль',$vars);
    }

    public function allAction()
    {

    }

    public function logoutAction()
    {
        $model = new Main;
        $model->logout();
    }
}
