<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $thoughtsInput = $_POST['thoughtsInput'];

    // insert data into database
    $sql = "INSERT INTO thoughtsdb (QTlist) VALUES (?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $thoughtsInput);

    if ($stmt->execute()) {

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
