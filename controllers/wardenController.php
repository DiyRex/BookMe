<?php

@session_start();
include_once __DIR__ . '/../helpers/dbConn.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && strpos($requestPath, '/acceptProperty') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Warden") {
            $status = "Approved";
            $propertyID = $_GET['id'];
            $query = "UPDATE property SET Status=? WHERE PropertyID=?";
            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                header('Location: /');
                exit;
            }
            $stmt->bind_param("si", $status, $propertyID);
            $stmt->execute();
            $stmt->close();
            header('Location: /explore?action=propertyManage');
        } else {
            //header('Location: /explore');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && strpos($requestPath, '/rejectProperty') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Warden") {
            $status = "Rejected";
            $propertyID = $_GET['id'];
            $query = "UPDATE property SET Status=? WHERE PropertyID=?";
            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                header('Location: /');
                exit;
            }
            $stmt->bind_param("si", $status, $propertyID);
            $stmt->execute();
            $stmt->close();
            header('Location: /explore?action=propertyManage');
        } else {
            //header('Location: /explore');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && strpos($requestPath, '/suspendProperty') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Warden") {
            $status = "Suspended";
            $propertyID = $_GET['id'];
            $query = "UPDATE property SET Status=? WHERE PropertyID=?";
            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                header('Location: /');
                exit;
            }
            $stmt->bind_param("si", $status, $propertyID);
            $stmt->execute();
            $stmt->close();
            header('Location: /explore?action=propertyManage');
        } else {
            //header('Location: /explore');
        }
    }
}else if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['prop_id'])){
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Warden") {
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
}else{
    header('Location: /explore');
}