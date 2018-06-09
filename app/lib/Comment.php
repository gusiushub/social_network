<?php

namespace app\lib;

use app\core\Db;
use app\core\View;

class Comment
{
    private $db;

    public function __construct()
    {
        //$this->db = new Db;
    }

    public function addComment($postId)
    {
        if (isset($_POST['commentButton_'.$postId])) {
            return $this->db->insert('comments', array('user_id'   => $_SESSION['id'],
                                                            'post_id' => $postId,
                                                            'text'    => htmlspecialchars($_POST['commentText'])));
            View::redirect('/user/'.$_GET['id']);
        }
    }

    public function userComment($postId)
    {
        return $this->db->queryRows('SELECT * FROM comments WHERE post_id=:post_id
                                            ORDER BY id DESC', array('post_id' => $postId));
    }
}