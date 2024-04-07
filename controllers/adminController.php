<?php

@session_start();
include_once __DIR__ . '/../helpers/dbConn.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);
if ($_SERVER['REQUEST_METHOD'] === "POST" && strpos($requestPath, '/publishArticle') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            $id = (int) $_SESSION['user_id'];
            $title = $_POST['art_title'];
            $body = $_POST['art_body'];
            $query = "INSERT INTO articles (AuthorID,Title,Content) VALUES (?,?,?)";
            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                header('Location: /');
                exit;
            }
            $stmt->bind_param("iss", $id, $title, $body);
            $stmt->execute();
            $stmt->close();
            
        } else {
            //header('Location: /explore');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && strpos($requestPath, '/writeArticle') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            include './pages/Admin/Article/WriteArticle/writeArticle.php';
        } else {
            header('Location: /explore');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && strpos($requestPath, '/editArticle') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            $id = $_GET['id'];
            include './pages/Admin/Article/EditArticle/editArticle.php';
        } else {
            header('Location: /explore');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "POST" && strpos($requestPath, '/editArticle') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            $title = $_POST['art_title'];
            $body = $_POST['art_body'];
            $authorID = $_POST['art_author'];
            $articleID = $_POST['art_id'];
            $query = "UPDATE articles SET Title=?, Content=?, AuthorID=? WHERE ArticleID=?";
            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                header('Location: /');
                exit;
            }
            $stmt->bind_param("ssii", $title, $body, $authorID, $articleID);
            $stmt->execute();
            $stmt->close();
        } else {
            header('Location: /explore');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "GET" && strpos($requestPath, '/addUsers') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            include './pages/Admin/AddUsers/AddUsers.php';
        } else {
            header('Location: /explore');
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === "POST" && strpos($requestPath, '/addUsers') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            if (isset($_POST['mode']) && $_POST['mode'] === 'signup') {
                $name = $_POST["name"];
                $nic = $_POST['nic'];
                $address = $_POST['address'];
                $contact = $_POST['contact'];
                $role = (int) $_POST['role'];
                $signup_email = $_POST['signup_email'];
                $signup_password = $_POST['signup_password'];
                if (isset($_POST['role']) && $_POST['role'] === "1") {
                    $degreeDuration = (int) $_POST['degreeDuration'];
                    $uniID = $_POST['uniID'];
                }
                if (isset($_POST['role']) && $_POST['role'] === "1") {
                    $user_ins_query = "INSERT INTO user (Name, NIC, Address, ContactNo, Email, Password, RoleID) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $student_ins_query = "INSERT INTO `student` (`UserID`, `DegDuration`, `UniID`) VALUES (?, ?, ?)";
                    $stmt = $mysqli->prepare($user_ins_query);
                    $stmt->bind_param("ssssssi", $name, $nic, $address, $contact, $signup_email, $signup_password, $role);
                    if ($stmt->execute()) {
                        $lastInsertedId = $mysqli->insert_id;
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                    $stmt = $mysqli->prepare($student_ins_query);
                    $stmt->bind_param("iis", $lastInsertedId, $degreeDuration, $uniID);
                    $stmt->execute();
                    $stmt->close();
                    header('Location: /addUsers');
                }
            } else if (isset($_POST['role']) && ($_POST['role'] !== "1")) {
                $ins_query = "INSERT INTO user (Name, NIC, Address, ContactNo, Email, Password, RoleID) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $mysqli->prepare($ins_query);
                $stmt->bind_param("ssssssi", $name, $nic, $address, $contact, $signup_email, $signup_password, $role);
                $stmt->execute();
                $stmt->close();
                header('Location: /addUsers');
                exit;
            }
        } else {
            header('Location: /explore');
        }
    }
}




