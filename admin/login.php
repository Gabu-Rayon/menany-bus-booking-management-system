<?php
include("inc/header.php");

?>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img
                                class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-5">Log in to Manage Menany Buses</h2>
                    <div class="auth-form-container text-start">


                        <div id="error-msg" class="alert alert-danger" role="alert"></div>
                        <form class="auth-form login-form" id="login-form" action="admin-login.php" method="post"
                            name="login-form">
                            <div class="email mb-3">
                                <label for="signin-email">Email</label>
                                <input id="signin-email" name="email" type="email" class="form-control signin-email"
                                    placeholder="Email address" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="password mb-3">
                                <label for="signin-password">Password</label>
                                <input id="signin-password" name="password" type="password"
                                    class="form-control signin-password" placeholder="Password" required="required">
                                <div class="extra mt-3 row justify-content-between">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="RememberPassword">
                                            <label class="form-check-label" for="RememberPassword">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <!--//col-6-->
                                </div>
                                <!--//extra-->
                            </div>
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" id="login" class="btn app-btn-primary w-100 theme-btn mx-auto">
                                    Log In</button>
                            </div>
                        </form>
                    </div>
                    <!--//auth-form-container-->

                </div>
                <!--//auth-body-->
            </div>
            <!--//flex-column-->
        </div>
        <!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">
            </div>
            <div class="auth-background-mask"></div>
            <div class="auth-background-overlay p-3 p-lg-5">
                <div class="d-flex flex-column align-content-end h-100">
                    <div class="h-100"></div>
                    <div class="overlay-content p-3 p-lg-4 rounded">
                        <h5 class="mb-3 overlay-title"> Admin | Staff </h5>
                        <div>Menany Admin | Staff Login to Manage System <a href="login.php"> here</a>.
                        </div>
                    </div>
                </div>
            </div>
            <!--//auth-background-overlay-->
        </div>
        <!--//auth-background-col-->

    </div>
    <!--//row-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
    $(function() {
        $("#error-msg").hide();
        $('#login').click(function(e) {

            let self = $(this);

            e.preventDefault(); // prevent default submit behavior

            self.prop('disabled', true);

            var data = $('#login-form').serialize(); // get form data

            // sending ajax request to login.php file, it will process login request and give response.
            $.ajax({
                url: 'admin-login.php',
                type: "POST",
                data: data,
            }).done(function(res) {
                res = JSON.parse(res);
                if (res['status']) // if login successful redirect user to booking.php page.
                {
                    location.href =
                        "index.php"; // redirect user to sbooking.php location/page.
                } else {

                    var errorMessage = '';
                    // if there is any errors convert array of errors into html string, 
                    //here we are wrapping errors into a paragraph tag.
                    console.log(res.msg);
                    $.each(res['msg'], function(index, message) {
                        errorMessage += '<div>' + message + '</div>';
                    });
                    // place the errors inside the div#error-msg.
                    $("#error-msg").html(errorMessage);
                    $("#error-msg").show(); // show it on the browser, default state, hide
                    // remove disable attribute to the login button, 
                    //to prevent multiple form submissions 
                    //we have added this attribution on login from submit
                    self.prop('disabled', false);
                }
            }).fail(function() {
                alert("error");
            }).always(function() {
                self.prop('disabled', false);
            });
        });
    });
    </script>

</body>

</html>