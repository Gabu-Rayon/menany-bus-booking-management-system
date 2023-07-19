<?php
require_once 'config/connect.php';

// Check if the id is provided in the GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the DELETE query
    $deleteQuery = "DELETE FROM unpaid_tickets WHERE id = :id"; // Updated column name
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $deleteStmt->execute();
}
?>