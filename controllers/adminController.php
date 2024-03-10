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
}