<?php
@session_start();
include_once __DIR__ . '/../helpers/dbConn.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

if ($_SERVER['REQUEST_METHOD'] === "POST" && $_SERVER['REQUEST_URI'] === '/addProperty') {
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
    $InsertedPropertyID = $mysqli->insert_id;
    $stmt->close();

    //image upload handling
    $targetDir = "uploads/properties/"; // Target directory

    if (!file_exists($targetDir) && !is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    foreach ($_FILES['images']['name'] as $i => $name) {
        if ($_FILES['images']['error'][$i] === 0) {
            $tempName = $_FILES['images']['tmp_name'][$i];
            $pathInfo = pathinfo($_FILES['images']['name'][$i]);
            $newFileName = $pathInfo['filename'] . "_" . time() . "." . $pathInfo['extension'];
            $targetFilePath = $targetDir . $newFileName;

            if (move_uploaded_file($tempName, $targetFilePath)) {
                // Insert into `images` table
                $insertImageSQL = "INSERT INTO images (PropertyID, ImagePath) VALUES (?, ?)";
                $stmtImg = $mysqli->prepare($insertImageSQL);
                $stmtImg->bind_param("is", $InsertedPropertyID, $targetFilePath);
                $stmtImg->execute();
                $stmtImg->close();
            }
        }
    }

    header('Location: /explore');
    

}else if($_SERVER['REQUEST_METHOD'] === "POST" && $_SERVER['REQUEST_URI'] === '/edit'){
    $propertyID = (int)$_POST['property_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $coordinates = $_POST['coordinates'];  //6.824394389941898,80.037739276886
    $bedCount = (int)$_POST['bedCount'];
    $studentCount = (int)$_POST['stdCount'];
    $keymoney = (int)$_POST['keymoney'];
    $rent = (int)$_POST['rent'];
    $ownerID = $_SESSION['user_id'];
    $status = "Pending";

    $query = "UPDATE property SET Title=?, Description=?, Address=?, StdCount=?, BedCount=?, Rent=?, Keymoney=?, Coordinates=?, Status=?, OwnerID=? WHERE PropertyID=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssiissssii", $title, $description, $address, $studentCount, $bedCount, $rent, $keymoney, $coordinates, $status, $ownerID, $propertyID);
    $stmt->execute();
    $stmt->close();

    //image upload handling
    $targetDir = "uploads/properties/"; // Target directory

    if (!file_exists($targetDir) && !is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    foreach ($_FILES['images']['name'] as $i => $name) {
        if ($_FILES['images']['error'][$i] === 0) {
            $tempName = $_FILES['images']['tmp_name'][$i];
            $pathInfo = pathinfo($_FILES['images']['name'][$i]);
            $newFileName = $pathInfo['filename'] . "_" . time() . "." . $pathInfo['extension'];
            $targetFilePath = $targetDir . $newFileName;

            if (move_uploaded_file($tempName, $targetFilePath)) {
                // Insert into `images` table
                $insertImageSQL = "INSERT INTO images (PropertyID, ImagePath) VALUES (?, ?)";
                $stmtImg = $mysqli->prepare($insertImageSQL);
                $stmtImg->bind_param("is", $propertyID, $targetFilePath);
                $stmtImg->execute();
                $stmtImg->close();
            }
        }
    }

    //image deletion handling
    include_once './data/fetchProperties.php';
    if (isset($_POST['deleteImages'])) {
        foreach ($_POST['deleteImages'] as $imageID => $delete) {
            if ($delete == '1') {
                $imagePath = fetchImagePathByID($imageID);

                // Delete the file from the directory
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Delete the record from the database
                $deleteSQL = "DELETE FROM images WHERE ImageID = ?";
                $stmt = $mysqli->prepare($deleteSQL);
                $stmt->bind_param("i", $imageID);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    header('Location: /explore');

}else if ($_SERVER['REQUEST_METHOD'] === "GET" && !isset($_GET['id']) && strpos($requestPath, '/addProperty') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Landlord") {
            include './pages/Landlord/AddProperty/addProperty.php';
        } else {
            header('Location: /');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && !isset($_GET['id']) && strpos($requestPath, '/bookings') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Landlord") {
            include './pages/Landlord/Bookings/bookings.php';
        } else {
            header('Location: /');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Landlord") {
            include './pages/Landlord/EditProperty/editProperty.php';
        } else {
            header('Location: /');
        }
    }
}else if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['prop_id'])&& strpos($requestPath, '/getProperty') !== false){
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
}else{
    header('Location: /explore');
}