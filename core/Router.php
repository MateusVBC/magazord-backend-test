<?php
namespace MateusVBC\Magazord_Backend\Core;

class Router
{
    private object $route;
    private array|null $route_parameters;

    /**
     * Seta a rota que será tomada
     */
    public function set(object $class, array $params = ['function' => '', 'params' => '']) {
        $this->route = $class;
        $this->route_parameters = $params;
    }

    /**
     * Acessa a rota definida
     */
    public function dispatch() {
        $this->getRoute()->{$this->getRouteParameters()['function']}($this->getRouteParameters()['params']);
    }

    public function getRoute() : object {
        return $this->route;
    }

    public function getRouteParameters() : array|null {
        return $this->route_parameters;
    }
}