<?php
if (isset($_POST['loginSubmit'])){
    $vars['model']->signUp();
    echo 'ok';
}
?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <p><h1>Регистрация:</h1></p>
                <form method="post">
                    <p><input class="form-control" type="text" name="first_name" placeholder="Имя"></p>
                    <p><input class="form-control" type="text" name="last_name" placeholder="Фамилия"></p>
                    <p><input class="form-control" type="text" name="E-mail" placeholder="E-mail"></p>
                    <p><input class="form-control" type="text" name="login" placeholder="Логин"></p>
                    <p><input class="form-control" type="password" name="password" placeholder="Пароль"></p>
                    <p><input class="form-control" type="password" name="password2" placeholder="Пароль"></p>
                    <input class="btn btn-primary mb-2" type="submit" name="loginSubmit" value="Авторизоваться"><br>
                </form>
            </div>
        </div>
    </div>
</div>