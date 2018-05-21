<?php
use app\assets\defaultAssets;
?>
<!DOCTYPE html>
<html lang="ru">
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
    <link rel="shortcut icon" href="../../../template/default/images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="../../../template/default/images/favicon/apple-touch-icon.png">
    <!-- All CSS Plugins -->
    <?php defaultAssets::css(); ?>
    <!-- Google Web Fonts  -->
    <?php defaultAssets::cssLink(); ?>
    <?php defaultAssets::jsLink(); ?>
</head>
    <body>
        <!-- Preloader Start -->
        <div class="preloader">
            <div class="rounder"></div>
        </div>
        <!-- Preloader End -->
        <!--Меню-->
        <ul class="menu-link">
            <?php if(isset($_SESSION['id'], $_SESSION['login'])) { ?>
            <li><a href="/user/<?php echo $_SESSION['id'] ?>/">Профиль [<?php echo $_SESSION['login']; ?>]</a></li>
            <li><a href="/dialog">Сообщения</a></li>
            <li><a href="/subscribers/<?php echo $_SESSION['id']; ?>/" >Подписчики</a></li>
            <li><a href="/subscriptions/<?php echo $_SESSION['id']; ?>" >Подписки</a></li>
            <li><a href="/all">Пользователи</a></li>
            <?php } ?>
            <?php if(!isset($_SESSION['id'], $_SESSION['login'])){ ?>
                <li><a href="/">Авторизация</a></li>
                <li><a href="/register/">Регистрация</a></li>
                <li><a href="/all">Пользователи</a></li>
                <li><a href="/about">О проекте</a></li>
                <li><a href="/contact">Контакты</a></li>
            <?php } ?>
            <?php if(isset($_SESSION['id'], $_SESSION['login'])){ ?>
                <li><a href="/logout">Выход</a></li>
            <?php } ?>
        </ul>
        <!--Конец меню-->

        <!--Контент-->
        <?php echo $content; ?>
        <!--Контент конец-->

        <a href="#" class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></a>

        <!-- All Javascript Plugins  -->
        <?php defaultAssets::js(); ?>
    </body>
</html>
<script type="text/javascript">

    $(document).ready(function() {
        $(".like").click(function () {
            var post_id = $(this).attr("id");
            like($(this).attr("id"));
        });
    });

    function like(id) {
        var uri = id.slice(-2);
        $.ajax({
            url: "/like/"+uri,
            type: "POST",
            data: {'post_id': id},
            dataType: "json",
            success: function(data) {
                if(data.result == 'success'){
                    var count = parseInt($("#likes"+uri).html());
                    $("#likes"+uri).html(count+1);
                }else{
                    alert("Error");
                }
            }
        });
    }
</script>
<script src="../../ajax/like.js" type="text/javascript"></script>