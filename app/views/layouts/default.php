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
        // $('.like').live('click', function() {
        //
        //     alert($(this).attr("id"));
        // });
        $(".like").click(function () {
           // var post_id = $('#post_id').val();
            var post_id = $(this).attr("id");
            //alert(post_id);
           like($(this).attr("id"));
        });
    });
    
    function like(id) {
        //alert(id.slice(-2));
           // var post_id = $(this).attr("id");
        var uri = id.slice(-2);
            $.ajax({
                url: "/like/"+uri,
                type: "POST",
                data: {'post_id': id},
                dataType: "json",
                success: function(data) {
                    if(data.result == 'success'){
                        alert(id);
                        var count = parseInt($("#likes"+uri).html());
                        alert(count);
                        $("#likes"+uri).html(count+1);
                    }else{
                        // вывод сообщения об ошибке
                      //  alert("Error");
                    }
                }
            });
    }


    // $(document).ready(function(){
    //     /* Следующий код выполняется только после загрузки DOM */
    //     /* Данный флаг предотвращает отправку нескольких комментариев: */
    //     var working = false;
    //     /* Ловим событие отправки формы: */
    //     $('#commentButtonForm').submit(function(e){
    //         e.preventDefault();
    //         if(working) return false;
    //         working = true;
    //         $('#commentBut').val('Working..');
    //         $('span.error').remove();
    //         /* Отправляем поля формы в submit.php: */
    //         $.post('/comment/',$(this).serialize(),function(msg){
    //
    //             working = false;
    //             $('#commentBut').val('Submit');
    //
    //             if(msg.status){
    //
    //                 /*
    //                 /	Если вставка была успешной, добавляем комментарий
    //                 /	ниже последнего на странице с эффектом slideDown
    //                 /*/
    //
    //                 $(msg.html).hide().insertBefore('#addCommentContainer').slideDown();
    //                 $('#commentText').val('');
    //             }
    //             else {
    //
    //                 /*
    //                 /	Если есть ошибки, проходим циклом по объекту
    //                 /	msg.errors и выводим их на страницу
    //                 /*/
    //
    //                 $.each(msg.errors,function(k,v){
    //                     $('label[for='+k+']').append('<span class="error">'+v+'</span>');
    //                 });
    //             }
    //         },'json');
    //
    //     });
    //
    // });

</script>
<script type="text/javascript">


    // ставим обработчики на фазе перехвата, последний аргумент true
    // commentButtonForm.addEventListener("focus", function() {
    //     alert('adsasd');
    //     //this.classList.add('focused');
    // }, true);
    //
    // commentButtonForm.addEventListener("blur", function() {
    //     //this.classList.remove('focused');
    // }, true);

        // $("#commentText").click(function () {
        //     //alert('asdasd');
        //     $("#commentButtonForm").show('<p><input type="submit" id="commentBut" class="btn btn-primary" name="commentButton" style="float: right;" value="Отправить"></p>');
        // });

        // $(init);
        //
        // function init() {
        //     $("#commentButtonForm").bind("click", pulsate);
        // }
        //
        // function pulsate() {
        //     $(this).fadeOut();
        //     $(this).fadeIn();
        // }
</script>