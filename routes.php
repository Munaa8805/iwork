<?php

$router->get("/", "HomeController@index");
$router->get("/listings", "ListingController@index");
$router->post("/listings", "ListingController@store");
$router->get("/listings/create", "ListingController@create");
$router->get("/listings/edit/{id}", "ListingController@edit");
$router->get("/listings/{id}", "ListingController@show");
$router->delete("/listings/{id}", "ListingController@destroy");
$router->put("/listings/{id}", "ListingController@update");


$router->get("/auth/create", "UserController@create");
$router->get("/auth/login", "UserController@login");
$router->post("/auth/register", "UserController@store");
$router->post("/auth/logout", "UserController@logout");
$router->post("/auth/login", "UserController@authenticate");








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