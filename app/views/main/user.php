<?php

use app\core\View;

$user = $vars['model']->userId(htmlspecialchars($_GET['id']));

if(isset($_POST['post'])){
    $vars['model']->post();
    View::redirect('/user/'.$_SESSION['id']);
}

if(isset($_POST['addFriend'])){
        $vars['model']->addFriend();
        View::redirect('/user/'.$_GET['id']);
}
?>
<div id="main">
    <div class="container">
        <div class="row">
            <!-- About Me (Left Sidebar) Start -->
            <div class="col-md-3">
                <div class="about-fixed">
                    <div class="my-pic">
                        <?php if($user['avatar']==''){ ?>
                        <img height="350px" src="../../../public/avatars/none.png" alt="">
                        <?php } else{ ?>
                        <img height="350px" src="../../../public/avatars/<?php echo $user['avatar'] ?>" alt="">
                        <?php } ?>
                        <a href="javascript:void(0)" class="collapsed" data-target="#menu" data-toggle="collapse"><i class="icon-menu menu"></i></a>
                        <div id="menu" class="collapse">
                            <ul class="menu-link">
                                <li><a href="about.html">About</a></li>
                                <li><a href="work.html">Work</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="my-detail">
                        <div class="white-spacing">
                            <?php if($vars['model']->ActiveStatus()==1) { ?>
                            <small>Online</small>
                            <?php } else { ?>
                            <small>Offline</small>
                            <?php } ?>
                            <h1><?php echo $user['first_name'].' '.$user['last_name']; ?></h1>
                            <?php if($_SESSION['id']!=$_GET['id']) { ?>
                           <form method="post">
                               <button name="sms" class="btn btn-primary" type="submit" href="#"><a href="/dialog/<?php echo $_GET['id'];?>/">Написать</a></button>
                               <?php
                               $findFriend = $vars['model']->findFriend();
                               if($findFriend==false){ ?>
                               <input type="submit" href="#" name="addFriend" class="btn btn-primary" value="Подписаться">
                               <?php } ?>
                           </form>
                            <?php } ?>
                            <?php if($_SESSION['id']==$_GET['id']) { ?>
                            <small><a class="btn btn-outline-light" href="/edit/">Редактировать профиль</a> </small>

                        <?php } ?>
                                <br><small><a href="/subscribers/<?php echo $_GET['id']; ?>" >Подписчики</a> </small> (<?php echo $vars['model']->countSubscribers(); ?>)
                                <br><small><a href="/subscriptions/<?php echo $_GET['id']; ?>">Подписки</a> </small> (<?php echo $vars['model']->countFriends(); ?>)
                        </div>
                        <ul class="social-icon">
                            <li><a href="#" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank" class="github"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- About Me (Left Sidebar) End -->

            <!-- Blog Post (Right Sidebar) Start -->
            <div class="col-md-9">
                <div class="col-md-12 page-body">
                    <div class="row">
                        <div class="sub-title">
                            <h2><?php
                                $blogName = $vars['model']->getBlogName($_GET['id']);
                                echo $blogName['blog_name'] ;
                            ?></h2>
                            <a href="/dialog"><i class="icon-envelope"></i></a>
                        </div>

                        <!-- Blog Post Start -->
                        <?php if($_SESSION['id'] == $_GET['id']) { ?>
                        <form method="POST">
                            <input type="text" class="form-control" name="title" placeholder="Заголовок">
                            <p> <textarea type="text" class="form-control" name="content" placeholder="Контент"></textarea></p>
                            <p><input type="submit" class="btn btn-primary" name="post" style="float: right;" value="Опубликовать"></p>
                        </form>
                        <?php } ?>
                        <div class="col-md-12 content-page">
                            <?php foreach($vars['model']->userPosts() as $var){ ?>
                            <div class="col-md-12 blog-post">
                                <div class="post-title">
                                    <a href="single.html"><h1><?php echo $var['title']; ?></h1></a>
                                </div>
                                <div class="post-info">
                                    <span><?php echo $var['date']; ?>/ by <a href="#" target="_blank"><?php echo $user['first_name'].' '.$user['last_name'] ?></a></span>
                                </div>
                                <p class="text-center" ><?php echo $var['content']; ?></p>
                                <a href="single.html" class="button button-style button-anim fa fa-long-arrow-right"><span>Read More</span></a>
                                <?php if($_GET['id'] == $_SESSION['id']){ ?>
                                <form method="post">
                                    <?php
                                    if (isset($_POST['del'])){
                                        $vars['model']->deletePost($var['id']);
                                        View::redirect('/user/'.$_SESSION['id']);
                                    }
                                    ?>
                                    <input name="del" class="btn btn-outline-light" type="submit" value="Удалить">
                                </form>
                                <?php } ?>
                            </div>
                            <?php } ?>

<!--                            load-more-post-->
                            <div class="col-md-12 text-center">
                                <a href="javascript:void(0)" id="load-more-post" class="load-more-button">Load</a>
                                <div id="post-end-message"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Blog Post End -->

                    <!-- Subscribe Form Start -->
                    <div class="col-md-8 col-md-offset-2">
                        <form id="mc-form" method="post" action="http://uipasta.us14.list-manage.com/subscribe/post?u=854825d502cdc101233c08a21&amp;id=86e84d44b7">

                            <div class="subscribe-form margin-top-20">
                                <input id="mc-email" type="email" placeholder="Email Address" class="text-input">
                                <button class="submit-btn" type="submit">Submit</button>
                            </div>
                            <p>Subscribe to my weekly newsletter</p>
                            <label for="mc-email" class="mc-label"></label>
                        </form>
                    </div>
                    <!-- Subscribe Form End -->
                </div>