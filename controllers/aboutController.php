<?php
@session_start();
$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

if ($_SERVER['REQUEST_METHOD'] === "GET" && $_SERVER['REQUEST_URI'] === '/about') {
    include './pages/About/About.php';
}