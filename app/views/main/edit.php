<?php
use app\core\View;
if (isset($_POST['avatarLoad'])){
    $upload = $vars['model']->upLoadFile();
    $_SESSION['avatar'] = $upload;
    $vars['model']->updateAvatar($upload);
    View::redirect('/edit/');
}
if (isset($_POST['saveNameBlog']) && $_POST['nameBlog'] != '' && $_POST['nameBlog']!=null){
    $vars['model']->updateBlogName();
    View::redirect('/edit/');
}
?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-5">
                <?php echo 'Здравствуйте,'.$_SESSION['first_name'].', ваш';?><br>
                <?php echo 'ip адрес сервера: '.$_SERVER['SERVER_ADDR']; ?>
                <p><h2>Редактировать профиль:</h2></p><br>
                <form enctype="multipart/form-data" method="post">
                    <h3>Название блога</h3>
                    <p>
                        <input class="form-control" type="text" name="nameBlog" placeholder="Название блога">
                        <input class="btn btn-primary mb-2" type="submit" name="saveNameBlog" value="Сохранить"><br>
                    </p><br>
                </form>
                <form enctype="multipart/form-data" method="post">

                <h3>Сменить аватарку</h3>
                    <p>
                        <input type="file" class="fileForm" name="avatar" >
                        <input type="submit" class="btn btn-primary" name="avatarLoad">
                    </p><br>
                </form>
                <form enctype="multipart/form-data" method="post">

                    <h3>Сменить пароль</h3>
                    <p>
                        <input class="form-control" type="text" name="last_name" placeholder="Введите пароль"><br>
                        <input class="form-control" type="text" name="E-mail" placeholder="Повторите пароль"><br>
                        <input class="btn btn-primary mb-2" type="submit" name="savePass" value="Сохранить"><br>
                    </p>
                </form>
                <h3>Активность</h3>
            </div>
        </div>
    </div>
</div
<!-- Footer Start -->
<div class="col-md-12 page-body margin-top-50 footer ">
    <footer>
        <ul class="menu-link">
            <li><a href="/about">О проекте</a></li>
            <li><a href="/feedback">Связаться с нами</a></li>
        </ul>
        <p>© Copyright 2018. All rights reserved</p>
    </footer>
</div>
