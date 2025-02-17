<?php
class Router {
    private $routes = [];

    public function get($route, $controllerAction) {
        $this->add('GET', $route, $controllerAction);
    }

    public function post($route, $controllerAction) {
        $this->add('POST', $route, $controllerAction);
    }

    private function add($method, $route, $controllerAction) {
        if (is_array($controllerAction) && count($controllerAction) === 2) {
            $this->routes[$method][$route] = [
                'controller' => $controllerAction[0],
                'method' => $controllerAction[1]
            ];
        }
    }

    public function dispatch() {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'];
    
        // Si la URI está vacía, redirigir a 'home' (o el controlador deseado)
        if ($uri === '') {
            $uri = 'home';
        }
    
        if (isset($this->routes[$method][$uri])) {
            $controllerName = $this->routes[$method][$uri]['controller'];
            $methodName = $this->routes[$method][$uri]['method'];
    
            require_once "../app/controllers/{$controllerName}.php";
            $controller = new $controllerName();
    
            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else {
                $this->handleNotFound("Error: Método '$methodName' no encontrado en el controlador '$controllerName'");
            }
        } else {
            $this->handleNotFound("404 - Página no encontrada");
        }
    }

    private function handleNotFound($message = "404 - Página no encontrada") {
        http_response_code(404);
        echo $message;
        exit;
    }
}
