<?php

@session_start();
include_once __DIR__ . '/../helpers/dbConn.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);
if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['prop_id'])){
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Student") {
            include __DIR__ .'/../data/fetchProperties.php';
            header('Content-Type: application/json');
            if(isset($_GET['prop_id'])) {
                $property = fetchPropsByID($_GET['prop_id']);
                $images = fetchPropImagesByID($_GET['prop_id']);
                if(isset($images)){
                    $response = [
                        'property' => $property,
                        'images' => $images
                    ];
                }else{
                    $response = [
                        'property' => $property,
                        'images' => null
                    ];
                }
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'Property ID not provided.']);
            }
        }
    }
}if($_SERVER['REQUEST_METHOD'] === "GET" && strpos($requestPath, '/article') !== false){
    include './pages/Student/Articles/articles.php';
}
else{
    //header('Location: /explore');
}