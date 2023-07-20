<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");

require_once("db-connect/config.php");

// Check if the user ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
$userId = $_GET['id'];

// Delete the user record from the database
$deleteQuery = "DELETE FROM tbl_users WHERE id = :userId";
$stmt = $conn->prepare($deleteQuery);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

if ($stmt->execute()) {
// Redirect back to the registered users page after deletion
header("Location: registered_users.php");
exit();
} else {
// Handle the case where the deletion fails
echo "Failed to delete the user record.";
}
} else {
// If no user ID is provided in the URL, redirect back to the registered users page
header("Location: registered_users.php");
exit();
}
?>

<body class="app">
    <?php include("inc/sidebar.php"); ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <!-- Display a message or perform additional actions after deletion if needed -->
                <h2>User Deleted Successfully</h2>
                <a href="registered_users.php" class="btn btn-primary">Back to Registered Users</a>
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-content-->
    </div>
    <!--//app-wrapper-->

    <!-- Javascript -->
    <script src="assets/plugins/bootstrap/ppopper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script>
</body>

</html>