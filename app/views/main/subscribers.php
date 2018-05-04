<?php $userId = $vars['model']->getSubscribers(); ?>
<div style="text-align: center;" class="container">
    <h1>Подписчики</h1><br>
    <div>
        <form method="POST">
            <div class="col-md-4"></div>
            <div class="row align-self-center">
                <div class="col-md-4">
                    <input class="form-control" type="search" name="searchUser" placeholder="Найти пользователя" style="width: 80%; float: left;">
                    <input class="btn btn-primary" type="submit" name="searchSubmit" value="Найти" style="padding: 18px 13px 8px 13px;  float: right;">
                </div>
            </div>
            <div class="col-md-4"></div>
        </form>
    </div>
    <?php if(empty($userId)){ ?>
    <h3>У вас нет подписчиков...</h3>
    <?php } ?>
    <ul style="list-style-type: none;">
        <?php foreach ($userId as $users) { $user = $vars['model']->Subscribers($users['user_id']); ?>
            <hr>
            <li>
                <div class="media">
                    <div class="media-body">
                        <h3 class="mt-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <img style="float: left;" width="120px" class="mr-3" src="../../../public/avatars/<?php echo $user['avatar'] ?>" alt="avatar image">
                                </div>
                                <div class="col-md-4">
                                    <a style="padding: 50px;" href="<?php  echo $user['id']; ?>">
                                        <?php echo $user['last_name'].' '.$user['first_name'] ;?>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <button  class="btn btn-primary">
                                        <a href="/user/<?php echo $user['id']; ?>/">Профиль</a>
                                    </button>
                                    <button  class="btn btn-primary">
                                        <a href="/user/<?php echo $user['id']; ?>/">Написать</a>
                                    </button>
                                </div>
                            </div>
                        </h3>
                    </div>
                </div>
            </li>
            <hr>
        <?php } ?>
    </ul>
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
