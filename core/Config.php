<?php
namespace MateusVBC\Magazord_Backend\Core;

/**
 * Classe com as configurações usadas
 */
class Config
{
    const DB_DRIVER = 'mysql';
    const ORM_DRIVER = 'pdo_mysql';
    const DB_HOST = 'localhost';
    const DB_NAME = 'magazord';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_CHARSET = 'utf8';
    const SHOW_ERRORS = false;
    const DEFAULT_LANGUAGE = "pt_BR";
    const LANGUAGES = ['pt_BR', 'en_US'];
    const DEFAULT_VIEW = 'Home';
    const ACTION_DELETE = 'delete';
    const ACTION_UPDATE = 'update';
    const ACTION_INSERT = 'insert';
    const OPTIONS_COLUMNS = [
        <<<EOD
        <button type="submit" class="btn" id="updateButton?id?" formaction="?action=update&id=?id?" hidden>
            <img src='app/view/img/refresh.png' style="width:10px;height:10px;"></img>
        </button>
        EOD,
        <<<EOD
        <button class="btn" type="submit" formaction="?action=delete&id=?id?">
            <img src='app/view/img/delete.png' class="icon"></img>
        </button>
        EOD
    ];
}