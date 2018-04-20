<?php
$usersId = $vars['model']->getSubscriptions($_SESSION['id']);
?>
<div class="container">
    <h3>Диалоги:</h3>
    <div class="row">
        <div class="col-lg-3">
            <?php if (empty($usersId)){ ?>
            <h3>У вас нет диалогов, так как вы ни на кого не подписаны.</h3>
            <?php } ?>
            <ul class="list-group">
                <?php  foreach ($usersId as $user) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php $userInfo = $vars['model']->userId($user['friend_id']); ?>
                    <button class="btn btn-outline-light" type="submit" name="list">
                        <a href="/dialog/<?php echo $userInfo['id'] ; ?>/"><?php echo $userInfo['login'];?></a>
                    </button>
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
            <?php } ?>
            </ul>
        </div>
        <div class="col-lg-9">
            <?php
            $colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
            $user_colour = array_rand($colours);
            ?>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
            <script language="javascript" type="text/javascript">
                $(document).ready(function(){
                    //create a new WebSocket object.
                    var wsUri = "ws://localhost:9000/demo/server.php";
                    websocket = new WebSocket(wsUri);

                    websocket.onopen = function(ev) { // connection is open
                        $('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
                    }

                    $('#send-btn').click(function(){ //use clicks message send button
                        var mymessage = $('#message').val(); //get message text
                        var myname = $('#name').val(); //get user name

                        if(myname == ""){ //empty name?
                            alert("Enter your Name please!");
                            return;
                        }
                        if(mymessage == ""){ //emtpy message?
                            alert("Enter Some message Please!");
                            return;
                        }

                        //prepare json data
                        var msg = {
                            message: mymessage,
                            name: myname,
                            color : '<?php echo $colours[$user_colour]; ?>'
                        };
                        //convert and send data to server
                        websocket.send(JSON.stringify(msg));
                    });

                    //#### Message received from server?
                    websocket.onmessage = function(ev) {
                        var msg = JSON.parse(ev.data); //PHP sends Json data
                        var type = msg.type; //message type
                        var umsg = msg.message; //message text
                        var uname = msg.name; //user name
                        var ucolor = msg.color; //color

                        if(type == 'usermsg')
                        {
                            $('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
                        }
                        if(type == 'system')
                        {
                            $('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
                        }

                        $('#message').val(''); //reset text
                    };

                    websocket.onerror   = function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");};
                    websocket.onclose   = function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");};
                });
            </script>

            <div class="chat_wrapper">
                <h3>Общий чат</h3>
                <div class="message_box" id="message_box"></div>
                <div class="panel">
                    <input class="form-control" type="text" name="name" id="name" placeholder="Your Name" maxlength="10" style="width:20%"  />
                    <input class="form-control" type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:60%" />
                    <button class="btn btn-primary" id="send-btn">Send</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

