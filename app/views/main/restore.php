<?php
if(isset($_POST['restore'])){
    if($_POST['restoreForEmail']){
        $vars['model']->restore();
    }
}
?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h3>Смена пароля:</h3><br><br>
                <form method="post">
                    <input class="form-control" type="email" placeholder="Введите ваш email" name="restoreForEmail"><br>
                    <input class="btn btn-primary mb-2" type="submit" name="restore" value="Отправить">
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
