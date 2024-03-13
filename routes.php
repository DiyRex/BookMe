<?php

$routes = [
    "/" => "pages/HomePage/Home.php",
    "/auth" => "controllers/loginController.php",
    "/explore" => "controllers/exploreController.php",
    "/logout" => "controllers/logout.php",
    "/addProperty" => "controllers/propertyController.php",
    "/edit" => "controllers/propertyController.php",
    "/deleteProperty" => "controllers/deleteController.php",
    "/deleteBooking" => "controllers/deleteController.php",
    "/deleteArticle" => "controllers/deleteController.php",
    "/acceptProperty" => "controllers/wardenController.php",
    "/rejectProperty" => "controllers/wardenController.php",
    "/suspendProperty" => "controllers/wardenController.php",
    "/publishArticle" => "controllers/adminController.php",
    "/writeArticle" => "controllers/adminController.php",
    "/editArticle" => "controllers/adminController.php",
    "/articles" => "controllers/studentController.php",
    "/mybookings" => "controllers/studentController.php",
    "/notFound" => "pages/404/404.php",
];