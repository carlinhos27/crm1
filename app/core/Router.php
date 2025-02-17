<?php
class Router {
    private $routes = [];

    public function add($route, $controller, $method = 'index') {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch() {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        if (isset($this->routes[$uri])) {
            $controllerName = $this->routes[$uri]['controller'];
            $method = $this->routes[$uri]['method'];

            require_once "../app/controllers/{$controllerName}.php";
            $controller = new $controllerName();
            $controller->$method();
        } else {
            echo "404 - Página no encontrada";
        }
    }
}
