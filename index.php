<?php
namespace MateusVBC\Magazord_Backend;
use MateusVBC\Magazord_Backend\Core\Config;
use MateusVBC\Magazord_Backend\Core\Router;
use MateusVBC\Magazord_Backend\Core\Session;
require 'vendor/autoload.php';
require 'autoload.php';

try {
    session_start();
    $Session = new Session();
    if(!$Session->get('view')) $Session->set('view', Config::DEFAULT_VIEW);
    $nomeController = 'MateusVBC\Magazord_Backend\App\Controller\Controller'.$Session->get('view');
    $Route = new Router();
    $Controller = new $nomeController();
    $Route->set($Controller, ['function' => 'index', 'params' => '']);
    $Route->dispatch();
} catch (\Exception $e) {

}
?>