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
                <p><h1>Авторизация:</h1></p>
                <form method="post">
                    <p><input class="form-control" type="text" placeholder="Логин" name="login"></p>
                    <p><input class="form-control" type="password" placeholder="Пароль" name="password"></p>
                    <input class="btn btn-primary mb-2" type="submit" name="loginSubmit" value="Авторизоваться">
                    <a href="/register">&nbsp; &nbsp; &nbsp;забыл пароль</a><br>
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