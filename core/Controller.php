<?php
namespace MateusVBC\Magazord_Backend\Core;

use MateusVBC\Magazord_Backend\Core\View;

abstract class Controller
{

    private View $View;

    protected abstract function processView(): void;

    public function index()
    {
        $this->before();
        $this->processView();
    }

    protected function before()
    {
        $reflectionClass = new \ReflectionClass(get_class($this));
        if('Controller'.$_SESSION['view'] != $reflectionClass->getShortName()) {
            $nomeController = 'Controller'.$_SESSION['view'];
            $Route = new Router();
            $Controller = new $nomeController();
            $Route->set($Controller, ['function' => 'index', 'params' => '']);
            $Route->dispatch();
        }
    }


    protected function getLanguage()
    {
        return $_COOKIE['language'] ?? Config::DEFAULT_LANGUAGE;
    }

    protected function setLanguage($lang)
    {
        if (in_array($lang, Config::LANGUAGES)) {
            setcookie('language', $lang, time() + 3600 * 24 * 30);
        }
    }

    public function getView()
    {
        if (!isset($this->View)) {
            $this->View = new View();
        }
        return $this->View;
    }
}