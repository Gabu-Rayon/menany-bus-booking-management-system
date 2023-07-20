<?php
include("inc/header.php");
require_once("db-connect/config.php");

// Fetch all registered users from the tbl_users table
$selectQuery = "SELECT * FROM tbl_users";
$stmt = $conn->prepare($selectQuery);
$stmt->execute();
$usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                        <h1 class="app-page-title mb-0">Buses Schedule</h1>
                    </div>
                    <div class="col-auto">
                        <a href="add_user.php" class="btn btn-primary">Add New User</a>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usersData as $user) : ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['firstname']; ?></td>
                                <td><?php echo $user['lastname']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td>
                                    <!-- Add edit and delete links for each user -->
                                    <a href="edit_user.php?id=<?php echo $user['id']; ?>"
                                        class="btn btn-primary">Edit</a>
                                    <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                        <tfoot>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
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