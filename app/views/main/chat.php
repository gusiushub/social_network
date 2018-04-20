<?php
$usersId = $vars['model']->getSubscriptions($_SESSION['id']);
?>
<div class="container">
    <h3>Диалоги:</h3>
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                <?php foreach ($usersId as $user) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php $userInfo = $vars['model']->userId($user['friend_id']);

                        ?>
                        <button class="btn btn-outline-light" type="submit" name="list">
                            <a href="/dialog/<?php echo $userInfo['id'] ; ?>/"><?php echo $userInfo['login'];?></a>
                        </button>
                        <span class="badge badge-primary badge-pill">14</span>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-9">
            <form method="post">
                <div class="chat_wrapper">
                    <?php
                    if(isset($_POST['sms'])){


                    ?>
                    <div class="message_box" id="message_box">
                        <?php
                        echo '<br>';
                        $vars['model']->sendMessage();echo '<br>';
                        $vars['model']->msgForUser();
                        $vars['model']->toUser();
                       // $vars['model']->readMessage();
                        echo '<br>';
                        }
                        ?></div>
                    <div class="panel">

                        <input class="form-control" type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:100%" />
                        <input class="btn btn-primary mb-2" type="submit" name="sms" value="Отправить"><br>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

