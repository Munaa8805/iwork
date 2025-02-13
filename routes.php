<?php

$router->get("/", "HomeController@index");
$router->get("/listings", "ListingController@index");
$router->post("/listings", "ListingController@store");
$router->get("/listings/create", "ListingController@create", ["auth"]);
//// Routes for search
$router->get("/listings/search", "ListingController@search");
$router->get("/listings/edit/{id}", "ListingController@edit", ["auth"]);
$router->get("/listings/{id}", "ListingController@show");
$router->delete("/listings/{id}", "ListingController@destroy", ["auth"]);
$router->put("/listings/{id}", "ListingController@update", ["auth"]);

// Routes for authentication
$router->get("/auth/register", "UserController@create", ["guest"]);
$router->get("/auth/login", "UserController@login", ["guest"]);
$router->post("/auth/register", "UserController@store", ["guest"]);
$router->post("/auth/logout", "UserController@logout", ["auth"]);
$router->post("/auth/login", "UserController@authenticate", ["guest"]);










// return  [
//     "/" => "controllers/home.php",
//     "/listings" => "controllers/listings/index.php",
//     "/listings/create" => "controllers/listings/create.php",
//     // "404" => "controllers/error/404.php"
// ];








// $router->get("/", "controllers/home.php");
// $router->get("/listings", "controllers/listings/index.php");
// $router->get("/listings/create", "controllers/listings/create.php");
// $router->get("/listing", "controllers/listings/show.php");