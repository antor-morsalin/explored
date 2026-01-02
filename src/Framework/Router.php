<?php

    declare(strict_types=1);

    namespace Framework;

    class Router 
    {
        private array $routes = [];

        public function add(string $method, string $path, array $controller)
        {
            $this -> routes[] = [
                'method' => strtoupper($method),
                'path' => $this -> normalizePath($path),
                'controller' => $controller
            ];
        }

        private function normalizePath(string $path) : string
        {
            $path = trim($path, '/');
            $path = "/{$path}/";
            $path = preg_replace("#[/]{2,}#", "/", $path);
            return $path;
        }

        public function dispatch (string $method, string $path)
        {
            $path = $this -> normalizePath($path);
            $method = strtoupper($method);
            foreach($this -> routes as $route)
            {
                if(!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method)
                {
                    continue;
                }
                else 
                {
                    [$class, $function] = $route['controller'];
                    $controllerObj = new $class;
                    $controllerObj -> $function();
                }
            }
        }
    }



?>