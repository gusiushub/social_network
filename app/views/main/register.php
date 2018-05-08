<?php
if (isset($_POST['loginSubmit'])){
    $vars['model']->signUp();
    echo 'ok';
}
//src="../../../template/default/js/reg.js"
?>
<script>
    $(document).ready(function () {
        $("#checkLogin").bind("click", function () {
            $.ajax({
                url:  "check.php",
                type: "POST",
                data: ({name: $("#login").val()}),
                dataType: "html",
                beforeSend: function () {
                    $("#information").text("Ожидание данных...");
                },
                success: function (data) {
                    if (data == "Fail")
                        alert("Логин занят");
                    else
                        $("#information").text(data);
                }
            });
        });
    });
</script>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1>Регистрация:</h1>
                <form method="post">
                    <p><input class="form-control" type="text"     name="first_name" placeholder="Имя"></p>
                    <p><input class="form-control" type="text"     name="last_name"  placeholder="Фамилия"></p>
                    <p><input class="form-control" type="text"     name="E-mail"     placeholder="E-mail"></p>
                    <p><input class="form-control" type="text"     name="login"      placeholder="Логин" id="login"></p>
                    <p>
                        <input class="btn btn-primary mb-2" type="submit" name="checkLogin" id="checkLogin" value="Проверить логин">
                        <div id="information"></div>
                    </p>
                    <p><input class="form-control" type="password" name="password"   placeholder="Пароль"></p>
                    <p><input class="form-control" type="password" name="password2"  placeholder="Пароль"></p>
                    <input    class="btn btn-primary mb-2" type="submit" name="loginSubmit" value="Авторизоваться"><br>
                </form>
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
