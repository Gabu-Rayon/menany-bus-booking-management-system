<?php
session_start();
require_once 'config/connect.php';

if (empty($_SESSION['id'])) {
    header('location: sign-in.php');
    exit();
}






if (isset($_POST['ticket_payment'])) {
    // Get the data from the form
    $customerId = $_SESSION['id'];
    $paymentMethod = $_POST['type_payment'];
    $amountPaid = $_POST['amount_paid'];

    // Check if payment method is selected
    if (empty($paymentMethod) || $paymentMethod === 'select_payment') {
        $_SESSION['select_payment_error'] = 'Please select a valid payment method.';
        header('location: book_now.php');
        exit();
    }

    // Perform validation for specific payment methods (Add more validation if needed)
    if ($paymentMethod === 'mpesa') {
        $mpesaRefNo = $_POST['mpesa_ref_no'];
        if (empty($mpesaRefNo)) {
            $_SESSION['mpesa_ref_no_error'] = 'Please enter Mpesa code.';
            header('location: book_now.php');
            exit();
        }
    } elseif ($paymentMethod === 'masterCard') {
        $masterCardNo = $_POST['master_card_no'];
        if (empty($masterCardNo)) {
            $_SESSION['master_card_no_error'] = 'Please enter Master card No.';
            header('location: book_now.php');
            exit();
        }
        $masterCardUsername = $_POST['mastercard_username'];
        if (empty($masterCardUsername)) {
            $_SESSION['master_card_username_error'] = 'Please enter Master Card Username.';
            header('location: book_now.php');
            exit();
        }
        $masterCardValid = $_POST['mastercard_valid'];
        if (empty($masterCardValid)) {
            $_SESSION['master_card_valid_error'] = 'Please enter Master Valid Until.';
            header('location: book_now.php');
            exit();
        }
    } elseif ($paymentMethod === 'visaCard') {
        $visaCardNo = $_POST['visacard_no'];
        if (empty($visaCardNo)) {
            $_SESSION['visa_card__no_error'] = 'Please enter Visa Card No.';
            header('location: book_now.php');
            exit();
        }
        $visaCardUsername = $_POST['visacard_username'];
        if (empty($visaCardUsername)) {
            $_SESSION['visa_card_username_error'] = 'Please enter Visa Card Username.';
            header('location: book_now.php');
            exit();
        }
        $visaCardValid = $_POST['visacard_valid'];
        if (empty($visaCardValid)) {
            $_SESSION['visa_card_valid_error'] = 'Please enter Visa Card Valid Until.';
            header('location: book_now.php');
            exit();
        }
    } elseif ($paymentMethod === 'bankAccount') {
        $branchName = $_POST['branch_name'];
        if (empty($branchName)) {
            $_SESSION['bank_name_error'] = 'Please enter Bank Branch Name.';
            header('location: book_now.php');
            exit();
        }
        $bankPaymentDate = $_POST['bankpayment_date'];
        if (empty($bankPaymentDate)) {
            $_SESSION['bank_payment_date_error'] = 'Please enter Payment Date.';
            header('location: book_now.php');
            exit();
        }
    }
    function generateRandomRefNo()
    {
        $prefix = 'REF'; // Prefix for the reference number (optional)
    $randomString = uniqid(); // Generate a unique ID based on the current time

    // Concatenate the prefix (if any) and the random string
        $refNo = $prefix . $randomString;
        return $refNo;
    }
    // Perform the database updates and inserts
    // Update unpaid_tickets table
    $updateQuery = "UPDATE paid_tickets SET ref_no = :refNo, amount_paid = :amountPaid, type_payment = :typePayment, payment_ref_no = :paymentRefNo WHERE customer_id = :customerId";
    $stmt = $conn->prepare($updateQuery);
    $refNo = generateRandomRefNo(); // Implement a function to generate a random reference number
    $paymentRefNo = ($paymentMethod === 'mpesa') ? $mpesaRefNo : null; // Set payment_ref_no based on payment method
    $stmt->bindParam(':refNo', $refNo, PDO::PARAM_STR);
    $stmt->bindParam(':amountPaid', $amountPaid, PDO::PARAM_STR);
    $stmt->bindParam(':typePayment', $paymentMethod, PDO::PARAM_STR);
    $stmt->bindParam(':paymentRefNo', $paymentRefNo, PDO::PARAM_STR);
    $stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Insert data into tickets table
        $insertQuery = "INSERT INTO tickets 
        (ticket_refNo, customer_id, amount_paid, type_payment,
         mpesa_refNo, mastercard_No,mastercard_username,mastercard_valid,
         visacard_No,visacard_username, visacard_valid, bank_branchName, bankPayment_Date)
         VALUES (:ticketRefNo, :customerId, :amountPaid, :typePayment, :mpesaRefNo,
          :masterCardNo,:masterCardUsername, :masterCardValid,:visaCardNo,
          :visaCardUsername, :visaCardValid, :branchName, :bankPaymentDate)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bindParam(':ticketRefNo', $refNo, PDO::PARAM_STR);
        $stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
        $stmt->bindParam(':amountPaid', $amountPaid, PDO::PARAM_STR);
        $stmt->bindParam(':typePayment', $paymentMethod, PDO::PARAM_STR);
        $stmt->bindParam(':mpesaRefNo', $paymentRefNo, PDO::PARAM_STR);
        $stmt->bindParam(':masterCardNo', $masterCardNo, PDO::PARAM_STR);
        $stmt->bindParam(':masterCardUsername', $masterCardUsername, PDO::PARAM_INT);
        $stmt->bindParam(':masterCardValid', $masterCardValid, PDO::PARAM_STR);
        $stmt->bindParam(':visaCardNo', $visaCardNo, PDO::PARAM_STR);
        $stmt->bindParam(':visaCardUsername', $paymentRefNo, PDO::PARAM_STR);
        $stmt->bindParam('visaCardValid', $visaCardUsername, PDO::PARAM_STR);
        $stmt->bindParam(':branchName', $branchName, PDO::PARAM_INT);
        $stmt->bindParam(':bankPaymentDate', $bankPaymentDate, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Payment successful. Your ticket is booked.';
            header('location: checkout.php');
            exit();
        } else {
            $_SESSION['error'] = 'Failed to insert data into tickets table.';
        }
    } else {
        $_SESSION['error'] = 'Failed to update unpaid_tickets table.';
    }

    header('location: book_now.php');
    exit();
}