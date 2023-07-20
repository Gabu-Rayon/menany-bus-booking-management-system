<?php
session_start();
if(empty($_SESSION['id'])){
   header('location: login.php');    
}
include("inc/header.php");

require_once("db-connect/config.php");

// Process the form data after submission
if (isset($_POST['update'])) {
$userId = $_POST['user_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

// Update the user record in the database
$updateQuery = "UPDATE tbl_users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :userId";
$stmt = $conn->prepare($updateQuery);
$stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();

// Redirect back to the registered users page after updating
header("Location: registered_users.php");
exit();
}

// Retrieve the user record to edit
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
$userId = $_GET['id'];

// Fetch user record based on the ID
$selectQuery = "SELECT * FROM tbl_users WHERE id = :userId";
$stmt = $conn->prepare($selectQuery);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$userData) {
// User record not found, redirect back to the registered users page
header("Location: registered_users.php");
exit();
}
} else {
// If no user ID is provided, redirect back to the registered users page
header("Location: registered_users.php");
exit();
}
?>

<body class="app">
    <?php include("inc/sidebar.php"); ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Edit User</h1>
                    </div>
                    <div class="col-auto">
                        <a href="registered_users.php" class="btn btn-primary">Registered Users</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <!-- Display the error message, if any -->
                    <?php if (isset($error_message)) : ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <form action="#" method="POST">
                        <div class="name mb-3">
                            <input id="user_id" name="user_id" type="hidden" class="form-control"
                                value="<?php echo $userData['id']; ?>">
                        </div>
                        <!--//form-group-->
                        <div class="name mb-3">
                            <label for="firstname">First Name:</label>
                            <input id="firstname" name="firstname" type="text" class="form-control"
                                value="<?php echo $userData['firstname']; ?>">
                        </div>
                        <!--//form-group-->
                        <div class="name mb-3">
                            <label for="lastname">Last Name:</label>
                            <input id="lastname" name="lastname" type="text" class="form-control"
                                value="<?php echo $userData['lastname']; ?>">
                        </div>
                        <!--//form-group-->
                        <!-- Password -->
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
                            <input id="email" name="email" type="text" class="form-control"
                                value="<?php echo $userData['email']; ?>">
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <input id="submit" name="update" type="submit" class="btn btn-primary" value="Update">
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