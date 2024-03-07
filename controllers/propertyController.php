<?php
@session_start();
include_once __DIR__ . '/../helpers/dbConn.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $coordinates = $_POST['coordinates'];  //6.824394389941898,80.037739276886
    $bedCount = (int)$_POST['bedCount'];
    $studentCount = (int)$_POST['studentCount'];
    $keymoney = (int)$_POST['keymoney'];
    $rent = (int)$_POST['rent'];
    $ownerID = $_SESSION['user_id'];
    $status = "Pending";

    $query = "INSERT INTO property (Title, Description, Address, StdCount, BedCount, Rent, Keymoney, Coordinates, Status, OwnerID)
              VALUES(?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssiissssi", $title, $description, $address, $studentCount, $bedCount, $rent, $keymoney, $coordinates, $status, $ownerID);
    $stmt->execute();
    $stmt->close();
    header('Location: /explore');
    // echo $coordinates;
}else if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Landlord") {
            include './pages/Landlord/AddProperty/addProperty.php';
        } else {
            header('Location: /');
        }
    }
}
