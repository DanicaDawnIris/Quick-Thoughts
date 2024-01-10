<?php

$hostname = "localhost";
$username = "root";
$password = "danicadawn";
$database = "quickthoughts";

// create connection
$conn = new mysqli($hostname, $username, $password, $database);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
