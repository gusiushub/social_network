<?php

$userId = $vars['model']->getSubscribers();

?>
<div class="container">
    <h2>Подписчики</h2>
    <ul>
        <?php foreach ($userId as $users){
        $user = $vars['model']->Subscribers($users['user_id']);
        ?>
            <li>
                <div class="media">
                    <img width="64px" class="mr-3" src="../../../public/avatars/<?php echo $user['avatar'] ?>" alt="avatar image">
                    <div class="media-body">
                        <h5 class="mt-0"><a href="<?php  echo $user['id']; ?>"><?php echo $user['last_name'].' '.$user['first_name'] ;?></a></h5>
                        <button  class="btn btn-primary"><a href="<?php echo $user['id']; ?>">Профиль</a> </button>
                        <button  class="btn btn-primary"><a href="<?php echo $user['id']; ?>">Написать</a> </button>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>