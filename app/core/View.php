<?php

namespace app\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path  = $route['controller'].'/'.$route['action'];
    }

    /**
     * @param $title
     * @param array $vars
     */
    public function render($title, $vars = [])
    {
        extract($vars);
        $path = 'app/views/'.$this->path.'.php';
        if (file_exists($path)) {
            // Включение буферизации вывода
            ob_start();
            require $path;
            // Получить содержимое текущего буфера и удалить его
            $content = ob_get_clean();
            require 'app/views/layouts/'.$this->layout.'.php';
        } else{
            echo 'Вид'.$this->path.' не найден';
        }
    }

    /**
     * @param $url
     */
    public static function redirect($url)
    {
        header('Location: '.$url);
    }

    /**
     * @param $code
     */
    public static function errorCode($code)
    {
        http_response_code($code);
        $path = 'app/views/errors/'.$code.'.php';
        if(file_exists($path)) {
            require $path;
        }
        exit;
    }

    /**
     * @param $status
     * @param $message
     */
    public function message($status, $message)
    {
        exit(json_encode(['status'=>$status, 'message'=>$message]));
    }

    //редирект

    /**
     * @param $url
     */
    public function location($url)
    {
        exit(json_encode(['url'=>$url]));
    }


}
