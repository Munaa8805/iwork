<?php

use Framework\Database;

$config = require basePath("config/_db.php");
$db = new Database($config);
$id = $_GET["id"] ?? '';

$params = [
    "id" => $id
];
// inspect($params);

$listing = $db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
// inspect($listing);
loadView("listing/show", ["listing" => $listing]);
