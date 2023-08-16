<?php
namespace MateusVBC\Magazord_Backend\App\Controller;

use MateusVBC\Magazord_Backend\App\Model\Pessoa;
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
}