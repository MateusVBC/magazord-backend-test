<?php
namespace MateusVBC\Magazord_Backend\Core;

/**
 * Classe responsavel por lidar com o SESSION do sistema
 */
class Session
{
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return isset($_SESSION[$key]) ? (is_bool($_SESSION[$key]) ? false : $_SESSION[$key]) : false;
    }
}