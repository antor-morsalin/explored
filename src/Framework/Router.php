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

        public function dispatch(string $method, string $path)
        {
            $path   = $this->normalizePath($path);
            $method = strtoupper($method);

            foreach ($this->routes as $route) {

                // method must match
                if ($route['method'] !== $method) {
                    continue;
                }

                // ---- PARAM ROUTE ONLY (Express-style :id) ----
                if (str_contains($route['path'], ':')) {

                    // build regex from route path
                    $routeRegex = preg_replace('#:\w+#', '([^/]+)', $route['path']);

                    // match first
                    $matches = [];
                    if (!preg_match("#^{$routeRegex}$#", $path, $matches)) {
                        continue;
                    }

                    // single param name
                    preg_match('#:(\w+)#', $route['path'], $m);
                    $paramName = $m[1];

                    // store globally
                    $_GET['params'][$paramName] = $matches[1];

                    // call controller (no args)
                    [$class, $function] = $route['controller'];
                    $controllerObj = new $class;
                    $controllerObj->$function();

                    return;
                }

                // ---- STATIC ROUTES (your original logic) ----
                if (!preg_match("#^{$route['path']}$#", $path)) {
                    continue;
                }

                [$class, $function] = $route['controller'];
                $controllerObj = new $class;
                $controllerObj->$function();

                return;
            }
        }


    }



?>