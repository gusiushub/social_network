<?php

namespace app\lib;

use app\core\Db;

class Article
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    /**
     * @return null
     */
    public function post()
    {
        if (isset($_POST['title'], $_POST['content'])) {
            return $this->db->insert('posts', array(  'title' => $_POST['title'],
                'content' => $_POST['content'],
                'date' => date('Y-m-d',time()),
                'user_id' => $_SESSION['id']));
        }
        echo 'заполните все поля поля';
    }

    public function deleteArticle($id)
    {
        //
    }

    /**
     * @return null
     */
    public function userPosts()
    {
        return $this->db->queryRows('SELECT * FROM posts WHERE user_id=:id
                                            ORDER BY id DESC', array('id' => $_GET['id']));
    }

}