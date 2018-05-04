<?php

/***
 * Класс для работы со статьями
 */

namespace app\lib;

use app\core\Db;

class Article
{
    public $db;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->db = new Db;
    }

    /**
     * @return null
     */
    public function post()
    {
        if (isset($_POST['title'] , $_POST['content'])) {
            return $this->db->insert('posts', array(   'title'   => htmlspecialchars($_POST['title']),
                                                            'content' => htmlspecialchars($_POST['content']),
                                                            'date'    => htmlspecialchars(date('Y-m-d',time())),
                                                            'user_id' => htmlspecialchars($_SESSION['id'])));
        }
        echo 'Заполните все поля поля!';
    }

    /**
     * @return null
     */
    public function userPosts()
    {
        return $this->db->queryRows('SELECT * FROM posts WHERE user_id=:id
                                            ORDER BY id DESC', array('id' => $_GET['id']));
    }

    /**
     * @param $id
     */
    public function delPost($id)
    {
        return $this->db->delete("posts", $id);
    }

}