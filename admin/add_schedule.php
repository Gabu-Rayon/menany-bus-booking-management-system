<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Fetch data from the bus table for populating the bus dropdown menu
$busQuery = "SELECT id, name, bus_number FROM bus";
$busStmt = $conn->prepare($busQuery);
$busStmt->execute();
$buses = $busStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch data from the location table for populating the from location dropdown menu
$fromLocationQuery = "SELECT id, city FROM location";
$fromLocationStmt = $conn->prepare($fromLocationQuery);
$fromLocationStmt->execute();
$fromLocations = $fromLocationStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch data from the location table for populating the to location dropdown menu
$toLocationQuery = "SELECT id, city FROM location";
$toLocationStmt = $conn->prepare($toLocationQuery);
$toLocationStmt->execute();
$toLocations = $toLocationStmt->fetchAll(PDO::FETCH_ASSOC);

// Process the form data after submission
if (isset($_POST['add_schedule'])) {
    $busId = $_POST['bus_id'];
    $fromLocation = $_POST['from_location'];
    $toLocation = $_POST['to_location'];
    $departureTime = $_POST['departure_time'];
    $eta = $_POST['eta'];
    $status = $_POST['status'];
    $availability = $_POST['availability'];
    $price = $_POST['price'];

    // Insert the new schedule record into the schedule_list table
    $insertQuery = "INSERT INTO schedule_list (bus_id, from_location, to_location, departure_time, eta, status, availability, price) 
                    VALUES (:busId, :fromLocation, :toLocation, :departureTime, :eta, :status, :availability, :price)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bindParam(':busId', $busId, PDO::PARAM_INT);
    $stmt->bindParam(':fromLocation', $fromLocation, PDO::PARAM_INT);
    $stmt->bindParam(':toLocation', $toLocation, PDO::PARAM_INT);
    $stmt->bindParam(':departureTime', $departureTime, PDO::PARAM_STR);
    $stmt->bindParam(':eta', $eta, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':availability', $availability, PDO::PARAM_INT);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $stmt->execute();

    // Redirect back to the schedule_list page after adding the schedule
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
                        <h1 class="app-page-title mb-0">Add Schedule</h1>
                    </div>
                    <div class="col-auto">
                        <a href="schedule_list.php" class="btn btn-primary">Schedule List</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="bus_id">Select Bus:</label>
                            <select class="form-select" name="bus_id" id="bus_id" required>
                                <option value="" selected disabled>Select a bus</option>
                                <?php foreach ($buses as $bus) : ?>
                                <option value="<?php echo $bus['id']; ?>">
                                    <?php echo $bus['name'] . ' (' . $bus['bus_number'] . ')'; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="from_location">From Location:</label>
                            <select class="form-select" name="from_location" id="from_location" required>
                                <option value="" selected disabled>Select a location</option>
                                <?php foreach ($fromLocations as $location) : ?>
                                <option value="<?php echo $location['id']; ?>"><?php echo $location['city']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="to_location">To Location:</label>
                            <select class="form-select" name="to_location" id="to_location" required>
                                <option value="" selected disabled>Select a location</option>
                                <?php foreach ($toLocations as $location) : ?>
                                <option value="<?php echo $location['id']; ?>"><?php echo $location['city']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="departure_time">Departure Time:</label>
                            <input type="time" class="form-control" name="departure_time" id="departure_time" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="eta">ETA:</label>
                            <input type="time" class="form-control" name="eta" id="eta" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status">Status:</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="availability">Available Seats:</label>
                            <input type="number" class="form-control" name="availability" id="availability" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="price">Price:</label>
                            <input type="number" class="form-control" name="price" id="price" required>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="add_schedule" class="btn btn-primary" value="Add Schedule">
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