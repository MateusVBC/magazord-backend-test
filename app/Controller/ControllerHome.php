<?php
namespace MateusVBC\Magazord_Backend\App\Controller;

use MateusVBC\Magazord_Backend\Core\View;
use MateusVBC\Magazord_Backend\Core\Request;
use MateusVBC\Magazord_Backend\Core\Controller;

class ControllerHome extends Controller
{

    protected function processView(): void
    {
        $this->getView()->setColumn(['Id', 'Pessoa', 'Cpf']);
        $this->getView()->render();
    }
}