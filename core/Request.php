<?php
namespace MateusVBC\Magazord_Backend\Core;

/**
 * Classe responsavel por realizar as requisições post e get
 */
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

    /**
     * Verifica se o parametro passado na função existe. Permite definir se quer ser buscado dentro do GET ou do POST
     */
    public static function getParam(string $param, bool|null $post = null)
    {
        if ((self::isPost() && is_null($post)) || $post) {
            return !isset($_POST[$param]) ? false : $_POST[$param];
        }
        else if ((self::isPost() && is_null($post)) || !$post) {
            return !isset($_GET[$param]) ? false : $_GET[$param];
        }
    }

    /**
     * Realiza o unset de algum parametro do GET ou POST, permitindo definir se quer ser buscado dentro do GET ou do POST
     */
    public static function unsetParam(string $param, bool|null $post = null)
    {
        if ((self::isPost() && is_null($post)) || $post) {
            if (isset($_POST[$param])) unset($_POST[$param]);
        }
        else if ((self::isPost() && is_null($post)) || !$post) {
            if(isset($_GET[$param])) unset($_GET[$param]);
        }
    }
}