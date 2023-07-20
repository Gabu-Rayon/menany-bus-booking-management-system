<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Fetch all schedules from the schedule_list table
$selectQuery = "SELECT s.id, s.from_location, s.to_location, s.departure_time, s.eta, s.status, 
                s.availability, s.price, b.name as bus_name 
                FROM schedule_list s 
                INNER JOIN bus b ON s.bus_id = b.id
                INNER JOIN location l1 ON s.from_location = l1.id
                INNER JOIN location l2 ON s.to_location = l2.id";
$stmt = $conn->prepare($selectQuery);
$stmt->execute();
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                            <tr>
                                <th>From Location</th>
                                <th>To Location</th>
                                <th>Departure Time</th>
                                <th>ETA</th>
                                <th>Status</th>
                                <th>Availability</th>
                                <th>Price</th>
                                <th>Bus</th>
                                <th>Action</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($schedules as $schedule) : ?>
                            <tr>
                                <td><?php echo $schedule['from_location']; ?></td>
                                <td><?php echo $schedule['to_location']; ?></td>
                                <td><?php echo $schedule['departure_time']; ?></td>
                                <td><?php echo $schedule['eta']; ?></td>
                                <td><?php echo ($schedule['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                <td><?php echo $schedule['availability']; ?></td>
                                <td><?php echo $schedule['price']; ?></td>
                                <td><?php echo $schedule['bus_name']; ?></td>
                                <td>
                                    <a href="edit_schedule.php?id=<?php echo $schedule['id']; ?>"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="delete_schedule.php?id=<?php echo $schedule['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>From Location</th>
                                <th>To Location</th>
                                <th>Departure Time</th>
                                <th>ETA</th>
                                <th>Status</th>
                                <th>Availability</th>
                                <th>Price</th>
                                <th>Bus</th>
                                <th>Action</th>
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