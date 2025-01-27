<?php
require "../helpers.php";


require basePath("Router.php");
require basePath("Database.php");

// Instatiate the router

$router = new Router();

// Get routes
$routes = require basePath("routes.php");

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];


// Route the request
$router->route($uri, $method);




// $config = require basePath("config/_db.php");
// $db = new Database($config);




// if (array_key_exists($uri, $routes)) {
//     require basePath($routes[$uri]);
// } else {
//     require basePath($routes["404"]);
// }


// inspectAndDie($uri);