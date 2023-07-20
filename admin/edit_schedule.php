<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Check if the schedule ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $scheduleId = $_GET['id'];

    // Fetch schedule record based on the ID
    $selectQuery = "SELECT * FROM schedule_list WHERE id = :scheduleId";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':scheduleId', $scheduleId, PDO::PARAM_INT);
    $stmt->execute();
    $scheduleData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$scheduleData) {
        // Schedule record not found, redirect back to the schedule list page
        header("Location: schedule_list.php");
        exit();
    }
} else {
    // If no schedule ID is provided, redirect back to the schedule list page
    header("Location: schedule_list.php");
    exit();
}

// Process the form data after submission
if (isset($_POST['update'])) {
    $busId = $_POST['bus_id'];
    $fromLocation = $_POST['from_location'];
    $toLocation = $_POST['to_location'];
    $departureTime = $_POST['departure_time'];
    $eta = $_POST['eta'];
    $status = $_POST['status'];
    $availability = $_POST['availability'];
    $price = $_POST['price'];

    // Update the schedule record in the database
    $updateQuery = "UPDATE schedule_list SET bus_id = :busId, from_location = :fromLocation, to_location = :toLocation,
                    departure_time = :departureTime, eta = :eta, status = :status, availability = :availability,
                    price = :price WHERE id = :scheduleId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':busId', $busId, PDO::PARAM_INT);
    $stmt->bindParam(':fromLocation', $fromLocation, PDO::PARAM_INT);
    $stmt->bindParam(':toLocation', $toLocation, PDO::PARAM_INT);
    $stmt->bindParam(':departureTime', $departureTime, PDO::PARAM_STR);
    $stmt->bindParam(':eta', $eta, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':availability', $availability, PDO::PARAM_INT);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':scheduleId', $scheduleId, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect back to the schedule list page after updating
    header("Location: schedule_list.php");
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
                        <h1 class="app-page-title mb-0">Edit Schedule</h1>
                    </div>
                    <div class="col-auto">
                        <a href="schedule_list.php" class="btn btn-primary">Schedule List</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <h2>Edit Schedule</h2>

                    <form action="#" method="POST">
                        <div class="name mb-3">
                            <label class="sr-only" for="bus_id">Bus ID:</label>
                            <input id="bus_id" name="bus_id" type="text" class="form-control"
                                value="<?php echo $scheduleData['bus_id']; ?>" required>
                        </div>
                        <!--//form-group-->
                        <div class="from_location mb-3">
                            <label class="sr-only" for="from_location">From Location:</label>
                            <input id="from_location" name="from_location" type="text" class="form-control"
                                value="<?php echo $scheduleData['from_location']; ?>" required>
                        </div>
                        <!--//form-group-->
                        <div class="to_location mb-3">
                            <label class="sr-only" for="to_location">To Location:</label>
                            <input id="to_location" name="to_location" type="text" class="form-control"
                                value="<?php echo $scheduleData['to_location']; ?>" required>
                        </div>
                        <!--//form-group-->
                        <div class="departure_time mb-3">
                            <label class="sr-only" for="departure_time">Departure Time:</label>
                            <input id="departure_time" name="departure_time" type="text" class="form-control"
                                value="<?php echo $scheduleData['departure_time']; ?>" required>
                        </div>
                        <!--//form-group-->
                        <div class="eta mb-3">
                            <label class="sr-only" for="eta">ETA:</label>
                            <input id="eta" name="eta" type="text" class="form-control"
                                value="<?php echo $scheduleData['eta']; ?>" required>
                        </div>
                        <!--//form-group-->
                        <div class="status mb-3">
                            <label class="sr-only" for="status">Status:</label>
                            <select name="status" class="form-select" required>
                                <option value="0" <?php if ($scheduleData['status'] == 0) echo 'selected'; ?>>Inactive
                                </option>
                                <option value="1" <?php if ($scheduleData['status'] == 1) echo 'selected'; ?>>Active
                                </option>
                            </select>
                        </div>
                        <!--//form-group-->
                        <div class="availability mb-3">
                            <label class="sr-only" for="availability">Availability:</label>
                            <input id="availability" name="availability" type="text" class="form-control"
                                value="<?php echo $scheduleData['availability']; ?>" required>
                        </div>
                        <!--//form-group-->
                        <div class="price mb-3">
                            <label class="sr-only" for="price">Price:</label>
                            <input id="price" name="price" type="text" class="form-control"
                                value="<?php echo $scheduleData['price']; ?>" required>
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