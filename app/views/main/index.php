<?php
    if(isset($_POST['loginSubmit'])){
         $login = $vars['model']->login();
         if($login){
             echo 'вы авторизованы';
         }
    }
?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1>Авторизация:</h1>
                <form method="post">
                    <p><input class="form-control" type="text" placeholder="Логин" name="login"></p>
                    <p><input class="form-control" type="password" placeholder="Пароль" name="password"></p>
                    <input class="btn btn-primary mb-2" type="submit" name="loginSubmit" value="Авторизоваться">
                    <a href="/restore">&nbsp; &nbsp; &nbsp;Забыли пароль?</a><br>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <br><p><a href="/register">Зарегистрируйтесь</a>, если у вас нет акаунта.</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer Start -->
<div class="col-md-12 page-body margin-top-50 footer navbar-fixed-bottom row-fluid">
    <footer>
        <ul class="menu-link">
            <li><a href="/about">О проекте</a></li>
            <li><a href="/feedback">Связаться с нами</a></li>
        </ul>
        <p>© Copyright 2018. All rights reserved</p>
    </footer>
</div>
