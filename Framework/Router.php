<?php



namespace Framework;

use App\Controllers\ErrorController;

class Router
{
    protected $routes = [];
    /***
     * Register a new route
     * @param string $method
     */
    public function registerRoute($method, $uri, $action)
    {

        list($controller, $controllerMethod) = explode('@', $action);
        $this->routes[] = [
            "method" => $method,
            "uri" => $uri,
            "controller" => $controller,
            "controllerMethod" => $controllerMethod
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



    // public function error($httpCode = 404)
    // {
    //     http_response_code($httpCode);
    //     loadView("App/error/{$httpCode}");
    //     exit;
    // }







    /***
     * Route request to the appropriate controller
     */
    public function route($uri)
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        foreach ($this->routes as $route) {
            //Split the current URI into segments
            $uriSegments = explode("/", trim($uri, "/"));
            // inspectAndDie($uriSegments);
            //Split the route URI into segments
            $routeSegments = explode("/", trim($route["uri"], "/"));

            $match = true;
            // Check if the number of segments match
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)) {
                $params = [];

                $match = true;

                for ($i = 0; $i < count($uriSegments); $i++) {
                    // If the uri's do not match and there is no param
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }

                    // Check for the param and add to $params array
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }

                if ($match) {
                    // foreach ($route['middleware'] as $middleware) {
                    //     (new Authorize())->handle($middleware);
                    // }

                    $controller = 'App\\controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    // Instatiate the controller and call the method
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }



            // if ($route["uri"] === $uri && $route["method"] === $method) {
            //     // require basePath('App/' . $route["controller"]);
            //     // Extract the controller and method
            //     $controller = 'App\Controllers\\' . $route["controller"];
            //     $controllerMethod = $route["controllerMethod"];

            //     // Instantiate the controller and call the method
            //     $controllerInstance = new $controller();
            //     $controllerInstance->$controllerMethod();
            //     return;
            // }
        }

        // $this->error(404);


        ErrorController::notFound();

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