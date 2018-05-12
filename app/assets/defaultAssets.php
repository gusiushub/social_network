<?php
/**
 * Стили приложения
 */

namespace app\assets;

class defaultAssets
{
    static function css()
    {
        foreach (self::setStyle() as $style){
            echo $style;
        }
    }

    static function cssLink()
    {
        foreach (self::setStyleLink() as $style){
            echo $style;
        }
    }

    static function js()
    {
        foreach (self::setJs() as $js){
            echo $js;
        }
    }

    static function jsLink()
    {
        foreach (self::setJavaScriptLink() as $js){
            echo $js;
        }
    }

    static function setStyle()
    {
        return array(
            '<link rel="stylesheet" type="text/css" href="../../template/default/css/main.css">',
            '<link rel="stylesheet" type="text/css" href="../../template/default/css/plugin.css">',
            '<link rel="stylesheet" type="text/css" href="../../template/default/css/style.css">',
            '<link rel="stylesheet" type="text/css" href="../../template/default/css/chat.css">'
        );
    }

    static function setStyleLink()
    {
        return array(
            '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">'
        );
    }

    static function setJavaScriptLink()
    {
        return array(
            '<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>',
            '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>'
        );
    }

    static function setJs()
    {
        return array(
            '<script src="http://code.jquery.com/jquery-1.8.3.js"></script>',
            '<script type="text/javascript" src="../../template/default/js/jquery.min.js"></script>',
            '<script type="text/javascript" src="../../template/default/js/plugin.js"></script>',
            '<script type="text/javascript" src="../../template/default/js/scripts.js"></script>',
            //'<script type="text/javascript" src="../ajax/comment.js" ></script>'
        );
    }
}