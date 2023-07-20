<?php
session_start();
require_once 'db-connect/config.php';
if (empty($_SESSION['id'])) {
    header('location: login.php');
}
include("inc/header.php");

?>

<body class="app">

    <?php
    include("inc/sidebar.php");
    ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Dashboard</h1>

                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Registered Customers</h4>
                                <div class="stats-figure">
                                    <?php
                                     // Count records in the tbl_users table
                                     $usersCountQuery = "SELECT COUNT(*) as totalUsers FROM tbl_users";
                                     $usersStmt = $conn->query($usersCountQuery);
                                     $usersCount = $usersStmt->fetchColumn();
                                     
                                     echo $usersCount ;
                                ?>
                                </div>
                                <div class="stats-meta text-success">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                    </svg> 20%
                                </div>
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="registered_users.php"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->

                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Menany Buses</h4>
                                <div class="stats-figure">
                                    <?php
                                // Count records in the bus table
                                $busCountQuery = "SELECT COUNT(*) as totalBuses FROM bus";
                                $busStmt = $conn->query($busCountQuery);
                                $busCount = $busStmt->fetchColumn();
                                
                                echo $busCount ;

                                ?>
                                </div>
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="buses.php"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Routes Schedules</h4>
                                <div class="stats-figure">
                                    <?php
                                // Count records in the schedule_list table
                                $scheduleListCountQuery = "SELECT COUNT(*) as totalSchedules FROM schedule_list";
                                $scheduleListStmt = $conn->query($scheduleListCountQuery);
                                $scheduleListCount = $scheduleListStmt->fetchColumn();

                                echo  $scheduleListCount;

                                ?>
                                </div>
                                <div class="stats-meta">
                                    Open</div>
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="#"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Tickets</h4>
                                <div class="stats-figure">
                                    <?php

                                // Count records in the tickets table
                                $ticketsCountQuery = "SELECT COUNT(*) as totalTickets FROM tickets";
                                $ticketsStmt = $conn->query($ticketsCountQuery);
                                $ticketsCount = $ticketsStmt->fetchColumn();
                                
                                echo  $ticketsCount ;

                                ?>
                                </div>
                                <div class="stats-meta"></div>
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="tickets.php"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Destinations</h4>
                                <div class="stats-figure">
                                    <?php

                                // Count records in the tickets table
                                $locationCountQuery = "SELECT COUNT(*) as totalLocations FROM location";
                                $locationStmt = $conn->query($locationCountQuery);
                                $locationCount = $locationStmt->fetchColumn();
                                
                                echo  $locationCount ;

                                ?>
                                </div>
                                <div class="stats-meta"></div>
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="location.php"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Paid Tickets</h4>
                                <div class="stats-figure">
                                    <?php

                                // Count records in the tickets table                              
                                $paidTicketsCountQuery = "SELECT COUNT(*) as totalPaidTickets FROM paid_tickets";
                                $paidTicketsStmt = $conn->query($paidTicketsCountQuery);
                                $paidTicketsCount = $paidTicketsStmt->fetchColumn();
                                
                                echo  $paidTicketsCount ;

                                ?>
                                </div>
                                <div class="stats-meta"></div>
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="paid_tickets.php"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Pending Tickets</h4>
                                <div class="stats-figure">
                                    <?php
                                  // Count records in the unpaid_tickets table
                                  $unpaidTicketsCountQuery = "SELECT COUNT(*) as totalUnpaidTickets FROM unpaid_tickets";
                                  $unpaidTicketsStmt = $conn->query($unpaidTicketsCountQuery);
                                  $unpaidTicketsCount = $unpaidTicketsStmt->fetchColumn();                                 
                                  
                                  echo  $unpaidTicketsCount ;

                                ?>
                                </div>
                                <div class="stats-meta"></div>
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="paid_tickets.php"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                </div>
                <!--//row-->

            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-content-->
    </div>
    <!--//app-wrapper-->


    <!-- Javascript -->
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script>
    <script src="assets/js/index-charts.js"></script>

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script>

</body>

</html>