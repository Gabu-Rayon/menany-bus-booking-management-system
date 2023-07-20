<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Check if the location ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $locationId = $_GET['id'];

    // Fetch location record based on the ID
    $selectQuery = "SELECT * FROM location WHERE id = :locationId";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':locationId', $locationId, PDO::PARAM_INT);
    $stmt->execute();
    $locationData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$locationData) {
        // Location record not found, redirect back to the locations page
        header("Location: location.php");
        exit();
    }
} else {
    // If no location ID is provided, redirect back to the locations page
    header("Location: location.php");
    exit();
}

// Process the form data after submission
if (isset($_POST['update'])) {
    $locationId = $_POST['id'];
    $terminalName = $_POST['terminal_name'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $status = $_POST['status'];

    // Update the location record in the database
    $updateQuery = "UPDATE location SET terminal_name = :terminalName, city = :city, state = :state, status = :status WHERE id = :locationId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':terminalName', $terminalName, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':state', $state, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':locationId', $locationId, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect back to the locations page after updating
    header("Location: location.php");
    exit();
}
?>

<body class="app">
    <?php include("inc/sidebar.php"); ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Edit Location</h1>
                    </div>
                    <div class="col-auto">
                        <a href="location.php" class="btn btn-primary">Locations</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <h2>Edit Location</h2>

                    <form action="#" method="POST">
                        <input type="hidden" name="id" value="<?php echo $locationData['id']; ?>">
                        <div class="name mb-3">
                            <label class="sr-only" for="terminal-name">Terminal Name:</label>
                            <input id="terminal-name" name="terminal_name" type="text" class="form-control name"
                                value="<?php echo $locationData['terminal_name']; ?>">
                        </div>
                        <!--//form-group-->
                        <div class="name mb-3">
                            <label class="sr-only" for="city">City:</label>
                            <input id="city" name="city" type="text" class="form-control name"
                                value="<?php echo $locationData['city']; ?>">
                        </div>
                        <!--//form-group-->
                        <div class="bus_number mb-3">
                            <label class="sr-only" for="state">State:</label>
                            <input id="state" name="state" type="text" class="form-control bus-number"
                                value="<?php echo $locationData['state']; ?>">
                        </div>
                        <!--//form-group-->
                        <div class="bus_number mb-3">
                            <label class="sr-only" for="status">Status:</label>
                            <select name="status" class="form-select">
                                <option class="form-option" value="0"
                                    <?php if ($locationData['status'] == 0) echo 'selected'; ?>>Inactive</option>
                                <option class="form-option" value="1"
                                    <?php if ($locationData['status'] == 1) echo 'selected'; ?>>Active</option>
                            </select>
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <input id="submit" name="update" type="submit" class="btn btn-primary" value="Update">
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