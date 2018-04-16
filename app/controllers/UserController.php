<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class UserController extends Controller
{
    public function allAction()
    {
        $model = new User;
        $vars = ['model'=>$model];
        $this->view->render('Пользователи', $vars);
    }
    public function chatAction()
    {
        $this->view->render('чат');
    }
}