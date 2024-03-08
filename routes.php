<?php

$routes = [
    "/" => "pages/HomePage/Home.php",
    "/auth" => "controllers/loginController.php",
    "/explore" => "controllers/exploreController.php",
    "/logout" => "controllers/logout.php",
    "/addProperty" => "controllers/propertyController.php",
    "/edit" => "controllers/propertyController.php",
    "/deleteProperty" => "controllers/deleteController.php",
    "/acceptProperty" => "controllers/wardenController.php",
    "/rejectProperty" => "controllers/wardenController.php",
    "/suspendProperty" => "controllers/wardenController.php",
];