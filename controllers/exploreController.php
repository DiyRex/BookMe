<?php
@session_start();
include_once './helpers/dbConn.php';
//check user status
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location: /auth');
}

//if logged in then redirect based on roles
if(isset($_SESSION['role'])){
    $Role = $_SESSION['role'];
    if($Role === "Student"){
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            $query = "SELECT PropertyID, Coordinates FROM property";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $coordinates = [];

            while ($row = $result->fetch_assoc()) {
                $coords = explode(',', $row['Coordinates']);
                if (count($coords) == 2) {
                    $coordinates[] = [
                        'id' => $row['PropertyID'],
                        'lat' => (float)$coords[0],
                        'lng' => (float)$coords[1]];
                }
            }
            $coordinatesJson = json_encode($coordinates);

            include './pages/Student/student.php';
        }
    }else if($Role === "Landlord"){
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
        include './pages/Landlord/MyProperties/myProperties.php';
        }
    } else if ($Role === "Warden") {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            $query = "SELECT PropertyID, Coordinates FROM property";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $coordinates = [];

            while ($row = $result->fetch_assoc()) {
                $coords = explode(',', $row['Coordinates']);
                if (count($coords) == 2) {
                    $coordinates[] = [
                        'id' => $row['PropertyID'],
                        'lat' => (float)$coords[0],
                        'lng' => (float)$coords[1]];
                }
            }
            $coordinatesJson = json_encode($coordinates);
            include './pages/Warden/ManageProperties/manageProperties.php';
        }
    }else if ($Role === "Admin") {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            // Check if 'action' key exists in the $_GET array
            if (isset($_GET['action'])) {
                if ($_GET['action'] == "propertyManage") {
                    include './pages/Admin/ManageProperties/manageProperties.php';
                } else if ($_GET['action'] == "manageUsers") {
                    include './pages/Admin/ManageUsers/manageUsers.php';
                }else if ($_GET['action'] == "article") {
                    include './pages/Admin/Article/MyArticles/myArticles.php';
                } else {
                    // If 'action' exists but does not match any condition above
                    include './pages/Admin/Panel/panel.php';
                }
            } else {
                // If 'action' key does not exist, include the default admin panel page
                include './pages/Admin/Panel/panel.php';
            }
        }
    }else{
        
    }
    }
   
        // if ($_SERVER['REQUEST_METHOD'] === "GET") {
        //     $query = "SELECT Coordinates FROM posts";
        //     $stmt = $mysqli->prepare($query);
        //     $stmt->execute();
        //     $result = $stmt->get_result();
        //     $coordinates = [];

        //     while ($row = $result->fetch_assoc()) {
        //         $coords = explode(',', $row['Coordinates']);
        //         if (count($coords) == 2) {
        //             $coordinates[] = ['lat' => (float)$coords[0], 'lng' => (float)$coords[1]];
        //         }
        //     }
       
        // }