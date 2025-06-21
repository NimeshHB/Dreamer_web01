<?php

namespace App\Core;

class Router {
    private static array $routes = [];

    public static function add(string $method, string $route, callable|array $action) {
        self::$routes[] = [
            'method' => strtoupper($method),
            'route' => strtolower(trim($route, '/')),
            'action' => $action,
        ];
    }

    public static function init() {
        require_once __DIR__ . '/../Routes/web.php';
        require_once __DIR__ . '/../Routes/api.php';
        self::dispatch();
    }

    public static function dispatch() {
        $uri = strtolower(trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        $method = strtoupper($_SERVER['REQUEST_METHOD']);

        foreach (self::$routes as $route) {
            if ($method === $route['method'] && $uri === $route['route']) {
                if (is_callable($route['action'])) {
                    call_user_func($route['action']);
                } else {
                    list($controller, $methodName) = $route['action'];
                    (new $controller)->$methodName();
                }
                return;
            }
        }

        http_response_code(404);
        echo json_encode(["error" => "Not Found"]);
    }
}
