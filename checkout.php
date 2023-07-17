<?php
session_start();
require_once 'config/connect.php';

if (empty($_SESSION['id'])) {
    header('location: sign-in.php');
    exit();
}
// Get the customer ID from the session
$customerId = $_SESSION['id'];

// Fetch data from the paid_tickets table
$paidTicketsQuery = "SELECT * FROM paid_tickets WHERE customer_id = :customerId";
$paidTicketsStmt = $conn->prepare($paidTicketsQuery);
$paidTicketsStmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
$paidTicketsStmt->execute();
$paidTicketsData = $paidTicketsStmt->fetch(PDO::FETCH_ASSOC);
 $bus = $paidTicketsData['bus'];

// Fetch data from the tickets table using the reference number from the paid_tickets table
if ($paidTicketsData) {
    $refNo = $paidTicketsData['ref_no'];
    $ticketsQuery = "SELECT * FROM tickets WHERE ticket_refNo = :refNo";
    $ticketsStmt = $conn->prepare($ticketsQuery);
    $ticketsStmt->bindParam(':refNo', $refNo, PDO::PARAM_STR);
    $ticketsStmt->execute();
    $ticketsData = $ticketsStmt->fetch(PDO::FETCH_ASSOC);

    // Now you have the data from both tables, you can use it to populate the card in your HTML
    // Example:
    $customerName = $_SESSION['username'];
    $amountPaid = $paidTicketsData['amount_paid'];
    $paymentMethod = $paidTicketsData['type_payment'];
    $noOfSeats = $ticketsData['no_of_seats'];
    $bus = $ticketsData['bus'];
    $fromTerminal = $ticketsData['from_terminals'];
    $toDestination = $ticketsData['to_destination'];
    $departure = $ticketsData['departure'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check Out Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <section class="h-100 h-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-lg-8 col-xl-6">
                            <div class="card rounded-3 text-success">

                                <div class="card-header text-center">
                                    <img src="images/bus.png"> Menany Buses Tickets
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Reference No:</h5>
                                    <h5 class="card-title">Customer Name:</h5>
                                    <h5 class="card-title">Amount Paid:</h5>
                                    <h5 class="card-title">Payment Method:</h5>
                                    <h5 class="card-title">No of Seats:</h5>
                                    <h5 class="card-title">Bus:</h5>
                                    <h5 class="card-title">Terminal:</h5>
                                    <h5 class="card-title">To:</h5>
                                    <h5 class="card-title">Departure:</h5>
                                    <p class="card-text text-center">Please Retain your Receipt upto end of your
                                        Journey<br>Menany Buses</p>
                                </div>
                            </div><br>
                            <a href="#" class="btn btn-primary"> Print

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                    <path
                                        d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                </svg> </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>