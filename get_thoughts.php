<?php
include 'db_connection.php';

$sql = "SELECT QTlist FROM thoughtsdb";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li class="thoughts list-item">';
        echo '<span>' . $row["QTlist"] . '</span>';
        echo '<div class="buttons-container">';
        echo '<button class="button update-button" onclick="updateThoughts(this.parentNode.previousSibling)">Update</button>';
        echo '<button class="button delete-button" onclick="deleteThoughts(this.parentNode.parentNode)">Delete</button>';
        echo '</div>';
        echo '</li>';
    }
} else {
    echo "No thoughts available.";
}

$conn->close();
?>
