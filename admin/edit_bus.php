<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Process the form data after submission
if (isset($_POST['update'])) {
    $busId = $_POST['id'];
    $name = $_POST['name'];
    $busNumber = $_POST['bus_number'];
    $status = $_POST['status'];

    // Update the bus record in the database
    $updateQuery = "UPDATE bus SET name = :name, bus_number = :busNumber, status = :status WHERE id = :busId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':busNumber', $busNumber, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':busId', $busId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the bus table page after updating
        header("Location: buses.php");
        exit();
    } else {
        // Handle the case where the update fails
        echo "Failed to update the bus record.";
    }
}

// Retrieve the bus record to edit
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $busId = $_GET['id'];

    // Fetch bus record based on the ID
    $selectQuery = "SELECT * FROM bus WHERE id = :busId";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':busId', $busId, PDO::PARAM_INT);
    $stmt->execute();
    $busData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$busData) {
        // Bus record not found, redirect back to the bus table page
        header("Location: buses.php");
        exit();
    }
} else {
    // If no bus ID is provided, redirect back to the bus table page
    header("Location: buses.php");
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
                        <h1 class="app-page-title mb-0">Edit Bus</h1>
                    </div>
                    <div class="col-auto">
                        <a href="buses.php" class="btn btn-primary">Buses</a>
                    </div>
                </div>

                <div class="row g-4">
                    <h2>Edit Bus</h2>
                    <form action="edit_bus.php" method="POST">
                        <input id="id" name="id" type="hidden" class="form-control"
                            value="<?php echo $busData['id']; ?>">
                        <div class="mb-3">
                            <label class="form-label" for="bus-name">Name:</label>
                            <input id="name" name="name" type="text" class="form-control"
                                value="<?php echo $busData['name']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="bus-number">Bus Number:</label>
                            <input id="bus_number" name="bus_number" type="text" class="form-control"
                                value="<?php echo $busData['bus_number']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="status">Status:</label>
                            <select name="status" class="form-select">
                                <option value="0" <?php if ($busData['status'] == 0) echo 'selected'; ?>>Inactive
                                </option>
                                <option value="1" <?php if ($busData['status'] == 1) echo 'selected'; ?>>Active</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <input id="submit" name="update" type="submit" class="btn btn-primary" value="Update">
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