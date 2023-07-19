<?php
session_start();
require_once 'config/connect.php';

if (empty($_SESSION['id'])) {
    header('location: sign-in.php');
} else {
    $id = $_SESSION['id'];
    $sql = $conn->prepare("SELECT * FROM `tbl_users` WHERE `id`='$id'");
    $sql->execute();
    $fetch = $sql->fetch();
    $cust_id = $fetch['id'];

    // Fetch all data from the unpaid_tickets table
    $selectQuery = "SELECT * FROM unpaid_tickets WHERE `customer_id` ='$cust_id'" ;
    $stmt = $conn->query($selectQuery);
    $unpaidTicketsData = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

<!DOCTYPE html>
<html lang="en">
<title>Book Schedule</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Travelix Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
}
</style>
</head>

<body>

    <div class="super_container">

        <!-- Header -->

        <header class="header">

            <!-- Top Bar -->

            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="phone">+254 7324 56789</div>
                            <div class="social">
                                <ul class="social_list">
                                    <li class="social_list_item"><a href="#"><i class="fa fa-pinterest"
                                                aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-facebook"
                                                aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-twitter"
                                                aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-dribbble"
                                                aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-behance"
                                                aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-linkedin"
                                                aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="user_box ml-auto">
                                <div class="user_box_login user_box_link"><a href="sign-in.php">Sign in</a></div>
                                <div class="user_box_register user_box_link"><a href="sign-up.php">Sign Up</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation -->

            <nav class="main_nav">
                <div class="container">
                    <div class="row">
                        <div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
                            <div class="logo_container">
                                <div class="logo"><a href="index.php"><img src="/images/logo.png" alt="">Menany
                                        Buses</a>
                                </div>
                            </div>
                            <div class="main_nav_container ml-auto">
                                <ul class="main_nav_list">
                                    <li class="main_nav_item"><a href="index.php">home</a></li>
                                    <li class="main_nav_item"><a href="about.php">about us</a></li>
                                    <li class="main_nav_item"><a href="offers.php">offers</a></li>
                                    <li class="main_nav_item"><a href="blog.php">news</a></li>
                                    <li class="main_nav_item"><a href="contact.php">contact</a></li>
                                </ul>
                            </div>
                            <div class="content_search ml-lg-0 ml-auto">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="17px"
                                    height="17px" viewBox="0 0 512 512" enable-background="new 0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path class="mag_glass" fill="#FFFFFF" d="M78.438,216.78c0,57.906,22.55,112.343,63.493,153.287c40.945,40.944,95.383,63.494,153.287,63.494
											s112.344-22.55,153.287-63.494C489.451,329.123,512,274.686,512,216.78c0-57.904-22.549-112.342-63.494-153.286
											C407.563,22.549,353.124,0,295.219,0c-57.904,0-112.342,22.549-153.287,63.494C100.988,104.438,78.439,158.876,78.438,216.78z
											M119.804,216.78c0-96.725,78.69-175.416,175.415-175.416s175.418,78.691,175.418,175.416
											c0,96.725-78.691,175.416-175.416,175.416C198.495,392.195,119.804,313.505,119.804,216.78z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path class="mag_glass" fill="#FFFFFF" d="M6.057,505.942c4.038,4.039,9.332,6.058,14.625,6.058s10.587-2.019,14.625-6.058L171.268,369.98
											c8.076-8.076,8.076-21.172,0-29.248c-8.076-8.078-21.172-8.078-29.249,0L6.057,476.693
											C-2.019,484.77-2.019,497.865,6.057,505.942z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <form id="search_form" class="search_form bez_1">
                                <input type="search" class="search_content_input bez_1">
                            </form>

                            <div class="hamburger">
                                <i class="fa fa-bars trans_200"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

        </header>

        <div class="menu trans_500">
            <div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
                <div class="menu_close_container">
                    <div class="menu_close"></div>
                </div>
                <div class="logo menu_logo"><a href="#"><img src="/images/logo.png" alt=""></a></div>
                <ul>
                    <li class="menu_item"><a href="#">home</a></li>
                    <li class="menu_item"><a href="about.php">about us</a></li>
                    <li class="menu_item"><a href="offers.php">offers</a></li>
                    <li class="menu_item"><a href="blog.php">news</a></li>
                    <li class="menu_item"><a href="contact.php">contact</a></li>
                </ul>
            </div>
        </div>
        <!-- Home -->

        <div class="home">
            <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/09.jpg">
            </div>
            <div class="home_content">
                <div class="home_title">Book Schedule</div>
            </div>
        </div>

        <!-- Book Now -->
        <div class="contact_form_section">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <!-- Contact Form -->
                        <form method="post" action="#">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Bus Name</th>
                                        <th>Bus Plate</th>
                                        <th>From Terminal</th>
                                        <th>To Destination</th>
                                        <th>Departure</th>
                                        <th>ETA</th>
                                        <th>Fare Amount</th>
                                        <th>How Many</th>
                                        <th>Luggage Count</th>
                                        <th>Pay</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($unpaidTicketsData as $ticket) {
        $amount_topay = $ticket['fare_amount']; ?>
                                    <tr>
                                        <td><?php echo $ticket['bus']; ?>
                                        </td>
                                        <td><?php echo $ticket['bus_plate']; ?>
                                        </td>
                                        <td><?php echo $ticket['from_terminal']; ?>
                                        </td>
                                        <td><?php echo $ticket['to_destination']; ?>
                                        </td>
                                        <td><?php echo $ticket['departure']; ?>
                                        </td>
                                        <td><?php echo $ticket['eta']; ?>
                                        </td>
                                        <td><?php echo $ticket['fare_amount']; ?>
                                        </td>
                                        <td><?php echo $ticket['how_many']; ?>
                                        </td>
                                        <td><?php echo $ticket['luggage_count']; ?>
                                        </td>
                                        <td>
                                            <!-- Buttons for "Pay Ticket" and "Delete Ticket" -->
                                            <button <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" value="<?php echo $ticket['id']; ?>">
                                                Pay Ticket</button>

                                        </td>
                                        <td>
                                            <button type="submit" name="delete_ticket" class="btn btn-danger"
                                                onclick="confirmDelete(<?php echo $ticket['id']; ?>)">Delete
                                                Ticket</button>
                                        </td>
                                    </tr>
                                    <?php
    } ?>
                                </tbody>
                            </table>
                        </form>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal content ... -->
                                    <div class="modal-body">
                                        <!-- Payment form content -->
                                        <div id="formErrors"></div>
                                        <form method="post" action="process_tickets.php" id="paymentForm">
                                            <!-- Payment form fields here... -->
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label for="amount_topay" class="text-dark">Amount to
                                                            Pay <strong><i> Kshs</i></strong>
                                                        </label>
                                                        <input id="amount_paid" class="form-control" name="amount_paid"
                                                            type="number" value="<?php echo $amount_topay; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label for="select_paymentMethod" class="text-light">Select
                                                            Payment
                                                            Method</label>
                                                        <select class="form-select" name="type_payment"
                                                            id="paymentMethodSelect">

                                                            <option value="select_payment">Please select Payment method
                                                            </option>
                                                            <option value="mpesa"><strong>Mpesa</strong></option>
                                                            <option value="masterCard"><strong>Master Card</strong>
                                                            </option>
                                                            <option value="visaCard"><strong>Visa Card</strong></option>
                                                            <option value="bankAccount"><strong>Bank Account</strong>
                                                            </option>
                                                        </select>
                                                    </div><br>
                                                    <!-- Input fields for specific payment methods -->
                                                    <div class="payment-fields" id="mpesaFields" style="display: none;">
                                                        <p>
                                                        <ul>
                                                            <li><strong>Agent No :</strong> 149890</li>
                                                            <li><strong>Store Number :</strong> 890941</li>
                                                            <li><strong>Account Name :</strong> Menany Buses Sacco</li>
                                                        </ul>
                                                        </p>

                                                        <label class="form-label" for="mpesa-code"><small>Enter Mpesa
                                                                code after Payment</small></label>
                                                        <input id="mpesa_ref_no" class="form-control"
                                                            name="mpesa_ref_no" type="text" placeholder="Mpesa code">
                                                        <span class="text-danger">
                                                            <?php echo isset($_SESSION['mpesa_ref_no_error']) ? $_SESSION['mpesa_ref_no_error'] : ''; ?>
                                                        </span>

                                                    </div>
                                                    <div class="payment-fields" id="masterCardFields"
                                                        style="display: none;">
                                                        <input id="master_card_no" class="form-control"
                                                            name="mastercard_no" type="number"
                                                            placeholder="Master Card Number">
                                                        <span
                                                            class="text-danger"><?php echo isset($_SESSION['master_card_no_error']) ? $_SESSION['master_card_no_error'] : ''; ?></span>

                                                        <br>
                                                        <input id="mastercard_username" class="form-control"
                                                            name="mastercard_username" type="text"
                                                            placeholder="Master card Username">
                                                        <span class="text-danger">
                                                            <?php echo isset($_SESSION['master_card_username_error']) ? $_SESSION['master_card_username_error'] : ''; ?></span>

                                                        <br>
                                                        <input id="mastercard_valid" class="form-control"
                                                            name="mastercard_valid" type="date"
                                                            placeholder="Valid Until">
                                                        <span class="text-danger">
                                                            <?php echo isset($_SESSION['master_card_username_error']) ? $_SESSION['master_card_username_error'] : ''; ?></span>


                                                    </div>
                                                    <div class="payment-fields" id="visaCardFields"
                                                        style="display: none;">
                                                        <input id="visa_card_no" class="form-control" name="visacard_no"
                                                            type="number" placeholder="Visa Card Number">
                                                        <span class="text-danger">
                                                            <?php echo isset($_SESSION['visa_card_no_error']) ? $_SESSION['visa_card_no_error'] : ''; ?></span>

                                                        <br>
                                                        <input id="visacard_username" class="form-control"
                                                            name="visacard_username" type="text"
                                                            placeholder="Visa card Username">
                                                        <span class="text-danger">
                                                            <?php echo isset($_SESSION['visa_card_error']) ? $_SESSION['visa_card_error'] : ''; ?></span>

                                                        <br>
                                                        <input id="mastercard_valid" class="form-control"
                                                            name="visacard_valid" type="date" placeholder="Valid Until">
                                                        <span class="text-danger">
                                                            <?php echo isset($_SESSION['visa_card_valid_error']) ? $_SESSION['visa_card_valid_error'] : ''; ?></span>

                                                    </div>
                                                    <div class="payment-fields" id="bankAccountFields"
                                                        style="display: none;">
                                                        <p>
                                                        <ul>
                                                            <li><strong>Account No : </strong>1498 9990 1500 6756</li>
                                                            <li><strong>Bank :</strong> Standard Chartered Bank
                                                                <i><small>(Any Branch countrywide)</small></i>
                                                            </li>
                                                            <li><strong>Account Name : </strong>Menany Buses Sacco</li>
                                                        </ul>
                                                        </p>
                                                        <input id="brach_name" class="form-control" name="branch_name"
                                                            type="text" placeholder="Branch Name">
                                                        <span class="text-danger">
                                                            <?php echo isset($_SESSION['bank_name_error']) ? $_SESSION['bank_name_error'] : ''; ?></span>

                                                        <br>
                                                        <input id="payment_date" class="form-control"
                                                            name="bankpayment_date" type="date"
                                                            placeholder="Payment Date">
                                                        <span class="text-danger">
                                                            <?php echo isset($_SESSION['bank_payment_date_error']) ? $_SESSION['bank_payment_date_error'] : ''; ?></span>

                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="ticket_payment" id="checkoutBtn"
                                                class="btn btn-primary">
                                                Proceed to Checkout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Footer -->

        <footer class="footer">
            <div class="container">
                <div class="row">

                    <!-- Footer Column -->
                    <div class="col-lg-3 footer_column">
                        <div class="footer_col">
                            <div class="footer_content footer_about">
                                <div class="logo_container footer_logo">
                                    <div class="logo"><a href="#"><img src="images/logo.png" alt="">Menany Buses
                                            Inc</a>
                                    </div>
                                </div>
                                <p class="footer_about_text">Experience reliable and convenient bus services for
                                    your
                                    travel
                                    needs. Our professional team provides
                                    efficient transportation solutions, ensuring a comfortable and safe journey.
                                    Discover
                                    affordable fares,
                                    flexible schedules, and a wide network of destinations.</p>
                                <ul class="footer_social_list">
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-pinterest"></i></a>
                                    </li>
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-facebook-f"></i></a>
                                    </li>
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-dribbble"></i></a>
                                    </li>
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-behance"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Column -->
                    <div class="col-lg-3 footer_column">
                        <div class="footer_col">
                            <div class="footer_title">The near future</div>
                            <div class="footer_content footer_blog">

                                <!-- Footer blog item -->
                                <div class="footer_blog_item clearfix">
                                    <div class="footer_blog_image"><img src="images/Nanyuki-Town.jpeg"
                                            alt="https://unsplash.com/@avidenov"></div>
                                    <div class="footer_blog_content">
                                        <div class="footer_blog_title"><a href="blog.php">Isiolo Route</a>
                                        </div>
                                        <div class="footer_blog_date">Date reveal soon </div>
                                    </div>
                                </div>

                                <!-- Footer blog item -->
                                <div class="footer_blog_item clearfix">
                                    <div class="footer_blog_image"><img src="images/Meru-town.jpeg"
                                            alt="https://unsplash.com/@deannaritchie"></div>
                                    <div class="footer_blog_content">
                                        <div class="footer_blog_title"><a href="blog.php">New destinations for
                                                you</a>
                                        </div>
                                        <div class="footer_blog_date">Date reveal soon</div>
                                    </div>
                                </div>

                                <!-- Footer blog item -->
                                <div class="footer_blog_item clearfix">
                                    <div class="footer_blog_image"><img src="images/Meru-town.jpeg"
                                            alt="https://unsplash.com/@bergeryap87"></div>
                                    <div class="footer_blog_content">
                                        <div class="footer_blog_title"><a href="blog.php">Marsabit Route</a>
                                        </div>
                                        <div class="footer_blog_date">Date reveal soon</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Footer Column -->
                    <div class="col-lg-3 footer_column">
                        <div class="footer_col">
                            <div class="footer_title">tags</div>
                            <div class="footer_content footer_tags">
                                <ul class="tags_list clearfix">
                                    <li class="tag_item"><a href="#">adventure tours</a></li>
                                    <li class="tag_item"><a href="#">travel tours</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Column -->
                    <div class="col-lg-3 footer_column">
                        <div class="footer_col">
                            <div class="footer_title">contact info</div>
                            <div class="footer_content footer_contact">
                                <ul class="contact_info_list">
                                    <li class="contact_info_item d-flex flex-row">
                                        <div>
                                            <div class="contact_info_icon"><img src="images/placeholder.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="contact_info_text">Meru Town Menany Buses Inc 1203V Njuri Ncheke
                                            Street</div>
                                    </li>
                                    <li class="contact_info_item d-flex flex-row">
                                        <div>
                                            <div class="contact_info_icon"><img src="images/phone-call.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="contact_info_text">0020-808-8000</div>
                                    </li>
                                    <li class="contact_info_item d-flex flex-row">
                                        <div>
                                            <div class="contact_info_icon"><img src="images/message.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="contact_info_text"><a
                                                href="mailto:contactme@gmail.com?Subject=Hello"
                                                target="_top">info@menanybusesinc.com</a></div>
                                    </li>
                                    <li class="contact_info_item d-flex flex-row">
                                        <div>
                                            <div class="contact_info_icon"><img src="images/planet-earth.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="contact_info_text"><a href="#">menany.com</a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

        <!-- Copyright -->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-lg-1 order-2  ">
                        <div class="copyright_content d-flex flex-row align-items-center">
                            <div>
                                Copyright &copy;
                                <script>
                                document.write(new Date().getFullYear());
                                </script> All rights reserved
                                Menany Buses
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 order-lg-2 order-1">
                        <div class="footer_nav_container d-flex flex-row align-items-center justify-content-lg-end">
                            <div class="footer_nav">
                                <ul class="footer_nav_list">
                                    <li class="footer_nav_item"><a href="#">home</a></li>
                                    <li class="footer_nav_item"><a href="about.php">about us</a></li>
                                    <li class="footer_nav_item"><a href="offers.php">offers</a></li>
                                    <li class="footer_nav_item"><a href="blog.php">news</a></li>
                                    <li class="footer_nav_item"><a href="contact.php">contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        // Event handler for the payment method select
        $("#paymentMethodSelect").change(function() {
            // Get the selected payment method
            var selectedPaymentMethod = $(this).val();
            // Hide all payment fields
            $(".payment-fields").hide();
            // Show the payment fields for the selected payment method
            $("#" + selectedPaymentMethod + "Fields").show();
        });
    });



    $(document).ready(function() {
        // Event handler for the payment method select
        $("#paymentMethodSelect").change(function() {
            // Get the selected payment method
            var selectedPaymentMethod = $(this).val();
            // Hide all payment fields
            $(".payment-fields").hide();
            // Show the payment fields for the selected payment method
            $("#" + selectedPaymentMethod + "Fields").show();
        });

        // Event handler for "Proceed to Checkout" button
        $("#checkoutBtn").click(function() {
            // Clear previous errors
            $("#formErrors").empty();

            // Get the selected payment method
            var selectedPaymentMethod = $("#paymentMethodSelect").val();

            // Validate form fields based on the selected payment method
            var isValid = true;
            switch (selectedPaymentMethod) {
                case "mpesa":
                    // Validate Mpesa-specific fields
                    if ($("#mpesa_ref_no").val() === "") {
                        isValid = false;
                        $("#formErrors").append("<p>Please enter Mpesa code.</p>");
                    }
                    break;
                case "masterCard":
                    // Validate Master Card-specific fields
                    // Add more validation here if needed
                    break;
                case "visaCard":
                    // Validate Visa Card-specific fields
                    // Add more validation here if needed
                    break;
                case "bankAccount":
                    // Validate Bank Account-specific fields
                    // Add more validation here if needed
                    break;
                default:
                    isValid = false;
                    $("#formErrors").append("<p>Please select a valid payment method.</p>");
                    break;
            }

            // If the form is valid, submit it
            if (isValid) {
                $("#paymentForm").submit();
            }
        });
    });
    </script>

    <script>
    function confirmDelete(ticketId) {
        if (confirm("Are you sure you want to delete this ticket?")) {
            // If the user clicks "OK", proceed with the deletion
            deleteTicket(ticketId);
        }
    }

    function deleteTicket(ticketId) {
        // Use AJAX to call the PHP script to delete the ticket
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Display an alert message after the ticket is deleted
                alert("Ticket deleted successfully!");
                // Reload the page after deletion or you can remove the ticket element from the DOM
                location.reload();
            }
        };
        xhttp.open("GET", "delete_ticket.php?ticketId=" + ticketId, true);
        xhttp.send();
    }
    </script>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="js/contact_custom.js"></script>

</body>

</html>
<?php

}