<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $thoughtText = $_POST['thoughtText'];
    $updatedText = $_POST['updatedText'];

    // update 'QTlist' 
    $updateSql = "UPDATE thoughtsdb SET QTlist = ? WHERE QTlist = ?";
    
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ss", $updatedText, $thoughtText);

    // perform operations
    $updateStmt->execute();

    $updateStmt->close();
    $conn->close();
}
?>
