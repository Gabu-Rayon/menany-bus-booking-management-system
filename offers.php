<?php
session_start();
require_once 'config/connect.php';
if(empty($_SESSION['id'])){
   header('location: sign-in.php');    
} else {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Offers</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/offers_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/offers_responsive.css">
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
                <div class="home_title">our offers</div>
            </div>
        </div>

        <!-- Offers -->

        <div class="offers">

            <!-- Search -->

            <div class="search">
                <div class="search_inner">

                    <!-- Search Contents -->

                    <div class="container fill_height no-padding">
                        <div class="row fill_height no-margin">
                            <div class="col fill_height no-padding">

                                <!-- Search Tabs -->



                                <div class="search_tabs_container">
                                    <div
                                        class="search_tabs d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                                        <div
                                            class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start">
                                            <img src="images/bus.png" alt="">Bus rentals
                                        </div>
                                        <div
                                            class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start">
                                            <img src="images/bus.png" alt="">Bus for Hire
                                        </div>
                                        <div
                                            class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start">
                                            <img src="images/bus.png" alt="">Bus for tours
                                        </div>
                                        <div
                                            class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start">
                                            <img src="images/bus.png" alt="">Luxury travel
                                        </div>
                                        <div
                                            class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start">
                                            <img src="images/bus.png" alt="">Cargo trans
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Panel -->


                                <?php
                            // Variables to store the user's search criteria
                            $destination = $_POST['destination'] ?? '';
                            $date = $_POST['date'] ?? '';
                            $terminal = $_POST['terminal'] ?? '';
                           $query = "SELECT schedule_list.id,bus.name AS bus_name,bus.bus_number,location_from.terminal_name AS from_terminal,
                              location_from.city AS from_city,location_from.state AS from_state,location_to.terminal_name AS to_terminal,
                              location_to.city AS to_city,location_to.state AS to_state,schedule_list.departure_time,schedule_list.eta,
                              schedule_list.availability,schedule_list.price FROM schedule_list INNER JOIN bus ON schedule_list.bus_id = bus.id
                              INNER JOIN  location AS location_from ON schedule_list.from_location = location_from.id
                              INNER JOIN location AS location_to ON schedule_list.to_location = location_to.id WHERE 1 = 1";

                              // Append search filters to the query if provided by the user
                              $params = [];
                                  if (!empty($destination)) {
                                      $query .= " AND location_to.terminal_name LIKE :destination";
                                      $params['destination'] = '%' . $destination . '%';
                                  }
                                if (!empty($date)) {
                                    $query .= " AND DATE(schedule_list.departure_time) = :date";
                                    $params['date'] = $date;
                                }
                                if (!empty($terminal)) {
                                    $query .= " AND location_from.terminal_name LIKE :terminal";
                                    $params['terminal'] = '%' . $terminal . '%';
                                }
                                // Prepare and execute the query with search filters
                                $stmt = $conn->prepare($query);
                                $stmt->execute($params);
                                // Fetch all the rows as an associative array
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          ?>
                                <div class="search_panel active">
                                    <form action="#" id="search_form_1"
                                        class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start"
                                        method="POST">
                                        <div class="search_item">
                                            <div>Destination</div>
                                            <input type="text" name="destination" class="destination search_input"
                                                required="required" placeholder="Destination"
                                                value="<?php echo $destination; ?>">
                                        </div>
                                        <div class="search_item">
                                            <div>Date</div>
                                            <input type="date" name="date" class="check_in search_input"
                                                placeholder="Date to be picked" value="<?php echo $date; ?>">
                                        </div>
                                        <div class="search_item">
                                            <div>Terminal</div>
                                            <input type="text" name="terminal" class="check_out search_input"
                                                placeholder="Terminal to pick you" value="<?php echo $terminal; ?>">
                                        </div>
                                        <button type="submit" name="search"
                                            class="button search_button">Search<span></span><span></span><span></span></button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offers -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-1 temp_col"></div>
                    <div class="col-lg-11">

                        <!-- Offers Sorting -->
                        <div class="offers_sorting_container">
                            <ul class="offers_sorting">
                                <li>
                                    <span class="sorting_text">price</span>
                                    <i class="fa fa-chevron-down"></i>
                                    <ul>
                                        <li class="sort_btn" data-isotope-option='{ "sortBy": "original-order" }'
                                            data-parent=".price_sorting"><span>show all</span></li>
                                        <li class="sort_btn" data-isotope-option='{ "sortBy": "price" }'
                                            data-parent=".price_sorting"><span>ascending</span></li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="sorting_text">location</span>
                                    <i class="fa fa-chevron-down"></i>
                                    <ul>
                                        <li class="sort_btn" data-isotope-option='{ "sortBy": "original-order" }'>
                                            <span>default</span>
                                        </li>
                                        <li class="sort_btn" data-isotope-option='{ "sortBy": "name" }'>
                                            <span>alphabetical</span>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="sorting_text">stars</span>
                                    <i class="fa fa-chevron-down"></i>
                                    <ul>
                                        <li class="filter_btn" data-filter="*"><span>show all</span></li>
                                        <li class="sort_btn" data-isotope-option='{ "sortBy": "stars" }'>
                                            <span>ascending</span>
                                        </li>
                                        <li class="filter_btn" data-filter=".rating_3"><span>3</span></li>
                                        <li class="filter_btn" data-filter=".rating_4"><span>4</span></li>
                                        <li class="filter_btn" data-filter=".rating_5"><span>5</span></li>
                                    </ul>
                                </li>
                                <li class="distance_item">
                                    <span class="sorting_text">distance from center</span>
                                    <i class="fa fa-chevron-down"></i>
                                    <ul>
                                        <li class="num_sorting_btn"><span>distance</span></li>
                                        <li class="num_sorting_btn"><span>distance</span></li>
                                        <li class="num_sorting_btn"><span>distance</span></li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="sorting_text">reviews</span>
                                    <i class="fa fa-chevron-down"></i>
                                    <ul>
                                        <li class="num_sorting_btn"><span>review</span></li>
                                        <li class="num_sorting_btn"><span>review</span></li>
                                        <li class="num_sorting_btn"><span>review</span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <!-- Offers Grid -->

                        <div class="offers_grid">

                            <!-- Offers Item -->

                            <?php foreach ($rows as $row): ?>
                            <div class="offers_item rating_4">
                                <div class="row">
                                    <div class="col-lg-1 temp_col"></div>
                                    <div class="col-lg-3 col-1680-4">
                                        <div class="offers_image_container">
                                            <!-- Image by https://unsplash.com/@kensuarez -->
                                            <div class="offers_image_background"
                                                style="background-image:url(images/05.jpg)"></div>
                                            <div class="offer_name"><a href="single_listing.php">Nairobi to Meru</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="offers_content">
                                            <div class="offers_price">Ksh<?php echo $row['price']; ?><span>per
                                                    ticket</span></div>
                                            <div class="rating_r rating_r_4 offers_rating" data-rating="4">
                                                <i></i>
                                                <i></i>
                                                <i></i>
                                                <i></i>
                                                <i></i>
                                            </div>
                                            <p class="offers_text">
                                                <span>Bus:<?php echo $row['bus_name']; ?></span>
                                                <br>

                                                Bus Number: <?php echo $row['bus_number']; ?>
                                            <p class="card-text">
                                                <strong>From:</strong>
                                                <?php echo $row['from_terminal'] . ', ' . $row['from_city'] . ', ' . $row['from_state']; ?><br>
                                                <strong>To:</strong>
                                                <?php echo $row['to_terminal'] . ', ' . $row['to_city'] . ', ' . $row['to_state']; ?><br>
                                                <strong>Departure:</strong> <?php echo $row['departure_time']; ?><br>
                                                <strong>ETA:</strong> <?php echo $row['eta']; ?><br>
                                                <strong>Availability:</strong> <?php echo $row['availability']; ?>
                                                seats<br>
                                            </p>
                                            </p>

                                            <div class="button book_button">
                                                <a
                                                    href="customer_book.php?id=<?php echo $row['id']; ?>">book<span></span><span></span><span></span></a>
                                            </div>

                                            <div class="offer_reviews">
                                                <div class="offer_reviews_content">
                                                    <div class="offer_reviews_title">very good</div>
                                                    <div class="offer_reviews_subtitle">100 reviews</div>
                                                </div>
                                                <div class="offer_reviews_rating text-center">8.1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- Offers Item -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
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
    <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="js/offers_custom.js"></script>

</body>

</html>
<?php 
}