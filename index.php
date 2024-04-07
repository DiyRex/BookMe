<?php
include 'routes.php';

$uri =  $_SERVER['REQUEST_URI'];
$uriParts = parse_url($uri);
$Route = $uriParts['path'];


if (array_key_exists($Route, $routes)) {
    // Include the file corresponding to the route
    include $routes[$Route];
} else {
    // Route not found
    echo "404 Not Found";
}