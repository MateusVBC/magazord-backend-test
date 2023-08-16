<?php
namespace MateusVBC\Magazord_Backend\App\Controller;

use MateusVBC\Magazord_Backend\App\Model\Pessoa;
use MateusVBC\Magazord_Backend\Core\Config;
use MateusVBC\Magazord_Backend\Core\Session;
use MateusVBC\Magazord_Backend\Core\Request;
use MateusVBC\Magazord_Backend\Core\Controller;

/**
 * Arquivo controller da pessoa
 */
class ControllerPessoa extends Controller
{

    protected function processView(): void
    {
        $this->getView()->setColumn(['Id', 'Nome', 'Cpf']);
        $this->getView()->setRow((new Pessoa())->getAll());
        $this->getView()->render();
    }

    protected function processRequest(): void
    {
        if (Request::getParam('action', false)) {
            $ModelPessoa = new Pessoa();
            switch (Request::getParam('action', false)) {
                case Config::ACTION_DELETE:
                    $ModelPessoa->setId(Request::getParam('id', false));
                    $ModelPessoa->delete();
                    break;
                case Config::ACTION_UPDATE:
                    $ModelPessoa->setId(Request::getParam('id', false));
                    $ModelPessoa->refresh();
                    foreach (Request::getAllParams() as $column => $value) {
                        if (is_callable([$ModelPessoa, 'set' . $column])) {
                            $ModelPessoa->{'set' . $column}($value);
                        }
                    }
                    $ModelPessoa->update();
                    break;
                case Config::ACTION_INSERT:
                    foreach (Request::getAllParams() as $column => $value) {
                        if (is_callable([$ModelPessoa, 'set' . $column])) {
                            $value = str_replace(['.', '-'], '', $value);
                            $ModelPessoa->{'set' . $column}($value);
                        }
                    }
                    $ModelPessoa->insert();
                    break;
            }
        }
        if (Request::getParam('search', false)) {
            $this->getSession()->set('view', Request::getParam('search', false));
            Request::unsetParam('search', false);
        }
        else if (Request::getParam('add', false)) {            
            $this->getView()->setView(Request::getParam('add', false) . 'Cadastro');
            Request::unsetParam('add');
            Session::set('view', 'Pessoa');
        }
    }
}