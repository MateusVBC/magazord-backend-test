<?php
namespace MateusVBC\Magazord_Backend\App\Controller;

use MateusVBC\Magazord_Backend\Core\Controller;

class ControllerHome extends Controller
{

    protected function processView(): void
    {
        $this->getView()->render();
    }
}