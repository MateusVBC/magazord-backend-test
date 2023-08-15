<?php
namespace MateusVBC\Magazord_Backend\Core;

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
}