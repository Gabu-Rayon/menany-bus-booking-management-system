<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");

require_once("db-connect/config.php");

// Fetch data from schedule_list table with related information from bus and location tables
$selectQuery = "SELECT sl.id, b.name AS bus_name, b.bus_number, l1.city AS from_location, l2.city AS to_location,
sl.departure_time, sl.eta, sl.status, sl.availability, sl.price
FROM schedule_list sl
JOIN bus b ON sl.bus_id = b.id
JOIN location l1 ON sl.from_location = l1.id
JOIN location l2 ON sl.to_location = l2.id";
$stmt = $conn->prepare($selectQuery);
$stmt->execute();
$scheduleList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<header>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script defer src="assets/js/dataTables.js">
    </script>

</header>

<body class="app">
    <?php
    include("inc/sidebar.php");
    ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Buses Schedule</h1>
                    </div>
                    <div class="col-auto">
                        <a href="add_schedule.php" class="btn btn-primary">Add New Bus Schedule</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bus Name</th>
                                <th scope="col">Bus Number</th>
                                <th scope="col">From Location</th>
                                <th scope="col">To Location</th>
                                <th scope="col">Departure Time</th>
                                <th scope="col">ETA</th>
                                <th scope="col">Status</th>
                                <th scope="col">Available Seats</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($scheduleList as $schedule) : ?>
                            <tr>
                                <th scope="row"><?php echo $schedule['id']; ?></th>
                                <td><?php echo $schedule['bus_name']; ?></td>
                                <td><?php echo $schedule['bus_number']; ?></td>
                                <td><?php echo $schedule['from_location']; ?></td>
                                <td><?php echo $schedule['to_location']; ?></td>
                                <td><?php echo $schedule['departure_time']; ?></td>
                                <td><?php echo $schedule['eta']; ?></td>
                                <td><?php echo $schedule['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                <td><?php echo $schedule['availability']; ?></td>
                                <td>Ksh <?php echo $schedule['price']; ?></td>
                                <td>
                                    <a href="edit_schedule.php?id=<?php echo $schedule['id']; ?>"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete_schedule.php?id=<?php echo $schedule['id']; ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bus Name</th>
                                <th scope="col">Bus Number</th>
                                <th scope="col">From Location</th>
                                <th scope="col">To Location</th>
                                <th scope="col">Departure Time</th>
                                <th scope="col">ETA</th>
                                <th scope="col">Status</th>
                                <th scope="col">Available Seats</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </tfoot>
                    </table>

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