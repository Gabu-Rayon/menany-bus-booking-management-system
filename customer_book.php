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

    // Check if the schedule ID is provided in the URL
    if (!isset($_GET['id'])) {
        // Handle the case when the schedule ID is missing
        die('Schedule ID is missing.');
    }

    $scheduleId = $_GET['id'];

    // Prepare and execute the query to fetch the schedule details
    $query = "SELECT  schedule_list.id, bus.name AS bus_name, bus.bus_number, location_from.terminal_name AS from_terminal,
    location_from.city AS from_city, location_from.state AS from_state, location_to.terminal_name AS to_terminal,
    location_to.city AS to_city, location_to.state AS to_state, schedule_list.departure_time,
    schedule_list.eta, schedule_list.price FROM schedule_list 
    INNER JOIN bus ON schedule_list.bus_id = bus.id 
    INNER JOIN location AS location_from ON schedule_list.from_location = location_from.id 
    INNER JOIN location AS location_to ON schedule_list.to_location = location_to.id WHERE schedule_list.id = :scheduleId";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':scheduleId', $scheduleId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the schedule details as an associative array
    $schedule = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the schedule exists
    if (!$schedule) {
        // Handle the case when the schedule doesn't exist
        die('Schedule not found.');
    }

    if (isset($_POST['book_now'])) {
        $customerId = $id;
        $busName = $_POST['bus_name'];
        $busPlate = $_POST['bus_number'];
        $fromTerminal = $_POST['from_location'];
        $toDestination = $_POST['to_destination'];
        $departure = $_POST['departure'];
        $eta = $_POST['eta'];
        $fare = $_POST['price'];
        $howMany = $_POST['how_many'];
        $luggageCount = $_POST['luggage_count'];

        // Insert data into unpaid_tickets table
        $insertQuery = "INSERT INTO unpaid_tickets (customer_id, bus, bus_plate, from_terminal, to_destination, departure, eta, fare_amount, how_many, luggage_count) 
        VALUES (:customerId, :busName, :busPlate, :fromTerminal, :toDestination, :departure, :eta, :fare, :howMany, :luggageCount)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
        $stmt->bindParam(':busName', $busName, PDO::PARAM_STR);
        $stmt->bindParam(':busPlate', $busPlate, PDO::PARAM_STR);
        $stmt->bindParam(':fromTerminal', $fromTerminal, PDO::PARAM_STR);
        $stmt->bindParam(':toDestination', $toDestination, PDO::PARAM_STR);
        $stmt->bindParam(':departure', $departure, PDO::PARAM_STR);
        $stmt->bindParam(':eta', $eta, PDO::PARAM_STR);
        $stmt->bindParam(':fare', $fare, PDO::PARAM_STR);
        $stmt->bindParam(':howMany', $howMany, PDO::PARAM_INT);
        $stmt->bindParam(':luggageCount', $luggageCount, PDO::PARAM_INT);

        if ($stmt->execute()) {
             header('location: book_now.php');
        } else {
            echo "Failed to book ticket.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer Book</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
    <style>
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-input {
        display: block;
        width: 100%;
        padding: 5px;
        border: none;
        background-color: #f5f5f5;
        font-size: 16px;
    }

    .form-input:focus {
        outline: none;
        background-color: #e0e0e0;
    }

    .form-button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .form-button:hover {
        background-color: #555;
    }

    .img-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .inline-form .form-group {
        display: inline-block;
        margin-right: 10px;
    }

    .inline-form .form-label {
        display: inline-block;
        margin-right: 5px;
        vertical-align: middle;
    }

    .inline-form .form-input {
        display: inline-block;
        width: auto;
        vertical-align: middle;
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
                                <div class="user_box_login user_box_link"><a href="sign-in.php">sign in</a></div>
                                <div class="user_box_register user_box_link"><a href="sign-up.php.">sign up</a>
                                </div>
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
                                <div class="logo"><a href="index.php"><img src="images/logo.png" alt="">Menany Buses
                                        Inc</a>
                                </div>
                            </div>
                            <div class="main_nav_container ml-auto">
                                <ul class="main_nav_list">
                                    <li class="main_nav_item"><a href="index.php">home</a></li>
                                    <li class="main_nav_item"><a href="about.php">about us</a></li>
                                    <li class="main_nav_item"><a href="offers.php">offers</a></li>
                                    <li class="main_nav_item"><a href="blog.php">news</a></li>
                                    <li class="main_nav_item"><a href="logout.php">logout</a></li>

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
                <div class="logo menu_logo"><a href="#"><img src="images/logo.png" alt=""></a></div>
                <ul>
                    <li class="menu_item"><a href="index.php">home</a></li>
                    <li class="menu_item"><a href="about.php">about us</a></li>
                    <li class="menu_item"><a href="offers.php">offers</a></li>
                    <li class="menu_item"><a href="blog.php">news</a></li>
                    <li class="menu_item"><a href="contact.php">contact</a></li>
                    <li class="menu_item"><a href="logout.php">logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Home -->

        <div class="home">
            <div class="home_background parallax-window" data-parallax="scroll"
                data-image-src="images/contact_background.jpg"></div>
            <div class="home_content">
                <div class="home_title">Book Schedule</div>
            </div>
        </div>

        <!-- Contact -->

        <div class="contact_form_section">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <!-- Image column -->
                        <img src="images/07.jpg" alt="Image" class="img-fluid img-cover">
                    </div>
                    <div class="col-6">
                        <!-- Contact Form -->
                        <form action="#" method="POST" class="inline-form">
                            <div class="form-group">
                                <input class="form-input" type="hidden" id="customer_name" name="firstname"
                                    value="<?php echo $fetch['firstname']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="name">Bus:</label>
                                <input class="form-input" type="text" id="bus_name" name="bus_name"
                                    value="<?php echo $schedule['bus_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="name">Bus Plate:</label>
                                <input class="form-input" type="text" id="bus_number" name="bus_number"
                                    value="<?php echo $schedule['bus_number']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">From:</label>
                                <input class="form-input" type="text" id="from_destination" name="from_location"
                                    value="<?php echo $schedule['from_terminal'] . ', ' . $schedule['from_city'] . ', ' . $schedule['from_state']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="password">To:</label>
                                <input class="form-input" type="text" id="to_location" name="to_destination"
                                    value="<?php echo $schedule['to_terminal'] . ', ' . $schedule['to_city'] . ', ' . $schedule['to_state']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="departure">Departure:</label>
                                <input class="form-input" type="text" id="departure" name="departure"
                                    value="<?php echo $schedule['departure_time']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="eta">Eta:</label>
                                <input class="form-input" type="text" id="eta" name="eta"
                                    value="<?php echo $schedule['eta']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="fare">Fare:</label>
                                <input class="form-input" type="text" id="price" name="price"
                                    value="<?php echo $schedule['price']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="how_many>coming along with
                                         someone:</label><br>
                                     <i class=" fs-6">how many are you ?</i>
                                    <input class=" form-input" type="number" id="how_many" name="how_many"
                                        placeholder="optional">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="confirm_password">Luggage Quantity:</label>
                                <input class=" form-input" type="number" id="luggage_count" name="luggage_count"
                                    placeholder="optional">
                            </div>
                            <div class="form-group">
                                <button type=" submit" name="book_now" id="form_submit_button"
                                    class="form_submit_button button trans_200">book
                                    now<span></span><span></span><span></span></button>

                                <button type="button" id="form_cancel_button"
                                    class="form_submit_button button trans_200 m-3">
                                    <a href="offers.php">Cancel<span></span><span></span><span></span></a>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <!-- Footer -->
        <?php
      include "templates/inc/footer.php";
}