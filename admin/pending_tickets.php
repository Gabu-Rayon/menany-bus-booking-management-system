<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");

require_once("db-connect/config.php");

// Fetch data from the unpaid_tickets table
$pendingTicketsQuery = "SELECT * FROM unpaid_tickets";
$pendingTicketsStmt = $conn->prepare($pendingTicketsQuery);
$pendingTicketsStmt->execute();
$pendingTicketsData = $pendingTicketsStmt->fetchAll(PDO::FETCH_ASSOC);

// Function to get customer's first and last name by customer ID
function getCustomerName($customerId)
{
global $conn;
$query = "SELECT firstname, lastname FROM tbl_users WHERE id = :customerId";
$stmt = $conn->prepare($query);
$stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userData) {
return $userData['firstname'] . ' ' . $userData['lastname'];
} else {
return 'N/A';
}
}
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
                        <h1 class="app-page-title mb-0">Pending Tickets</h1>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Bus</th>
                                <th>Bus Plate</th>
                                <th>From Terminal</th>
                                <th>To Destination</th>
                                <th>Departure</th>
                                <th>ETA</th>
                                <th>Fare</th>
                                <th>No. of Seats</th>
                                <th>Luggage Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendingTicketsData as $ticket) : ?>
                            <tr>
                                <td><?php echo getCustomerName($ticket['customer_id']); ?></td>
                                <td><?php echo $ticket['bus']; ?></td>
                                <td><?php echo $ticket['bus_plate']; ?></td>
                                <td><?php echo $ticket['from_terminal']; ?></td>
                                <td><?php echo $ticket['to_destination']; ?></td>
                                <td><?php echo $ticket['departure']; ?></td>
                                <td><?php echo $ticket['eta']; ?></td>
                                <td><?php echo $ticket['fare_amount']; ?></td>
                                <td><?php echo $ticket['how_many']; ?></td>
                                <td><?php echo $ticket['luggage_count']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                        <tfoot>
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Bus</th>
                                    <th>Bus Plate</th>
                                    <th>From Terminal</th>
                                    <th>To Destination</th>
                                    <th>Departure</th>
                                    <th>ETA</th>
                                    <th>Fare</th>
                                    <th>No. of Seats</th>
                                    <th>Luggage Count</th>
                                </tr>
                            </thead>
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