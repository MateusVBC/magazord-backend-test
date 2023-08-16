<?php
namespace MateusVBC\Magazord_Backend\App\Controller;

use MateusVBC\Magazord_Backend\App\Model\Contato;
use MateusVBC\Magazord_Backend\Core\Config;
use MateusVBC\Magazord_Backend\Core\Session;
use MateusVBC\Magazord_Backend\Core\Request;
use MateusVBC\Magazord_Backend\Core\Controller;

/**
 * Arquivo controller de contato
 */
class ControllerContato extends Controller
{

    protected function processView(): void
    {
        $this->getView()->setColumn(['Id', 'Tipo', 'Descrição', 'Pessoa']);
        $this->getView()->setRow((new Contato())->getAll());
        $this->getView()->render();
        
    }

    protected function processRequest(): void
    {
        if (Request::getParam('action', false)) {
            $ModelContato = new Contato();
            switch (Request::getParam('action', false)) {
                case Config::ACTION_DELETE:
                    $ModelContato->setId(Request::getParam('id', false));
                    $ModelContato->delete();
                    break;
                case Config::ACTION_UPDATE:
                    $ModelContato->setId(Request::getParam('id', false));
                    $ModelContato->refresh();
                    foreach (Request::getAllParams() as $column => $value) {
                        if (is_callable([$ModelContato, 'set' . $column])) {
                            $ModelContato->{'set' . $column}($value);
                        }
                    }
                    $ModelContato->update();
                    break;
                case Config::ACTION_INSERT:
                    foreach (Request::getAllParams() as $column => $value) {
                        if (is_callable([$ModelContato, 'set' . $column])) {
                            $value = str_replace(['.', '-'], '', $value);
                            $ModelContato->{'set' . $column}($value);
                        }
                    }
                    $ModelContato->insert();
                    break;
            }
        }
        if (Request::getParam('search', false)) {
            $this->getSession()->set('view', Request::getParam('search', false));
            Request::unsetParam('search', false);
        } else if (Request::getParam('add', false)) {
            $this->getView()->setView(Request::getParam('add', false) . 'Cadastro');
            Request::unsetParam('add');
            Session::set('view', 'Pessoa');
        }
    }
}