<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Main;

class MainController extends Controller
{
    public function indexAction()   
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Авторизация', $vars);
    }

    public function dialogAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Диалоги', $vars);
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
        $this->view->render('Профиль', $vars);
    }

    public function subscriptionsAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Подписки', $vars);
    }

    public function subscribersAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('подписчики', $vars);
    }

    public function logoutAction()
    {
        $model = new Main;
        $model->logout();
    }
}
