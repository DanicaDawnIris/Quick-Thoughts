<?php

$hostname = "localhost";
$username = "root";
$password = "danicadawn";
$database = "quickthoughts";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // check username and password
    $sql = "SELECT * FROM users WHERE username = ?";

    // prepared statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $enteredUsername);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($enteredPassword === $row["password"]) {
            // successful, redirect to main
            header("Location: main.php");
            exit();
        } else {
            // incorrect password
            header("Location: index.php?error=IncorrectPassword");
            exit();
        }
    } else {
        // user not found
        header("Location: index.php?error=UserNotFound");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
