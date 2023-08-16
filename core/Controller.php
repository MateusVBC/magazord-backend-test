<?php
namespace MateusVBC\Magazord_Backend\Core;

use MateusVBC\Magazord_Backend\Core\View;

abstract class Controller
{

    private View $View;

    protected abstract function processView(): void;

    protected abstract function processRequest() : void;

    public function index()
    {
        if($this->before()) {
            $this->processRequest();
            $this->processView();
        }
    }

    protected function before()
    {
        $reflectionClass = new \ReflectionClass(get_class($this));
        $Session = new Session();
        if(Request::getParam('view', true)) $Session->set('view', Request::getParam('view', true));
        if('Controller'.$Session->get('view') != $reflectionClass->getShortName()) {
            $nomeController = 'MateusVBC\Magazord_Backend\App\Controller\Controller'.$Session->get('view');
            $Route = new Router();
            $Controller = new $nomeController();
            $Route->set($Controller, ['function' => 'index', 'params' => '']);
            $Route->dispatch();
            return false;
        }
        return true;
    }

    public function getView()
    {
        if (!isset($this->View)) {
            $this->View = new View();
        }
        return $this->View;
    }
}