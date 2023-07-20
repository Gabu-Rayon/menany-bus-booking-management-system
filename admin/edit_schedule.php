<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Process the form data after submission
if (isset($_POST['update'])) {
    $scheduleId = $_POST['schedule_id'];
    $busId = $_POST['bus_id'];
    $fromLocation = $_POST['from_location'];
    $toLocation = $_POST['to_location'];
    $departureTime = $_POST['departure_time'];
    $eta = $_POST['eta'];
    $status = $_POST['status'];
    $availability = $_POST['availability'];
    $price = $_POST['price'];

    // Update the schedule record in the database
    $updateQuery = "UPDATE schedule_list SET bus_id = :busId, from_location = :fromLocation, 
                    to_location = :toLocation, departure_time = :departureTime, eta = :eta, status = :status, 
                    availability = :availability, price = :price WHERE id = :scheduleId";
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

// Retrieve the schedule record to edit
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
?>

<body class="app">
    <?php
    include("inc/sidebar.php");
    ?>
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
                <div class="row g-4">
                    <h2>Edit Schedule</h2>
                    <form action="#" method="POST">
                        <input type="hidden" name="schedule_id" value="<?php echo $scheduleData['id']; ?>">
                        <div class="mb-3">
                            <label class="form-label">Bus</label>
                            <select class="form-select" name="bus_id" required>
                                <?php
                                // Fetch all buses from the bus table
                                $busQuery = "SELECT id, name FROM bus";
                                $stmt = $conn->prepare($busQuery);
                                $stmt->execute();
                                $buses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($buses as $bus) {
                                    $selected = ($bus['id'] == $scheduleData['bus_id']) ? 'selected' : '';
                                    echo "<option value='{$bus['id']}' {$selected}>{$bus['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">From Location</label>
                            <select class="form-select" name="from_location" required>
                                <?php
                                // Fetch all locations from the location table
                                $locationQuery = "SELECT id, name FROM location";
                                $stmt = $conn->prepare($locationQuery);
                                $stmt->execute();
                                $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($locations as $location) {
                                    $selected = ($location['id'] == $scheduleData['from_location']) ? 'selected' : '';
                                    echo "<option value='{$location['id']}' {$selected}>{$location['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">To Location</label>
                            <select class="form-select" name="to_location" required>
                                <?php
                                // Fetch all locations from the location table
                                foreach ($locations as $location) {
                                    $selected = ($location['id'] == $scheduleData['to_location']) ? 'selected' : '';
                                    echo "<option value='{$location['id']}' {$selected}>{$location['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departure Time</label>
                            <input type="text" class="form-control" name="departure_time"
                                value="<?php echo $scheduleData['departure_time']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ETA</label>
                            <input type="text" class="form-control" name="eta"
                                value="<?php echo $scheduleData['eta']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="0" <?php echo ($scheduleData['status'] == 0) ? 'selected' : ''; ?>>
                                    Inactive</option>
                                <option value="1" <?php echo ($scheduleData['status'] == 1) ? 'selected' : ''; ?>>Active
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Availability</label>
                            <input type="number" class="form-control" name="availability"
                                value="<?php echo $scheduleData['availability']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" name="price"
                                value="<?php echo $scheduleData['price']; ?>" required>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="update" class="btn btn-primary" value="Update">
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