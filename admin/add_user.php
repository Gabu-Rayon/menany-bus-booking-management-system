<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");


require_once("db-connect/config.php");

// Process the form data after submission
if (isset($_POST['add'])) {
// Retrieve form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Validate password and confirm password fields
if ($password !== $confirmPassword) {
// Passwords don't match, display an error message
$error_message = "Passwords do not match.";
} else {
// Hash the password using password_hash() function
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user record into the database
$insertQuery = "INSERT INTO tbl_users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email,
:password)";
$stmt = $conn->prepare($insertQuery);
$stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

if ($stmt->execute()) {
// Redirect back to the registered users page after adding
header("Location: registered_users.php");
exit();
} else {
// Handle the case where insertion fails
echo "Failed to add the new user.";
}
}
}
?>

<body class="app">
    <?php include("inc/sidebar.php"); ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Add User</h1>
                    </div>
                    <div class="col-auto">
                        <a href="registered_users.php" class="btn btn-primary">Registered Users</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <h2>Add User</h2>
                    <form action="#" method="POST">
                        <div class="name mb-3">
                            <label for="firstname">First Name:</label>
                            <input id="firstname" name="firstname" type="text" class="form-control">
                        </div>
                        <!--//form-group-->
                        <div class="name mb-3">
                            <label for="lastname">Last Name:</label>
                            <input id="lastname" name="lastname" type="text" class="form-control">
                        </div>
                        <div class="password mb-3">
                            <label for="password">Password:</label>
                            <input id="password" name="password" type="password" class="form-control">
                        </div>
                        <!--//form-group-->

                        <!-- Confirm Password -->
                        <div class="password-confirm mb-3">
                            <label for="confirm_password">Confirm Password:</label>
                            <input id="confirm_password" name="confirm_password" type="password" class="form-control">
                        </div>
                        <!--//form-group-->
                        <div class="name mb-3">
                            <label for="email">Email:</label>
                            <input id="email" name="email" type="text" class="form-control">
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <input id="submit" name="add" type="submit" class="btn btn-primary" value="Add">
                        </div>
                    </form>
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