<?php
namespace MateusVBC\Magazord_Backend\Core;

abstract class Request
{
    public static function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            return true;
        }

        return false;
    }

    public static function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            return true;
        }

        return false;
    }

    public static function getAllParams()
    {
        if (self::isPost()) {
            return $_POST;
        }

        if (self::isGet()) {
            return $_GET;
        }

        return [];
    }

    public static function getParam(string $param, bool|null $post = null)
    {
        if ((self::isPost() && is_null($post)) || $post) {
            return !isset($_POST[$param]) ? false : $_POST[$param];
        }
        else if ((self::isPost() && is_null($post)) || !$post) {
            return !isset($_GET[$param]) ? false : $_GET[$param];
        }
    }
}