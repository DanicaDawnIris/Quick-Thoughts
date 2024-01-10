<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $thoughtText = trim($_POST['thoughtText']);

    $deleteSql = "DELETE FROM thoughtsdb WHERE QTlist = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("s", $thoughtText);

    // perform deletion
    if ($deleteStmt->execute()) {
        if ($deleteStmt->affected_rows > 0) {
            echo "Thought deleted successfully.";
        } else {
            echo "No matching thought found.";
        }
    } else {
        echo "Error deleting thought: " . $deleteStmt->error;
    }

    $deleteStmt->close();
    $conn->close();
}
?>
