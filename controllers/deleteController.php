<?php
@session_start();
include_once './helpers/dbConn.php';
//check user status
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location: /auth');
}

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && $_SERVER['REQUEST_URI'] != '/deleteProperty'){
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
}