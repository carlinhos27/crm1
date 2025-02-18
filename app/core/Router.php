<?php
class Router
{
    private static $instance = null;
    private $routes = [];

    public function __construct()
    {
        if (self::$instance === null) {
            self::$instance = $this;
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    public function get($route, $controllerAction)
    {
        $this->add('GET', $route, $controllerAction);
    }

    public function post($route, $controllerAction)
    {
        $this->add('POST', $route, $controllerAction);
    }

    private function add($method, $route, $controllerAction)
    {
        if (is_array($controllerAction) && count($controllerAction) === 2) {
            $this->routes[$method][$route] = [
                'controller' => $controllerAction[0],
                'method' => $controllerAction[1]
            ];
        }
    }

    public function dispatch()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'];

        if ($uri === '') {
            $uri = 'home';
        }

        // Buscar ruta exacta (sin parámetros)
        if (isset($this->routes[$method][$uri])) {
            $this->callController($this->routes[$method][$uri]);
            return;
        }

        // Buscar rutas con parámetros dinámicos
        foreach ($this->routes[$method] as $route => $controllerAction) {
            $pattern = preg_replace('/\{[\w]+\}/', '([\w-]+)', $route); // Convierte {id} en regex
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches); // Eliminar la coincidencia completa
                $this->callController($controllerAction, $matches);
                return;
            }
        }

        $this->handleNotFound("404 - Página no encontrada");
    }

    private function callController($controllerAction, $params = [])
    {
        $controllerName = $controllerAction['controller'];
        $methodName = $controllerAction['method'];

        require_once "../app/controllers/{$controllerName}.php";
        $controller = new $controllerName();

        if (method_exists($controller, $methodName)) {
            call_user_func_array([$controller, $methodName], $params);
        } else {
            $this->handleNotFound("Error: Método '$methodName' no encontrado en '$controllerName'");
        }
    }

    private function handleNotFound($message = "404 - Página no encontrada")
    {
        http_response_code(404);
        echo $message;
        exit;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
