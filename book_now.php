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
    
// Fetch all data from the unpaid_tickets table
$selectQuery = "SELECT * FROM unpaid_tickets";
$stmt = $conn->query($selectQuery);
$unpaidTicketsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Schedule</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
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
            <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/09.jpg"></div>
            <div class="home_content">
                <div class="home_title">Book Schedule</div>
            </div>
        </div>

        <!-- Book Now -->
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
                                <input class="form-input" type="hidden" id="customer_name" name="firstname" value="">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="name">Bus:</label>
                                <input class="form-input" type="text" id="bus_name" name="bus_name" value="">
                            </div>


                            <div class="form-group">
                                <label class="form-label" for="email">From:</label>
                                <input class="form-input" type="text" id="from_destination" name="from_location"
                                    value="">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="password">To:</label>
                                <input class="form-input" type="text" id="to_location" name="to_destination" value=" ">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="departure">Departure:</label>
                                <input class="form-input" type="text" id="departure" name="departure" value="">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="eta">Eta:</label>
                                <input class="form-input" type="text" id="eta" name="eta" value="">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="fare">Fare:</label>
                                <input class="form-input" type="text" id="price" name="price" value="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="how_many>coming along with
                                         someone:</label><br>
                                     <i class=" fs-6">number of seats</i>
                                    <input class=" form-input" type="number" id="how_many" name="how_many"
                                        placeholder="optional">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="confirm_password">Luggage Quantity</label>
                                <input class=" form-input" type="number" id="luggage_count" name="luggage_count"
                                    placeholder="optional">
                            </div>
                            <!-- Payment method switcher -->
                            <div class="form-group">
                                <label for="payment_method" class="form-label">Payment Method:</label>
                                <select name="payment_method" class="form-select" id="payment_method">
                                    <option value="mpesa">M-Pesa</option>
                                    <option value="bank">Bank Payment</option>
                                    <option value="mastercard">Online Mastercard</option>
                                </select>
                            </div>

                            <!-- Additional fields based on the selected payment method -->
                            <div id="mpesa_fields" class="form-group" style="display: none;">
                                <!-- M-Pesa fields go here -->
                                <input type="text" class=" form-input" name="" placeholder="">
                            </div>

                            <div id=" bank_fields" class="form-group" style="display: none;">
                                <!-- Bank payment fields go here -->
                            </div>

                            <div id="mastercard_fields" class="form-group" style="display: none;">
                                <!-- Online Mastercard fields go here -->
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


                        <script src="https://code.jquery.com/jquery-3.7.0.js"
                            integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous">
                        </script>
                        <!-- Script to show/hide payment fields based on the selected payment method -->
                        <script>
                        $(document).ready(function() {
                            $('#payment_method').change(function() {
                                var selectedMethod = $(this).val();

                                // Hide all payment fields
                                $('#mpesa_fields, #bank_fields, #mastercard_fields').hide();

                                // Show the selected payment field
                                $('#' + selectedMethod + '_fields').show();
                            });
                        });
                        </script>
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
                                    <div class="logo"><a href="#"><img src="images/logo.png" alt="">Menany Buses Inc</a>
                                    </div>
                                </div>
                                <p class="footer_about_text">Experience reliable and convenient bus services for your
                                    travel
                                    needs. Our professional team provides
                                    efficient transportation solutions, ensuring a comfortable and safe journey.
                                    Discover
                                    affordable fares,
                                    flexible schedules, and a wide network of destinations.</p>
                                <ul class="footer_social_list">
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li class="footer_social_item"><a href="#"><i class="fa fa-behance"></i></a></li>
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
                                        <div class="footer_blog_title"><a href="blog.php">New destinations for you</a>
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
                                            <div class="contact_info_icon"><img src="images/message.svg" alt=""></div>
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

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="js/contact_custom.js"></script>

</body>

</html>
<?php
}