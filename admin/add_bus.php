<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Process the form data after submission
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $busNumber = $_POST['bus_number'];
    $status = $_POST['status'];

    // Insert the new bus record into the database
    $insertQuery = "INSERT INTO bus (name, bus_number, status) VALUES (:name, :busNumber, :status)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':busNumber', $busNumber, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the bus table page after adding the new bus
        header("Location: buses.php");
        exit();
    } else {
        // Handle the case where the insertion fails
        echo "Failed to add the new bus record.";
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
                        <h1 class="app-page-title mb-0">Add Bus</h1>
                    </div>
                    <div class="col-auto">
                        <a href="buses.php" class="btn btn-primary">Buses</a>
                    </div>
                </div>

                <div class="row g-4">
                    <h2>Add Bus</h2>
                    <form action="add_bus.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="bus-name">Name:</label>
                            <input id="name" name="name" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="bus-number">Bus Number:</label>
                            <input id="bus_number" name="bus_number" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="status">Status:</label>
                            <select name="status" class="form-select" required>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <input id="submit" name="add" type="submit" class="btn btn-primary" value="Add">
                        </div>
                    </form>
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