<?php
namespace MateusVBC\Magazord_Backend;
use MateusVBC\Magazord_Backend\Core\Config;
use MateusVBC\Magazord_Backend\Core\Router;
use MateusVBC\Magazord_Backend\Core\Session;
require 'vendor/autoload.php';
require 'autoload.php';

try {
    session_start();
    if(isset($_GET['search'])) {
        if($_GET['search'] == Config::DEFAULT_VIEW) {
            unset($_GET['search']);
            $_SESSION['view'] = Config::DEFAULT_VIEW;
        } 
    }
    $Session = new Session();
    if(!$Session->get('view')) $Session->set('view', Config::DEFAULT_VIEW);
    $nomeController = 'MateusVBC\Magazord_Backend\App\Controller\Controller'.$Session->get('view');
    $Route = new Router();
    $Controller = new $nomeController();
    $Route->set($Controller, ['function' => 'index', 'params' => '']);
    $Route->dispatch();
} catch (\Exception $e) {
    #eu espero que nunca caia aqui...
    echo '<html> <script> alert("Parece que houve um erro, o site tentará reiniciar para corrigilo") </script> </html>';
    unset($_GET);
    unset($_POST);
    unset($_SESSION);
    header('Location: index.php');
}
?>