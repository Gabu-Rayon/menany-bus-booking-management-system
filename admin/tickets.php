<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Fetch data from the tickets table and join with tbl_users for customer information
$query = "SELECT t.id, t.ticket_refNo, t.customer_id, t.amount_paid, t.type_payment,
                 t.mpesa_refNo, t.mastercard_No, t.mastercard_username, t.mastercard_valid,
                 t.visacard_No, t.visacard_username, t.visacard_valid, t.bank_branchname, t.bankPayment_Date,
                 u.firstname, u.lastname
          FROM tickets t
          INNER JOIN tbl_users u ON t.customer_id = u.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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
                                <th>#</th>
                                <th>Ticket Ref No</th>
                                <th>Customer Name</th>
                                <th>Amount Paid</th>
                                <th>Payment Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['ticket_refNo']; ?></td>
                                <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                <td>Ksh <?php echo $row['amount_paid']; ?></td>
                                <td>
                                    <?php
                                        $paymentType = $row['type_payment'];
                                        if ($paymentType === 'mpesa') {
                                            echo 'M-Pesa Ref No: ' . $row['mpesa_refNo'];
                                        } elseif ($paymentType === 'mastercard') {
                                            echo 'Mastercard No: ' . $row['mastercard_No'] . '<br>';
                                            echo 'Username: ' . $row['mastercard_username'] . '<br>';
                                            echo 'Validity: ' . $row['mastercard_valid'];
                                        } elseif ($paymentType === 'visacard') {
                                            echo 'Visa Card No: ' . $row['visacard_No'] . '<br>';
                                            echo 'Username: ' . $row['visacard_username'] . '<br>';
                                            echo 'Validity: ' . $row['visacard_valid'];
                                        }else if($paymentType === 'bankAccount'){  
                                            echo 'Bank Branch Name: ' . $row['bank_branchname'] . '<br>';
                                            echo 'Payment Date: ' . $row['bankPayment_Date'] . '<br>';

                                        }
                                        ?>
                                </td>
                                <td>
                                    <a href="print_receipt.php?id=<?php echo $row['id']; ?>" target="_blank"
                                        class="btn btn-primary">Print Receipt</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                        <tfoot>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket Ref No</th>
                                    <th>Customer Name</th>
                                    <th>Amount Paid</th>
                                    <th>Payment Details</th>
                                    <th>Action</th>
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
    <script>
    // Function to generate and download PDF receipt
    function generatePDF(ticketId) {
        const ticketRow = document.querySelector(`tr[data-ticket-id="${ticketId}"]`);
        const referenceNo = ticketRow.querySelector('.reference-no').innerText;
        const customerName = ticketRow.querySelector('.customer-name').innerText;
        const amountPaid = ticketRow.querySelector('.amount-paid').innerText;
        const paymentMethod = ticketRow.querySelector('.payment-method').innerText;
        const howMany = ticketRow.querySelector('.how-many').innerText;
        const toDestination = ticketRow.querySelector('.to-destination').innerText;
        const departure = ticketRow.querySelector('.departure').innerText;

        const receiptContent = `
            <h1>Ticket Receipt</h1>
            <p><b>Reference No:</b> ${referenceNo}</p>
            <p><b>Customer Name:</b> ${customerName}</p>
            <p><b>Amount Paid:</b> ${amountPaid}</p>
            <p><b>Payment Method:</b> ${paymentMethod}</p>
            <p><b>How Many:</b> ${howMany}</p>
            <p><b>To Destination:</b> ${toDestination}</p>
            <p><b>Departure:</b> ${departure}</p>
        `;

        const element = document.createElement('div');
        element.innerHTML = receiptContent;

        const opt = {
            margin: [10, 10],
            filename: `ticket_receipt_${referenceNo}.pdf`,
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

        // Generate and download the PDF
        html2pdf()
            .from(element)
            .set(opt)
            .save();
    }

    // Add event listener to "Print" buttons
    const printButtons = document.querySelectorAll('.btn-print');
    printButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const ticketId = event.target.getAttribute('data-ticket-id');
            generatePDF(ticketId);
        });
    });
    </script>
</body>

</html>