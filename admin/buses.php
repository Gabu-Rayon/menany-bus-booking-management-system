<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Function to convert status code to status text
function getStatusText($statusCode)
{
    return $statusCode == 1 ? 'Active' : 'Inactive';
}

// Fetch all data from the bus table
$busQuery = "SELECT * FROM bus";
$busStmt = $conn->prepare($busQuery);
$busStmt->execute();
$busData = $busStmt->fetchAll(PDO::FETCH_ASSOC);
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
                        <h1 class="app-page-title mb-0">Buses</h1>
                    </div>
                    <div class="col-auto">
                        <a href="add_bus.php" class="btn btn-primary">Add New Bus</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Bus Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($busData as $bus) : ?>
                            <tr>
                                <td><?php echo $bus['id']; ?></td>
                                <td><?php echo $bus['name']; ?></td>
                                <td><?php echo $bus['bus_number']; ?></td>
                                <td><?php echo getStatusText($bus['status']); ?></td>
                                <td>
                                    <a href="edit_bus.php?id=<?php echo $bus['id']; ?>"
                                        class="btn btn-sm btn-primary">Edit</a> |
                                    <a href="delete_bus.php?id=<?php echo $bus['id']; ?>" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this bus?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Bus Number</th>
                                <th>Status</th>
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