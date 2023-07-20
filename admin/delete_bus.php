<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");


require_once("db-connect/config.php");

// Check if the bus ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $busId = $_GET['id'];

    // Delete the bus record from the database
    $deleteQuery = "DELETE FROM bus WHERE id = :busId";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bindParam(':busId', $busId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the bus table page after deletion
        header("Location: buses.php");
        exit();
    } else {
        // Handle the case where the deletion fails
        echo "Failed to delete the bus record.";
    }
} else {
    // If no bus ID is provided in the URL, redirect back to the bus table page
    header("Location: buses.php");
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
                    <h2>Deleting Bus...</h2>
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