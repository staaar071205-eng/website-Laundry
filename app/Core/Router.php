<?php
namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post(string $path, array $action): void
    {
        $this->routes['POST'][$path] = $action;
    }

    // Mencari route yang cocok lalu memanggil method controller
    public function dispatch(string $method, string $path): void
    {
        $action = $this->routes[$method][$path] ?? null;

        if ($action === null) {
            http_response_code(404);
            echo "Halaman tidak ditemukan.";
            return;
        }

        [$class, $function] = $action;
        $controller = new $class();
        $controller->$function();
    }
}
