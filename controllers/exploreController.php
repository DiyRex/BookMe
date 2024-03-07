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
            $query = "SELECT Coordinates FROM property";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $coordinates = [];

            while ($row = $result->fetch_assoc()) {
                $coords = explode(',', $row['Coordinates']);
                if (count($coords) == 2) {
                    $coordinates[] = [
                        'id' => $row['PostID'],
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
            if ($_GET['action'] == "propertyManage") {
                include './pages/Warden/ManageProperties/manageProperties.php';
            } else if ($_GET['action'] == "manageUsers") {
                include './pages/Warden/ManageUsers/manageUsers.php';
            } else if ($_GET['action'] == "pendingProperties") {
                include './pages/Warden/PendingProperties/pendingProperties.php';
            } else {
                include './pages/Warden/Panel/panel.php';
            }
        }
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