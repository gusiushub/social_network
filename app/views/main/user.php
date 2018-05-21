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
                            <?php if($vars['model']->activeStatus()==1) { ?>
                            <small>Online</small>
                            <?php } else { ?>
                            <small>Offline</small>
                            <?php } ?>
                            <h1><?php echo $user['first_name'].' '.$user['last_name']; ?></h1>
                            <?php if($_SESSION['id']!=$_GET['id']) { ?>
                           <form method="POST">
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
                                <?php $blogName = $vars['model']->getBlogName($_GET['id']);?>
                            <ul style="float: left">
                                <h3>Основная информация:</h3><hr>
                                <li>Страна:</li>
                                <li>Город:</li>
                                <li>Дата рождения:</li>
                            </ul>

                            <a href="/dialog"><i class="icon-envelope"></i></a>
                        </div>
                        <!-- Blog Post Start -->
                        <?php if($_SESSION['id'] == $_GET['id']) { ?>

                        <form method="POST">
                            <input type="text" class="form-control" name="title" placeholder="Заголовок">
                            <p> <textarea type="text" class="form-control" name="content" placeholder="Контент"></textarea></p>
                            <p>
                                <input type="file"  name="postFile" style="float: left">
                                <input type="submit" class="btn btn-primary" name="post" style="float: right;" value="Опубликовать">
                            </p>
                        </form>
                        <?php } ?>
                        <h1 class="display-2"><?php echo $blogName['blog_name'] ;?></h1>
                        <div class="col-md-12 content-page">
                            <?php
                            $postVar = $vars['model'];
                            $vars = $vars['model']->userPosts();
                            //$likes = $var['model']->getLike($id);
                            foreach($vars as $var){
                                if($_GET['id'] == $_SESSION['id']) {
                                    if (isset($_POST['del'.$var['id']])) {
                                        $postVar->deletePost($var['id']);
                                        View::redirect('/user/' . $_SESSION['id']);
                                    }
                                } ?>
                                <input type="hidden" value="<?php echo $var['id'] ;?>" id="post_id">
                                <div class="post-title">
                                    <a href="#"><h1><?php  echo $var['title'];?></h1></a>
                                </div>
                                <div class="post-info">
                                    <span><?php echo $var['date']; ?>/ by <a href="#" target="_blank"><?php echo $user['first_name'].' '.$user['last_name'] ?></a></span>
                                </div>
                                <p class="text-center" ><?php echo $var['content']; ?></p>
                                <?php if($_SESSION['id'] == $_GET['id']) { ?>
                                <form method="POST">
                                    <input name="<?php echo 'del'.$var['id']?>" class="btn btn-outline-light" type="submit" value="Удалить" style="float: right;">
                                </form>
                                <?php } ?>
                                <?php $postVar->addComment($var['id']); ?>
                                <div class="like" id="<?php echo 'like'.$var['id']; ?>">Like[<b  id="<?php echo 'likes'.$var['id']; ?>"><?php  echo $var['likes']; ?></b>]</div>
                                <div id="addCommentContainer">
                                    <h3>Комментарии</h3>
                                    <form id="<?php echo 'commentButtonForm'.$var['id']; ?>" class="commentButtonForm" method="POST" action="">
                                        <p> <textarea type="text" class="form-control" id="commentText" name="commentText" placeholder="Написать комментарий"></textarea></p>
                                        <p class="commentBut"><input type="submit"  id="<?php echo 'commentBut'.$var['id']; ?>" class="btn btn-primary" name="<?php echo 'commentButton_'.$var['id'] ?>" style="float: right;" value="Отправить"></p>
                                    </form>
                                </div>
                                    <?php $comments = $postVar->getComment($var['id']);
                                        for ($i=0;$i<count($comments);$i++)
                                        { ?>
                                            <div class="container">
                                                <div class="row align-items-start">
                                                    <div class="col-md">
                                                        <h4 ><?php echo $user['login']; ?></h4>
                                                    </div>
                                                    <div class="col-md">
                                                        <img style="width: 64px"  src="<?php echo '../../../public/avatars/'.$user['avatar']?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-5">
                                                    <div id="<?php echo 'comtText'.$var['id']; ?>">
                                                        <?php
                                                        $userId = (int)$comments[$i]['user_id'];
                                                        $user = $postVar->userId($userId);
                                                        echo $comments[$i]['text']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            <?php } ?>
                            <!--load-more-post-->
                            <div class="col-md-12 text-center">
                                <a href="javascript:void(0)" id="load-more-post" class="load-more-button">Load</a>
                                <div id="post-end-message"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Blog Post End -->
                </div>
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
            </div>
        </div>
    </div>