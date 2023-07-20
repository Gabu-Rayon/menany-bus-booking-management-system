<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");


require_once("db-connect/config.php");

// Check if the location ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
$locationId = $_GET['id'];

// Delete the location record from the database
$deleteQuery = "DELETE FROM location WHERE id = :locationId";
$stmt = $conn->prepare($deleteQuery);
$stmt->bindParam(':locationId', $locationId, PDO::PARAM_INT);

if ($stmt->execute()) {
// Redirect back to the locations page after deletion
header("Location: location.php");
exit();
} else {
// Handle the case where the deletion fails
echo "Failed to delete the location record.";
}
} else {
// If no location ID is provided in the URL, redirect back to the locations page
header("Location: location.php");
exit();
}
?>

<body class="app">
    <?php include("inc/sidebar.php"); ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <!-- Display a message or perform additional actions after deletion if needed -->
                <div class="row g-4">
                    <h2>Deleting Location...</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="assets/plugins/bootstrap/ppopper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script>
</body>

</html>