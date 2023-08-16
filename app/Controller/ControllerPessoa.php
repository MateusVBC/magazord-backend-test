<?php
namespace MateusVBC\Magazord_Backend\App\Controller;

use MateusVBC\Magazord_Backend\App\Model\Pessoa;
use MateusVBC\Magazord_Backend\Core\Config;
use MateusVBC\Magazord_Backend\Core\View;
use MateusVBC\Magazord_Backend\Core\Request;
use MateusVBC\Magazord_Backend\Core\Controller;

class ControllerPessoa extends Controller
{

    protected function processView(): void
    {
        $this->getView()->setColumn(['Id', 'Nome', 'Cpf']);
        $this->getView()->setRow((new Pessoa())->getAll());
        $this->getView()->render();
    }

    protected function processRequest() : void {
        if(Request::getParam('action', false)) {
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
                        $ModelPessoa->{'set'.$column}($value);
                    }
                    $ModelPessoa->update();
                    break;
            }
        }
    }
}