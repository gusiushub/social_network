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

    public function aboutAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('О нас', $vars);
    }

    public function feedbackAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Обратная связь', $vars);
    }

    public function chatAction()
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

    public function editAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Ред. профиль', $vars);
    }

    public function logoutAction()
    {
        $model = new Main;
        $model->logout();
    }

    public function allAction()
    {
        $model = new Main;
        $vars = ['model' => $model];
        $this->view->render('Пользователи', $vars);
    }

}
