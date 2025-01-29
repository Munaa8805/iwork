<?php
session_start();
require __DIR__ . "/../vendor/autoload.php";


use Framework\Router;
use Framework\Session;

Session::start();

require "../helpers.php";


// require basePath("Framework/Router.php");
// require basePath("Framework/Database.php");


// spl_autoload_register(function ($class) {
//     $path =  basePath("Framework/{$class}.php");
//     if (file_exists($path)) {
//         require $path;
//     }
// });





// Instatiate the router




$router = new Router();

// Get routes
$routes = require basePath("routes.php");

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);



// Route the request
$router->route($uri);




// $config = require basePath("config/_db.php");
// $db = new Database($config);




// if (array_key_exists($uri, $routes)) {
//     require basePath($routes[$uri]);
// } else {
//     require basePath($routes["404"]);
// }


// inspectAndDie($uri);