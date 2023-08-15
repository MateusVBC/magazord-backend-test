<?php
namespace MateusVBC\Magazord_Backend;
use MateusVBC\Magazord_Backend\Core\Router;
use MateusVBC\Magazord_Backend\App\Controller\ControllerHome;
require 'vendor/autoload.php';
require 'autoload.php';

try {
    session_start();
    isset($_SESSION['view']) ?: $_SESSION['view'] = 'Home';
    $nomeController = 'Controller'.$_SESSION['view'];
    $Route = new Router();
    $Home = new $nomeController();
    $Route->set($Home, ['function' => 'index', 'params' => '']);
    $Route->dispatch();
} catch (\Exception $e) {

}