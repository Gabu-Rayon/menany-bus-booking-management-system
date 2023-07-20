<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");

require_once("db-connect/config.php");

// Fetch data from the paid_tickets table
$paidTicketsQuery = "SELECT * FROM paid_tickets";
$paidTicketsStmt = $conn->prepare($paidTicketsQuery);
$paidTicketsStmt->execute();
$paidTicketsData = $paidTicketsStmt->fetchAll(PDO::FETCH_ASSOC);

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
                                <th>ID</th>
                                <th>Bus</th>
                                <th>Customer Name</th>
                                <th>From Terminal</th>
                                <th>To Destination</th>
                                <th>Departure</th>
                                <th>ETA</th>
                                <th>How Many</th>
                                <th>Luggage</th>
                                <th>Reference No</th>
                                <th>Amount Paid</th>
                                <th>Payment Method</th>
                                <th>Payment Ref No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paidTicketsData as $ticket) : ?>
                            <?php
                                // Fetch customer data from tbl_users based on customer_id
                                $customerId = $ticket['customer_id'];
                                $userQuery = "SELECT firstname, lastname FROM tbl_users WHERE id = :customerId";
                                $userStmt = $conn->prepare($userQuery);
                                $userStmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
                                $userStmt->execute();
                                $userData = $userStmt->fetch(PDO::FETCH_ASSOC);
                                $customerName = $userData['firstname'] . ' ' . $userData['lastname'];
                                ?>
                            <tr>
                                <td><?php echo $ticket['id']; ?></td>
                                <td><?php echo $ticket['bus']; ?></td>
                                <td><?php echo $customerName; ?></td>
                                <td><?php echo $ticket['from_terminal']; ?></td>
                                <td><?php echo $ticket['to_destination']; ?></td>
                                <td><?php echo $ticket['departure']; ?></td>
                                <td><?php echo $ticket['eta']; ?></td>
                                <td><?php echo $ticket['how_many']; ?></td>
                                <td><?php echo $ticket['luggage_count']; ?></td>
                                <td><?php echo $ticket['ref_no']; ?></td>
                                <td><?php echo $ticket['amount_paid']; ?></td>
                                <td><?php echo $ticket['type_payment']; ?></td>
                                <td><?php echo $ticket['payment_ref_no']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                        <tfoot>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Bus</th>
                                    <th>Customer Name</th>
                                    <th>From Terminal</th>
                                    <th>To Destination</th>
                                    <th>Departure</th>
                                    <th>ETA</th>
                                    <th>How Many</th>
                                    <th>Luggage</th>
                                    <th>Reference No</th>
                                    <th>Amount Paid</th>
                                    <th>Payment Method</th>
                                    <th>Payment Ref No</th>
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