<?php
@session_start();
include_once './helpers/dbConn.php';
//check user status
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location: /auth');
}

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && strpos($requestPath, '/deleteProperty') !== false){
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && ($_SESSION['role'] == "Landlord" || $_SESSION['role'] == "Warden")) {
            $id = $_GET['id'];
            $query = "DELETE FROM property WHERE PropertyID=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            header('Location: /explore');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && strpos($requestPath, '/deleteArticle') !== false){
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            $id = $_GET['id'];
            $query = "DELETE FROM articles WHERE ArticleID=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }else{
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && strpos($requestPath, '/deleteBooking') !== false){
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Student") {
            $id = $_GET['id'];
            $query = "DELETE FROM booking WHERE BookingID=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }else{
        }
    }
}