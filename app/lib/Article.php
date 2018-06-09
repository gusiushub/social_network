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
        //$this->db = new Db;
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
     * @return mixed|void
     */
    public function delPost($id)
    {
        $this->db->delete("comments",'post_id', $id);
        return $this->db->delete("posts",'id', $id);
    }

    public function getLike($post_id)
    {
        return $this->db->queryRows('SELECT likes FROM posts WHERE id=:post_id', array('post_id' => $post_id));
    }

    public function setLike($post_id)
    {
        $likes = $this->getLike($post_id);
        $like = (int)$likes[0]['likes']+1;
        $this->db->update('posts', array('likes'=>$like),'id=:post_id', array(':post_id' => $post_id));
    }

}