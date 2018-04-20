<?php
/**
 * Файл View.php(файл видов)
 * Одина из основных частей структуры MVC
 */

namespace app\core;

class View
{
    public $path;
    public $route;
    /**
     * Переменная для выбора шаблона, которой нужно присвоить лишь
     * название дефолтного html шаблона(****.php файла в котором
     * генерируется весь html с помощью PHP
     */
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path  = $route['controller'].'/'.$route['action'];
    }

    /**
     * @param $title заголовок вкладки доступен в файлах вида как $title
     * меняется из контроллера с помощью метода render
     * @param array $vars переменная для передачи данных или модели в вид
     * используя контроллез
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
     * @param $url адре для автоматического перехода на другую страницу,
     * так же можно использовать для обновления страницы
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

    /**
     * редирект
     * @param $url
     */
    public function location($url)
    {
        exit(json_encode(['url'=>$url]));
    }


}
