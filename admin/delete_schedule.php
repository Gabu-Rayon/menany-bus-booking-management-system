<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
require_once("db-connect/config.php");

// Check if the schedule ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
$scheduleId = $_GET['id'];

// Delete the schedule record from the database
$deleteQuery = "DELETE FROM schedule_list WHERE id = :scheduleId";
$stmt = $conn->prepare($deleteQuery);
$stmt->bindParam(':scheduleId', $scheduleId, PDO::PARAM_INT);

if ($stmt->execute()) {
// Redirect back to the schedule list page after deleting
header("Location: schedule_list.php");
exit();
} else {
// Handle the case where the deletion fails
echo "Failed to delete the schedule.";
}
} else {
// If no schedule ID is provided, redirect back to the schedule list page
header("Location: schedule_list.php");
exit();
}