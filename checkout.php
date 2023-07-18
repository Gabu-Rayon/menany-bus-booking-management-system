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
 $fromTerminal = $paidTicketsData['from_terminal'];
 $toDestination = $paidTicketsData['to_destination'];
 $Departure = $paidTicketsData['departure'];
 $NoOfSeats = $paidTicketsData['how_many'];
 $Bus = $paidTicketsData['bus'];

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
    $userTicketsQuery = "SELECT * FROM tbl_users WHERE id = :customerId";
    $userTicketsStmt = $conn->prepare($userTicketsQuery);
    $userTicketsStmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
    $userTicketsStmt->execute();
    $userTicketsData = $userTicketsStmt->fetch(PDO::FETCH_ASSOC);

    $customerFirstName = $userTicketsData['firstname'];
    $customerLastName = $userTicketsData['lastname'];
    $amountPaid = $paidTicketsData['amount_paid'];
    $paymentMethod = $paidTicketsData['type_payment'];
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
    <script src="pdfLibrary/html2pdf.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <section class="h-100 h-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-lg-8 col-xl-6">
                            <div class="card rounded-3 ">

                                <div class="card-header text-center">
                                    <img src="images/bus.png"> Menany Buses Tickets
                                </div>
                                <div class="card-body">
                                    <p>
                                        <i class="text-success">Reference No:</i> <b><?php echo $refNo ; ?></b>
                                    </p>
                                    <p>
                                        <i class="text-success">Customer
                                            Name:</i> <b><?php echo $customerFirstName;?></b>
                                    </p>
                                    <p>
                                        <i class="text-success">Amount Paid:</i> <b><?php echo $amountPaid;?></b>
                                    </p>
                                    <p>
                                        <i class="text-success">Payment
                                            Method:</i> <b><?php echo $paymentMethod ; ?></b>
                                    </p>
                                    <p>
                                        <i class="text-success">No of Seats:</i> <b><?php echo $NoOfSeats;  ?></b>
                                    </p>
                                    <p>
                                        <i class="text-success">Bus:</i> <b><?php echo $Bus ; ?></b>
                                    </p>
                                    <p>
                                        <i class="text-success">Terminal:</i> <b><?php echo $fromTerminal;?></b>
                                    </p>
                                    <p>
                                        <i class="text-success">To:
                                        </i> <b><?php echo $toDestination ;?></b>
                                    </p>
                                    <p>
                                        <i class="text-success">Departure:</i> <b><?php echo $Departure;?></b>
                                    </p>
                                    <p class="card-text text-center">Please Retain your Receipt until end of your
                                        Journey<br>Menany Buses</p>
                                </div>
                            </div><br>
                            <button class="btn btn-primary" onclick="printSectionContent()"> Print

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                    <path
                                        d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                </svg> </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <!--the JavaScript for printing only the card 
    -->
    <script>
    function printSectionContent() {
        const sectionContent = document.querySelector('section');
        if (sectionContent) {
            // Clone the section content
            const clonedContent = sectionContent.cloneNode(true);

            // Create a new window for printing
            const printWindow = window.open('', '_blank');
            printWindow.document.open();

            // Write the cloned section content to the new window
            printWindow.document.write('<!doctype html><html lang="en"><head>');
            printWindow.document.write('<meta charset="utf-8">');
            printWindow.document.write('<meta name="viewport" content="width=device-width, initial-scale=1">');
            printWindow.document.write('<title>Print Bus Ticket Receipt</title>');
            printWindow.document.write(
                '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">'
            );
            printWindow.document.write('</head><body>');
            printWindow.document.write(clonedContent
                .innerHTML); // Use innerHTML to get only the content inside the section
            printWindow.document.write('</body></html>');

            // Close the document for writing
            printWindow.document.close();

            // Print the new window
            printWindow.print();

            // Close the new window after printing is done
            printWindow.close();
        }
        createAndDownloadPDF(clonedContent.innerHTML);
    }

    function createAndDownloadPDF(htmlContent) {
        const opt = {
            margin: 10,
            filename: 'receipt.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        // Create the PDF from the HTML content using html2pdf.js
        html2pdf().set(opt).from(htmlContent).save();
    }
    </script>
</body>

</html>