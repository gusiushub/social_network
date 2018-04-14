<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- SEO -->
    <meta name="description" content="150 words">
    <meta name="author" content="uipasta">
    <meta name="url" content="http://www.yourdomainname.com">
    <meta name="copyright" content="company name">
    <meta name="robots" content="index,follow">
    <title><?php echo $title; ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../../../template/DevBlog/images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="../../../template/DevBlog/images/favicon/apple-touch-icon.png">
    <!-- All CSS Plugins -->
    <link rel="stylesheet" type="text/css" href="../../../template/DevBlog/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../../template/DevBlog/css/plugin.css">
    <!-- Main CSS Stylesheet -->
    <link rel="stylesheet" type="text/css" href="../../../template/DevBlog/css/style.css">
    <!-- Google Web Fonts  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader Start -->
<div class="preloader">
    <div class="rounder"></div>
</div>
<!-- Preloader End -->
<!--Меню-->
<ul class="menu-link">
    <?php if(isset($_SESSION['id']) && isset($_SESSION['login'])){ ?>
    <li><a href="/user/<?php echo $_SESSION['id'] ?>">Профиль [<?php echo $_SESSION['login']; ?>]</a></li>
    <li><a href="about.html">Сообщения</a></li>
    <li><a href="about.html">Подписчики</a></li>
    <li><a href="about.html">Подписки</a></li>
    <li><a href="all">Пользователи</a></li>
    <?php } ?>
    <?php if(empty($_SESSION['id']) && empty($_SESSION['login'])){ ?>
        <li><a href="work.html">Регистрация</a></li>
        <li><a href="work.html">Пользователи</a></li>
        <li><a href="work.html">О проекте</a></li>
        <li><a href="work.html">Контакты</a></li>
    <?php } ?>
    <?php if(isset($_SESSION['id']) && isset($_SESSION['login'])){ ?>
        <li><a href="/logout">Выход</a></li>
    <?php } ?>
</ul>

<!--Контент-->
<?php echo $content; ?>


<?php if(isset($_SESSION['id']) && isset($_SESSION['login'])){ ?>
<!-- Footer Start -->
<div class="col-md-12 page-body margin-top-50 footer">
    <footer>
        <ul class="menu-link">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="work.html">Work</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <p>© Copyright 2018. All rights reserved</p>
        <!-- UiPasta Credit Start -->
        <div class="uipasta-credit">Design By <a href="http://www.uipasta.com" target="_blank">UiPasta</a></div>
        <!-- UiPasta Credit End -->
    </footer>
</div>
<?php } ?>
<!-- Footer End -->
</div>
<!-- Blog Post (Right Sidebar) End -->
</div>
</div>
</div>
<!-- Back to Top Start -->
<a href="#" class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></a>
<!-- Back to Top End -->

<!-- All Javascript Plugins  -->
<script type="text/javascript" src="../../../template/DevBlog/js/jquery.min.js"></script>
<script type="text/javascript" src="../../../template/DevBlog/js/plugin.js"></script>
<!-- Main Javascript File  -->
<script type="text/javascript" src="../../../template/DevBlog/js/scripts.js"></script>
</body>
</html>
