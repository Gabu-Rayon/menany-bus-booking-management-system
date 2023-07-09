<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
</head>

<?php
include "templates/inc/header.php";

?>
<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/07.jpg"></div>
    <div class="home_content">
        <div class="home_title">Sign Up</div>
    </div>
</div>

<!-- Contact -->

<div class="contact_form_section">
    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Contact Form -->
                <div class="contact_form_container">
                    <div class="contact_title text-center">Sign Up</div>
                    <span id="message"></span>
                    <form id="signup_form" action="register.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-4">

                                <div class="form-outline">
                                    <label class="text-light">First name <span class="text-danger">*</span></label>
                                    <input type="text" name="firstname" id="firstname" class="form-control form_data" />
                                    <div id="first_error" class="text-danger"></div>
                                </div>

                            </div>
                            <div class="col-md-6 mb-4">

                                <div class="form-outline">
                                    <label class="text-light">Last name <span class="text-danger">*</span></label>
                                    <input type="text" name="lastname" id="lastname" class="form-control form_data" />
                                    <div id="last_error" class="text-danger"></div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">

                                <div class="form-outline">
                                    <label class="text-light">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control form_data" />
                                    <div id="email_error" class="text-danger"></div>
                                </div>

                            </div>
                            <div class="col-md-6 mb-4">

                                <div class="form-outline">
                                    <label class="text-light">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password"
                                        class="form-control form_data" />
                                    <div id="password_error" class="text-danger"></div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">

                                <div class="form-outline">
                                    <label class="text-light">Contact <span class="text-danger">*</span></label>
                                    <input type="number" name="contact" id="contact" class="form-control form_data" />
                                    <div id="contact_error" class="text-danger"></div>
                                </div>

                            </div>
                            <div class="col-md-6 mb-4">

                                <div class="form-outline">
                                    <label class="text-light">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control form_data" />
                                    <div id="confirm_password_error" class="text-danger"></div>

                                </div>

                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Sign
                                Up</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<br><br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Clear error messages
    function clearErrors() {
        $('.text-danger').text('');
    }

    // Submit form data via AJAX
    $('#signup_form').submit(function(event) {
        event.preventDefault();
        clearErrors();

        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();

        // Check if passwords match
        if (password !== confirm_password) {
            $('#confirm_password_error').text('Passwords do not match');
            return;
        }

        // Send AJAX request to register.php
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Registration successful, redirect to sign-in.php
                    window.location.href = 'sign-in.php';
                } else {
                    // Display errors under each form input field
                    if (response.first_error) {
                        $('#first_error').text(response.first_error);
                    }
                    if (response.last_error) {
                        $('#last_error').text(response.last_error);
                    }
                    if (response.email_error) {
                        $('#email_error').text(response.email_error);
                    }
                    if (response.password_error) {
                        $('#password_error').text(response.password_error);
                    }
                    if (response.confirm_password_error) {
                        $('#confirm_password_error').text(response
                            .confirm_password_error);
                    }
                    if (response.contact_error) {
                        $('#contact_error').text(response.contact_error);
                    }
                }
            },
            error: function() {
                // Display error message if the AJAX request fails
                $('#message').text('Error occurred while processing the form.');
            }
        });
    });

    // Clear error messages on input change
    $('.form_data').on('input', function() {
        clearErrors();
    });
});
</script>

<!-- Footer -->
<?php 

include "templates/inc/footer.php";