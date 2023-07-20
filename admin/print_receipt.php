<?php
// print_receipt.php

require_once("db-connect/config.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ticketId = $_GET['id'];

    // Fetch ticket record based on the ID
    $selectQuery = "SELECT t.id, t.ticket_refNo, t.customer_id, t.amount_paid, t.type_payment,
                    t.to_destination, t.departure,
                    u.firstname, u.lastname
                    FROM tickets t
                    INNER JOIN tbl_users u ON t.customer_id = u.id
                    WHERE t.id = :ticketId";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':ticketId', $ticketId, PDO::PARAM_INT);
    $stmt->execute();
    $ticketData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ticketData) {
        // Ticket record not found, redirect back to the tickets page
        header("Location: tickets.php");
        exit();
    }

    // Generate the receipt content
    $content = "Reference No: " . $ticketData['ticket_refNo'] . "\n";
    $content .= "Customer Name: " . $ticketData['firstname'] . " " . $ticketData['lastname'] . "\n";
    $content .= "Payment Method: " . $ticketData['type_payment'] . "\n";
    $content .= "How Many: " . $ticketData['how_many'] . "\n";
    $content .= "To Destination: " . $ticketData['to_destination'] . "\n";
    $content .= "Departure: " . $ticketData['departure'] . "\n";

    // Set the appropriate content type for the download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="receipt.txt"');

    // Output the receipt content and force download
    echo $content;
    exit();
} else {
    // If no ticket ID is provided or it's not numeric, redirect back to the tickets page
    header("Location: tickets.php");
    exit();
}