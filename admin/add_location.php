<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");


require_once("db-connect/config.php");

// Process the form data after submission
if (isset($_POST['add'])) {
$terminalName = $_POST['terminal_name'];
$city = $_POST['city'];
$state = $_POST['state'];
$status = $_POST['status'];

// Insert the new location record into the database
$insertQuery = "INSERT INTO location (terminal_name, city, state, status) VALUES (:terminalName, :city, :state,
:status)";
$stmt = $conn->prepare($insertQuery);
$stmt->bindParam(':terminalName', $terminalName, PDO::PARAM_STR);
$stmt->bindParam(':city', $city, PDO::PARAM_STR);
$stmt->bindParam(':state', $state, PDO::PARAM_STR);
$stmt->bindParam(':status', $status, PDO::PARAM_INT);

if ($stmt->execute()) {
// Redirect back to the locations page after successful addition
header("Location: location.php");
exit();
} else {
// Handle the case where insertion fails
echo "Failed to add the location.";
}
}
?>

<body class="app">
    <?php include("inc/sidebar.php"); ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Add Location</h1>
                    </div>
                    <div class="col-auto">
                        <a href="location.php" class="btn btn-primary">Locations</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <h2>Add Location</h2>

                    <form action="#" method="POST">
                        <div class="name mb-3">
                            <label class="sr-only" for="terminal-name">Terminal Name:</label>
                            <input id="terminal-name" name="terminal_name" type="text" class="form-control name"
                                placeholder="Enter Terminal Name">
                        </div>
                        <!--//form-group-->
                        <div class="name mb-3">
                            <label class="sr-only" for="city">City:</label>
                            <input id="city" name="city" type="text" class="form-control name" placeholder="Enter City">
                        </div>
                        <!--//form-group-->
                        <div class="bus_number mb-3">
                            <label class="sr-only" for="state">State:</label>
                            <input id="state" name="state" type="text" class="form-control bus-number"
                                placeholder="Enter State">
                        </div>
                        <!--//form-group-->
                        <div class="bus_number mb-3">
                            <label class="sr-only" for="status">Status:</label>
                            <select name="status" class="form-select">
                                <option class="form-option" value="0">Inactive</option>
                                <option class="form-option" value="1" selected>Active</option>
                            </select>
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <input id="submit" name="add" type="submit" class="btn btn-primary" value="Add">
                        </div>
                    </form>
                </div>
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