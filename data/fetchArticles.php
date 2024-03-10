<?php
@session_start();


include_once __DIR__ . '/../helpers/dbConn.php';
function fetchArticles()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['role'] == "Admin") {
        global $mysqli;
        $query = "SELECT articles.ArticleID, articles.Title, articles.Content, articles.Added, user.Name FROM articles INNER JOIN user ON articles.AuthorID = user.UserID";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $articles = [];

        while ($article = $result->fetch_assoc()) {
            $articles[] = $article;
        }

        $stmt->close();
        return $articles;
    } else {
        return null;
    }
}
function fetchArticleByID($id){
    if (isset($_SESSION['loggedin']) && $_SESSION['role'] == "Admin" ) {
        global $mysqli;
        $id = $mysqli->real_escape_string($id);
        $query = "SELECT * FROM articles WHERE ArticleID=?";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            header('Location: /explore?action=article');
            exit;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // No records found, redirect to /explore
            $stmt->close();
            header('Location: /explore?action=article');
            exit;
        }

        $prop = $result->fetch_assoc();
        
        if (!$prop) {
            // Failed to fetch, redirect to /explore
            $stmt->close();
            header('Location: /explore');
            exit;
        }

        $stmt->close();
        return $prop;
    } else {
        // Access denied, redirect to /explore
        header('Location: /explore');
        exit;
    }
}