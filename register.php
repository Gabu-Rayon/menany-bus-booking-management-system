<?php
require_once("config/connect.php");
// Validate and process form data
$errors = [];

// Check if form fields are empty
if (empty($_POST['firstname'])) {
    $errors['first_error'] = 'First name is required';
}
if (empty($_POST['lastname'])) {
    $errors['last_error'] = 'Last name is required';
}
if (empty($_POST['email'])) {
    $errors['email_error'] = 'Email is required';
}
if (empty($_POST['password'])) {
    $errors['password_error'] = 'Password is required';
}
if (empty($_POST['confirm_password'])) {
    $errors['confirm_password_error'] = 'Confirm Password is required';
}
if (empty($_POST['contact'])) {
    $errors['contact_error'] = 'Contact is required';
}

// Check if passwords match
if ($_POST['password'] !== $_POST['confirm_password']) {
    $errors['confirm_password_error'] = 'Passwords do not match';
}

// If there are no errors, save the data to the database
if (empty($errors)) {
            // Prepare and execute the INSERT query
        $stmt = $conn->prepare("INSERT INTO tbl_users (firstname, lastname, email,  password,contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_DEFAULT), // Store password securely
            $_POST['contact']
        ]);

        $response['success'] = 'Registration successful!';
        echo json_encode($response);
        exit();
    
}

// Return errors as JSON response
echo json_encode($errors);
?>