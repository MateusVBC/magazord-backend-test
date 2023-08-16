<?php
namespace MateusVBC\Magazord_Backend\Core;

use MateusVBC\Magazord_Backend\Core\View;

/**
 * Classe controller base
 */
abstract class Controller
{

    private View $View;
    private Session $Session;

    /**
     * Processa tudo relacionado a view
     */
    protected abstract function processView(): void;

    /**
     * Processa tudo relacionado a requisições
     */
    protected abstract function processRequest(): void;

    /**
     * Função de origem a logica do sistema
     */
    public function index()
    {
        if ($this->before()) {
            $this->processRequest();
            $this->processView();
        }
    }

    /**
     * Verifica se está acessando o controller correto, ou se deveria acessar outro
     */
    protected function before()
    {
        $reflectionClass = new \ReflectionClass(get_class($this));
        if (Request::getParam('view', true))
            $this->getSession()->set('view', Request::getParam('view', true));
        if ('Controller' . $this->getSession()->get('view') != $reflectionClass->getShortName()) {
            $nomeController = 'MateusVBC\Magazord_Backend\App\Controller\Controller' . $this->getSession()->get('view');
            $Route = new Router();
            $Controller = new $nomeController();
            $Route->set($Controller, ['function' => 'index', 'params' => '']);
            $Route->dispatch();
            return false;
        }
        return true;
    }

    public function getView(): View
    {
        if (!isset($this->View)) {
            $this->View = new View();
        }
        return $this->View;
    }

    public function getSession(): Session
    {
        if (!isset($this->Session)) {
            $this->Session = new Session();
        }
        return $this->Session;
    }
}