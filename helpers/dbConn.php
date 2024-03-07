<?php
$host = 'localhost'; // or your host
$user = 'root';
$pass = '';
$db   = 'boarding';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}else{
    //echo "db ok";
}
