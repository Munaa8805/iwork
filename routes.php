<?php

$router->get("/", "HomeController@index");
$router->get("/listings", "ListingController@index");
$router->post("/listings", "ListingController@store");
$router->get("/listings/create", "ListingController@create");
$router->get("/listings/{id}", "ListingController@show");
$router->delete("/listings/{id}", "ListingController@destroy");

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