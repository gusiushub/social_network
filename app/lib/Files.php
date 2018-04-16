<?php


namespace app\lib;

use app\core\Db;

class Files
{
    private $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    public function upLoad()
    {
        // проверяем, что есть файл
        if((!empty($_FILES["avatar"])) && ($_FILES['avatar']['error'] == 0)) {
            ini_set('memory_limit', '32M');
            // проверяем, что файл это изображение JPEG и его размер не больше 350кб
            $filename = basename($_FILES['avatar']['name']);
            $type = strtolower(substr($filename, strrpos($filename, '.') + 1));
            $nameFile="file-" . time() . "." . $type;
            if (($type == "jpg") && ($_FILES["avatar"]["type"] == "image/jpeg") && ($_FILES["avatar"]["size"] < 3500000000000)) {
                // путь для сохранения файла
                $newName = dirname(__FILE__).'/../../public/avatars/'.$nameFile;//$filename;
                // проверяем, файл с таким названием уже есть на сервере
                if (!file_exists($newName)) {
                    // переместить загруженный файл в новое место
                    if ((move_uploaded_file($_FILES['avatar']['tmp_name'],$newName))) {
                        echo "Прелестно, файл был загружен: ".$newName;
                        return $nameFile;
                        //View::redirect('/user/'.$_SESSION['id']);
                    } else {
                        echo "Произошла ошибка при загрузке файла!";
                    }
                } else {
                    echo "Ошибка: файл ".$_FILES["avatar"]["name"]." уже существует";
                }
            } else {
                echo "Ошибка при загрузке файла, изображение не .jpg или больше чем 350кб.";
            }
        } else {
            echo "Ошибка: файл не загружен!";
        }
    }

    public function updateAvatar($filename)
    {
        return $this->db->update('users', array('avatar' => $filename), 'id=:id', array(':id' => $_SESSION['id']));
    }
}