<?php
include "templates/inc/header.php";
?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/contact_background.jpg">
    </div>
    <div class="home_content">
        <div class="home_title">Sign In</div>
    </div>
</div>

<!-- Contact -->

<div class="contact_form_section">
    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Contact Form -->
                <div class="contact_form_container">
                    <div class="contact_title text-center">Sign In</div>

                    <div id="error-msg" class="alert alert-danger" role="alert"></div>

                    <form id="login-form" action="login.php" method="post" name="login-form">
                        <div class="row">
                            <div class="col-md-6 mb-4">

                                <div class="form-outline">
                                    <label for="email" class="text-light">Email address</label>
                                    <input id="email" class="form-control" name="email" type="email"
                                        placeholder="Enter email">
                                </div>

                            </div>
                            <div class="col-md-6 mb-4">

                                <div class="form-outline">
                                    <label for="password" class="text-light">Password</label>
                                    <input id="password" class="form-control" name="password" type="password"
                                        placeholder="Password">
                                </div>

                            </div>
                        </div>



                        <div class="mt-4 pt-2">
                            <button id="login" class="btn btn-primary" type="submit">Sign In</button>
                        </div>
                        <div class="text-light  mt-3 pt-2">
                            Don't have an account ? <a href="sign-up.php">Sign Up</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
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
            url: 'login.php',
            type: "POST",
            data: data,
        }).done(function(res) {
            res = JSON.parse(res);
            if (res['status']) // if login successful redirect user to booking.php page.
            {
                location.href =
                    "offers.php"; // redirect user to sbooking.php location/page.
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
<br><br>

<!-- Footer -->
<?php 

include "templates/inc/footer.php";