<?php
use app\core\View;
$usersId = $vars['model']->getSubscriptions($_SESSION['id']);
?>
<div class="container">
    <h3>Диалоги:</h3>
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                <?php foreach ($usersId as $user) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php $userInfo = $vars['model']->userId($user['friend_id']); ?>
                        <button class="btn btn-outline-light" type="submit" name="list">
                            <a href="/dialog/<?php echo $userInfo['id'] ; ?>/"><?php echo $userInfo['login'];?> </a>
                        </button>
                        <span class="badge badge-primary badge-pill">14</span>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-9">
                <div class="chat_wrapper">
                    <div class="message_box" id="message_box">
                        <?php
                        $messages = $vars['model']->getDialog();
                        //var_dump($messages);
                        foreach ($messages as $message){ ?>
                            <h4>
                                <?php if($message['u_from'] == $_SESSION['id']){echo 'Вы:';
                                }elseif($message['u_from'] == $_GET['id']){echo 'Ваш собеседник:';} ?>
                            </h4>
                            <p><?php echo $message['message']; ?></p>
                        <?php } ?>
                        <?php
                        echo '<br>';
                        $vars['model']->sendMessage();echo '<br>';
                        echo '<br>';
                        if(isset($_POST['sms'])){
                            $_SESSION['msg'] = $_POST['message'];
                           View::redirect('/dialog/'.$_GET['id']);
                        }
                        //echo $vars['model']->msgForUser();
                        ?>
                    </div>
                    <div class="panel">
                        <form method="post">
                        <input class="form-control" type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:100%" />
                        <input class="btn btn-primary mb-2" type="submit" name="sms" value="Отправить"><br>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>

