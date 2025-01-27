<?php

class Router
{
    protected $routes = [];
    /***
     * Register a new route
     * @param string $method
     */
    public function registerRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            "method" => $method,
            "uri" => $uri,
            "controller" => $controller
        ];
    }

    /***
     * Add a new route to the router GET
     */

    public function get($uri, $controller)
    {
        $this->registerRoute("GET", $uri, $controller);
    }

    public function post($uri, $controller)
    {

        $this->registerRoute("POST", $uri, $controller);
    }
    public function put($uri, $controller)
    {

        $this->registerRoute("PUT", $uri, $controller);
    }
    public function delete($uri, $controller)
    {

        $this->registerRoute("DELETE", $uri, $controller);
    }



    public function error($httpCode = 404)
    {
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }
    /***
     * Route request to the appropriate controller
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"] === $method) {
                require basePath($route["controller"]);
                return;
            }
        }

        $this->error(404);

        // require basePath("controllers/error/404.php");
    }
}



// $routes = require basePath("routes.php");

// if (array_key_exists($uri, $routes)) {
//     require basePath($routes[$uri]);
// } else {
//     http_response_code(404);
//     require basePath($routes["404"]);
// }