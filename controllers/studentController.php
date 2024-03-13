<?php

@session_start();
include_once __DIR__ . '/../helpers/dbConn.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);
if($_SERVER['REQUEST_METHOD'] === "GET" &&  strpos($requestPath, '/article') !== false){
    include './pages/Student/Articles/articles.php';
}else if($_SERVER['REQUEST_METHOD'] === "GET" && strpos($requestPath, '/mybookings') !== false){
    include './pages/Student/MyBookings/myBookings.php';
}else if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['prop_id'])){
    $id = $_GET['prop_id'];
    $query = "INSERT INTO booking (PropertyID, UserID)
              VALUES(?,?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $id, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->close();
}
else{
    //header('Location: /explore');
}