<?php

session_start();

include 'connection.php';

if (!isset($_SESSION['submittedForm'])) {
    $_SESSION['submittedForm'] = false;
}

if (isset($_SESSION['isLoggedIn']['status']) && $_SESSION['isLoggedIn']['status'] === true) {
    header('Location: home');
    exit;
}

$accesedByReloading = true;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Edumart</title>
    <link rel="stylesheet" href="CSS/signupF2.css">
    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.11.0/dist/css/bootstrap-datepicker.min.css">
        <link rel="icon" href="Images/Icon/E.png" type="image/x-icon">
    <script src="JS/locationsF1.js"></script>

    <script defer src="JS/signupF7.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<body style="font-family: Poppins">
    <header style="background-color: white;">
        <nav class="navbar navbar-expand-lg bg-dark px-lg-5">
            <div class="container-fluid">
                <a class="navbar-brand px-4" href="home">
                    <img src="Images/Logo/Edumart Logo.png" width="160px" alt="">
                </a>
                <div class="row right-panel" style="padding-right: 4%;">
                    <div class="col">
                        <div class="cont px-2 px-lg-3">
                            <div class="nav-item" style="width: 140%; color:white;">
                                <a class="nav-link " style=" font-size: 90%;" aria-current="page" href="home"><span><i
                                            class="fa fa-home px-1" aria-hidden="true"></i> Home</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cont px-2 px-lg-3">
                            <div class="nav-item" style="color:white; width: 140%;">
                                <a class="nav-link" href="products" style="font-size: 90%;"><span><i
                                            class="fa-solid fa-store px-1"></i> Shop</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="text-center" style="background-color: black;">
            <h6 class="poppins text-light small py-1 py-lg-2 px-2" style="font-size: 70%; letter-spacing: 0.3px;">
                Ready to start <span style="color: yellow">shopping</span>? Sign up now and enjoy exclusive access to
                discounts, promotions, and more.
            </h6>
        </div>
    </header>
    <section class="alert-section container-fluid d-flex justify-content-center">
        <div class="col-11 col-lg-10 d-flex justify-content-center">
            <div class="alert container-fluid alert-warning mt-3 px-3 py-2" style="font-size: 85%; padding: 0;"
                role="alert">
                Please be aware that the account section is only for placing and monitoring orders for instruments and
                accessories.
            </div>
        </div>
    </section>
    <section class="content-section container-fluid d-flex justify-content-center">
        <div class="row px-2 px-lg-5 mx-lg-2">
            <div class="col-lg-3 pull-md-left sidebar pl-lg-5">
                <div menuitemname="Already Registered" class="panel panel-sidebar panel-sidebar rounded"
                    style="background-color: black;">
                    <div class="panel-heading py-2 pt-3 px-3" style="padding-left:3%;">
                        <h6 class="panel-title fw-bold text-light">
                            <i class="fa-solid fa-user"></i>&nbsp; Already Registered?
                        </h6>
                    </div>
                    <div class="list-group" style="font-size: 85%;">
                        <div menuitemname="Already Registered Heading" class="list-group-item "
                            id="Primary_Sidebar-Already_Registered-Already_Registered_Heading"
                            style="font-size: 84%; letter-spacing: 0.3px;">
                            Already registered with us? If so, click the button below to login your account
                            where you can order and manage your information.
                        </div>
                        <a menuitemname="Login" href="login" class="list-group-item"
                            id="Primary_Sidebar-Already_Registered-Login">
                            <i class="fas fa-user"></i>&nbsp; Login
                        </a>
                        <a menuitemname="Lost Password Reset" href="forgotpassword" class="list-group-item "
                            id="Primary_Sidebar-Already_Registered-Lost_Password_Reset">
                            <i class="fas fa-asterisk"></i>&nbsp; Lost Password Reset
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 text-start mt-3">
                <div class="header-lined">
                    <h1 class="fw-bold">Register <small style="font-size: 40%; opacity: 0.7;">Create an account with us
                            . . .</small></h1>
                    <hr>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-size: 80%;">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sign up</li>
                        </ol>
                    </nav>
                </div>

                <form action="register.php" method="POST">
                    <div class="form-group">
                        <div class="required text-end pt-4">
                            <h6 style="font-size: 11px;">Please note that fields marked with an asterisk (<span
                                    style="color: red; font-size: 16px;">*</span>) are required.</h6>
                        </div>
                        <div class="personal-info-heading row">
                            <div class="col fw-bold" style="display: flex; align-items: center; max-width: 190px;">
                                <span style="font-size: 90%; letter-spacing: 0.6px; opacity: 0.9;">Personal
                                    Information</span>
                            </div>
                            <div class="col text-start" style="display: flex; align-items: center;">
                                <div class="rounded"
                                    style="flex-grow: 1; height: 1.8px; background-color: black; opacity: 0.3;"></div>
                            </div>
                        </div>
                        <div class="full-name row poppins py-1">
                            <div class="col-12 col-lg-6 py-2">
                                <label>First name <span style="color: red">*</span></label>
                                <input type="name" class="form-control" id="firstname" name="firstname"
                                    aria-describedby="firstName" placeholder="First name" style="font-size: 13px;">
                                <label class="error-selector" id="error-firstname"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                            <div class="col-12 col-lg-6 py-2">
                                <div class="row">
                                    <div class="col">
                                        <label>Middle name <span style="color: red">*</span></label>
                                        <input type="name" class="form-control" id="middlename" name="middlename"
                                            aria-describedby="middleName" placeholder="Middle name"
                                            style="font-size: 13px;">
                                        <label class="error-selector" id="error-middlename"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                    <div class="col">
                                        <label>Last name <span style="color: red">*</span></label>
                                        <input type="name" class="form-control" id="lastname" name="lastname"
                                            aria-describedby="lastName" placeholder="Last name"
                                            style="font-size: 13px;">
                                        <label class="error-selector" id="error-lastname"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="username-contact row poppins">
                            <div class="col-12 col-lg-6 py-2">
                                <div class="row ">
                                    <div class="col col-lg-6">
                                        <label>Username <span style="color: red">*</span></label>
                                        <input type="username" class="form-control" id="username" name="username"
                                            aria-describedby="userName" placeholder="Username"
                                            style="font-size: 13px; ">
                                        <label class="error-selector" id="error-username"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                    <div class="col col-lg-6 align-items-center justify-content-center pt-3"
                                        style="margin-top: 2px;">
                                        <button type="button"
                                            class="check-username btn btn-outline-dark py-1 my-1 fw-bold"
                                            style="font-size: 78%; width: 100%; flex-grow: 1"><span><i
                                                    class="check-indicator fa-regular fa-circle pt-1"></i> </span>&nbsp;
                                            Check&nbsp;Username</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 py-2">
                                <div class="row">
                                    <div class="col">
                                        <label>Password <span style="color: red">*</span></label>
                                        <div class="password d-flex justify-content-center text-center">
                                            <div class="password-div position-relative" style="flex-grow: 1">
                                                <input type="password" class="form-control" id="password"
                                                    name="password" aria-describedby="password" placeholder="Password"
                                                    style="font-size: 13px; padding-right: 2.5rem;">
                                                <span class="toggle-password-icon position-absolute"
                                                    onclick="togglePassword('password', 'eyepassword')"
                                                    style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                                    <i class="fa-solid fa-eye" id="eyepassword"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <label class="error-selector" id="error-password"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                    <div class="col">
                                        <label>Confirm Password <span style="color: red">*</span></label>
                                        <div class="recoverypass d-flex justify-content-center text-center">
                                            <div class="password-div position-relative" style="flex-grow: 1">
                                                <input type="password" class="form-control" id="confirmpassword"
                                                    name="confirmpassword" aria-describedby="confirmpassword"
                                                    placeholder="Confirm Password"
                                                    style="font-size: 13px; padding-right: 2.5rem;">
                                                <span class="toggle-password-icon position-absolute"
                                                    onclick="togglePassword('confirmpassword', 'eyeconfirmpassword')"
                                                    style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                                    <i class="fa-solid fa-eye" id="eyeconfirmpassword"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <label class="error-selector" id="error-confirmpassword"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="email-contact row poppins">
                            <div class="col-12 col-lg-6 py-2">
                                <div class="row">
                                    <div class="col-7">
                                        <label>Email <span style="color: red">*</span></label>
                                        <input type="username" class="form-control" id="email" name="email"
                                            aria-describedby="email" placeholder="Email" style="font-size: 13px;">
                                        <label class="error-selector" id="error-email"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                    <div class="col-5">
                                        <label>Phone number <span style="color: red">*</span></label>
                                        <input type="phoneNumber" class="form-control" id="phonenumber"
                                            name="phonenumber" aria-describedby="phoneNumber" placeholder="Phone number"
                                            style="font-size: 13px;">
                                        <label class="error-selector" id="error-phonenumber"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 py-2">
                                <div class="row">
                                    <div class="col">
                                        <label>Birthday <span style="color: red">*</span></label>
                                        <div class="form-outline datepicker">
                                            <input type="date" class="form-control" id="birthday" name="birthday"
                                                style="font-size: 13px;">
                                        </div>
                                        <label class="error-selector" id="error-birthday"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                    <div class="col">
                                        <label>Gender <span style="color: red">*</span></label>
                                        <select class="form-control" id="genderselect" name="genderselect"
                                            style="font-size: 13px;">
                                            <option>Specify</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                            <option>Prefer not to say</option>
                                        </select>
                                        <label class="error-selector" id="error-gender"
                                            style="color: red; font-size: 10px;"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="location-address-heading row pt-4">
                            <div class="col fw-bold" style="display: flex; align-items: center; max-width: 175px;">
                                <span style="font-size: 90%; letter-spacing: 0.6px; opacity: 0.9;">Location &
                                    Address</span>
                            </div>
                            <div class="col text-start" style="display: flex; align-items: center;">
                                <div class="rounded"
                                    style="flex-grow: 1; height: 1.8px; background-color: black; opacity: 0.3;"></div>
                            </div>
                        </div>
                        <div class="col-12 py-2 poppins">
                            <div class="">
                                <div class="col">
                                    <label>Country <span style="color: red">*</span></label>
                                    <select class="form-control" id="countryselect" name="countryselect"
                                        style="font-size: 13px;">

                                    </select>
                                    <label class="error-selector" id="error-country"
                                        style="color: red; font-size: 10px;"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="email-contact row poppins">
                        <div class="col-12 col-lg-6 py-2">
                            <label>Region / State <span style="color: red">*</span></label>
                            <select class="form-control" id="regionselect" name="regionselect"
                                style="font-size: 13px; ">
                                <option>Your region</option>
                            </select>
                            <label class="error-selector" id="error-regionorstate"
                                style="color: red; font-size: 10px;"></label>
                        </div>
                        <div class="col-12 col-lg-6 py-2">
                            <div class="row">
                                <div class="col">
                                    <label>City <span style="color: red">*</span></label>
                                    <select class="form-control" id="cityselect" name="cityselect"
                                        style="font-size: 13px;">
                                        <option>Your city</option>
                                    </select>
                                    <label class="error-selector" id="error-city"
                                        style="color: red; font-size: 10px;"></label>
                                </div>
                                <div class="col">
                                    <label>Postcode / Zipcode <span style="color: red">*</span></label>
                                    <input type="postcode" class="form-control" id="postcode" name="postcode"
                                        aria-describedby="postcode" placeholder="Postcode / Zipcode"
                                        style="font-size: 13px;">
                                    <label class="error-selector" id="error-postcode"
                                        style="color: red; font-size: 10px;"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="barangay-street row poppins">
                        <div class="col-12 col-lg-6 py-2">
                            <label>Barangay <span style="color: red">*</span></label>
                            <input type="barangay" class="form-control" id="barangay" name="barangay"
                                aria-describedby="barangay" placeholder="Your barangay" style="font-size: 13px;">
                            <label class="error-selector" id="error-barangay"
                                style="color: red; font-size: 10px;"></label>
                        </div>
                        <div class="col-12 col-lg-6 py-2">
                            <label>Street (House #, Street name) <span style="color: red">*</span></label>
                            <input type="postcode" class="form-control" id="street" name="street"
                                aria-describedby="postcode" placeholder="ex. 938 (House #), Aurora Blvd (Street name)"
                                style="font-size: 13px;">
                            <label class="error-selector" id="error-street"
                                style="color: red; font-size: 10px;"></label>
                        </div>
                    </div>
                    <div class="security row pt-4">
                            <div class="col fw-bold" style="display: flex; align-items: center; max-width: 90px;">
                                <span style="font-size: 90%; letter-spacing: 0.6px; opacity: 0.9;">Security</span>
                            </div>
                            <div class="col text-start" style="display: flex; align-items: center;">
                                <div class="rounded"
                                    style="flex-grow: 1; height: 1.8px; background-color: black; opacity: 0.3;"></div>
                            </div>
                        </div>
                    <div class="question-answer row poppins">
                        <div class="col-12 py-2">
                            <label>Recovery Password <span
                                    style="opacity: 0.5; font-size: 12px;">(Optional)</span></label>
                            <div class="recoverypass d-flex justify-content-center text-center">
                                <div class="password-div position-relative" style="flex-grow: 1">
                                    <input type="password" class="form-control" id="recoveryPassword"
                                        name="recoverypassword" aria-describedby="answer"
                                        placeholder="Your recovery password"
                                        style="font-size: 13px; padding-right: 2.5rem;">
                                    <span class="toggle-password-icon position-absolute"
                                        onclick="togglePassword('recoveryPassword', 'eyerecoverypassword')"
                                        style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                        <i class="fa-solid fa-eye" id="eyerecoverypassword"></i>
                                    </span>
                                </div>
                            </div>
                            <label class="error-selector" id="error-recoverypassword"
                                style="color: red; font-size: 10px;"></label>
                        </div>

                    </div>

                    <div class="terms-service poppins pt-5 pb-3">
                        <div class="col-12 py-2 text-light " style="background-color: black;">
                            <div class="px-4 mx-1">
                                <h6 class="pt-2"><span><i class="fa-solid fa-triangle-exclamation"></i> </span>
                                    &nbsp;Terms Of
                                    Service</h6>
                            </div>
                        </div>
                        <div class="col-12 pt-2" style="border: 2px black solid">
                            <div class="form-check px-5 mt-1 mb-2">
                                <input class="form-check-input border-dark" type="checkbox" value="" id="termservice"
                                    name="termservice" style=" margin-top: 5px; cursor: pointer;">
                                <h6 class="pt-1" style="font-size: 13px;">I have read and agree to the <a href="#" id="termsLink" data-bs-toggle="modal" data-bs-target="#termsModal">Terms
                                        of Service</a>.
                                </h6>
                            </div>
                        </div>
                        <label class="error-selector py-2" id="error-termservice"
                            style="color: red; font-size: 10px;"></label>
                    </div>


                    <div class="captcha d-flex justify-content-center py-3">
                        <br />
                        <div class="g-recaptcha" data-sitekey="6Le8qm8pAAAAAHYf64lNRwtKtIH7TG9fZnBQTCX2"></div>
                        <br />
                    </div>
                    <div class="catpcha-error d-flex justify-content-center">
                        <?php if ($_SESSION['submittedForm']): ?>
                            <h6 style="color: red; font-size: 11px;">Please complete the reCAPTCHA first before you submit!
                            </h6>
                            <?php $_SESSION['submittedForm'] = false; endif; ?>
                    </div>

                    <div class="submit-button poppins">
                        <div class="col-12 text-light ">
                            <button onclick="submitRegister(event)" type="submit" name="submit"
                                class="btn btn-dark my-3 mb-4  py-2 fw-bold"
                                style="font-size: 12px; width: 100%; letter-spacing: 0.4px;"><span class="px-1"><i
                                        class="fa-solid fa-right-to-bracket"></i></span> Create Your Account
                            </button>
                        </div>

                    </div>
                </form>
            </div>
    </section>
    <!-- Footer -->
    <footer style="background: #121212">
        <section class="footer_content" style="align-content: center; align-items: center;">
            <div class="container text-left text-md-start mt-5">
                <div class="row mt-3">

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"
                        style="padding-top:40px; font-family:Poppins; font-size:15px; letter-spacing: 0.4px;">
                        <ul class="list-unstyled mb-0 text-center text-lg-start">
                            <h6 class="text-uppercase" style="color: white; font-weight:bold;"> Shop
                            </h6>

                            <li>
                                <a href="#!" class="text" style="color: white;">Acoustic Guitar</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Electric Guitar</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Bass Guitar</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Piano</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Drums</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Accessories</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"
                        style="padding-top:40px; font-family:Poppins; font-size:15px; letter-spacing: 0.4px;">
                        <ul class="list-unstyled mb-0 text-center text-lg-start">
                            <h6 class="text-uppercase" style="color: white; font-weight:bold;">
                                Our Company
                            </h6>

                            <li>
                                <a href="#!" class="text" style="color: white;">About</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Career</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Developers</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Contact Us</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"
                        style="padding-top:40px; font-family:Poppins; font-size:15px; letter-spacing: 0.4px;">
                        <ul class="list-unstyled mb-0 text-center text-lg-start">
                            <h6 class="text-uppercase" style="color: white; font-weight:bold;">Support</h6>

                            <li>
                                <a href="#!" class="text" style="color: white;">Customer Service</a>
                            </li>
                            <li>
                                <a href="#!" class="text" style="color: white;">Virtual Guitar Tech</a>
                            </li>
                        </ul>
                    </div>


                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-center text-lg-start"
                        style="padding-top:40px; font-family:Poppins;">
                        <h6 class="text-uppercase px-lg-4" style="color: white; font-weight: bold;">FOLLOW
                            OUR SOCIALS</h6>
                        <div class="mt-4">
                            <!-- Facebook -->
                            <a href="#!" type="button" class="btn "><i class="social-icon fab fa-facebook-f fa-2x"
                                    style="color: white;"></i> </a>
                            <!-- Twitter -->
                            <a href="#!" type="button" class="btn"><i class="social-icon fab fa-twitter fa-2x"
                                    style="color: white;"></i> </a>
                            <!-- Google -->
                            <a href="#!" type="button" class="btn"><i class="social-icon fab fa-google fa-2x"
                                    style="color: white;"></i> </a>
                            <!-- Instagram -->
                            <a href="#!" type="button" class="btn"><i class="social-icon fab fa-instagram fa-2x"
                                    style="color: white;"></i> </a>
                        </div>
                    </div>

                    <hr style="color:white;">

                    <div class="" style="padding-top: 30px; ">
                        <h5 class="text-uppercase" style="color: white; font-weight: bold; text-align: center;">Paid
                            Partnership</h5>
                    </div>
                </div>
                <div class="d-lg-flex justify-content-center">
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/EpiphoneLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/FenderLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/GibsonLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/TaylorLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/DDLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1">
                            <img class="img-fluid" src="Images/Brands/JCraftLogo1.png" alt="">
                        </div>
                        <div class="col-3 col-lg-1 ">
                            <img class="img-fluid" src="Images/Brands/TakamineLogo1.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="text-center p-3">
                    <p class="text-white" style="font-size: 12px">
                        Copyright ©2024. Edumart Philippines. All Rights Reserved.
                    </p>
                </div>
            </div>
            </div>
    </footer>
     <!-- Modal for Term of Service -->
     <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-top: 23px; padding-bottom: 23px; ">
                    <h5 class="modal-title" id="termsModalLabel">
                        <img src="Images/Logo/Edumart Logo.png" alt="Edumart Logo"
                            style="height: 30px; width: auto; margin-right: 10px;">
                        Terms of Service
                    </h5>
                </div>

                <div class="modal-body" style="max-height: 400px; overflow-y: auto; margin-left: 20px;">
                    <b style="font-size: 15px;">Greeting Users,</b>
                    <p></p>
                    <p>By accessing and using the Liriko Music Store website, you agree to comply with and be bound by
                        the following terms and conditions of use. Please read these terms carefully before using the
                        Website.</p>

                    <br>

                    <b>1. Acceptance of Terms</b>
                    <p>By accessing or using the Website, you acknowledge that you have read, understood, and agree to
                        be bound by these terms of service.
                        If you do not agree to these terms, please refrain from using the Website.</p>

                    <b>2. Use of the Website</b>
                    <p>The Website is owned and operated by Liriko Music Store. All materials, including but not limited
                        to text, images, graphics, logos, and audio clips, displayed on the Website are the property of
                        Liriko Music Store and are protected by applicable intellectual property laws.</p>

                    <b>3. Product Information</b>
                    <p>Liriko Music Store strives to provide accurate and up-to-date information about the products
                        available on the Website. However, we do not warrant or guarantee the accuracy, completeness, or
                        reliability of any product descriptions, pricing, availability, or any other information
                        displayed on the Website.
                        Liriko Music Store reserves the right to modify or discontinue any product or service offered on
                        the Website without prior notice.</p>

                    <b>4. User Accounts</b>
                    <p>In order to make a purchase on the Website, you may be required to create a user account. You are
                        responsible for maintaining the confidentiality of your account information and for all
                        activities that occur under your account.
                        You agree to provide accurate, current, and complete information when creating your user account
                        and to update your information as necessary to keep it accurate and complete.
                        Liriko Music Store reserves the right to suspend or terminate your user account at any time and
                        for any reason, without prior notice.
                    </p>

                    <b>5. Privacy</b>
                    <p>Liriko Music Store values your privacy. Please refer to our Privacy Policy for information on how
                        we collect, use, and protect your personal information.</p>

                    <b>6. Third-Party Websites and Content</b>
                    <p>The Website may contain links to third-party websites that are not owned or controlled by Liriko
                        Music Store. We have no control over and assume no responsibility for the content, privacy
                        policies, or practices of any third-party websites.
                        You acknowledge and agree that Liriko Music Store shall not be responsible or liable, directly
                        or indirectly, for any damage or loss caused or alleged to be caused by or in connection with
                        the use of or reliance on any such content, goods, or services available on or through any
                        third-party websites.</p>

                    <b>7. Limitation of Liability</b>
                    <p>In no event shall Liriko Music Store or its affiliates, directors, officers, employees, agents,
                        or licensors be liable to you or any third party for any indirect, consequential, incidental,
                        special, or punitive damages, including but not limited to damages for loss of profits,
                        goodwill, use, data, or other intangible losses, arising out of or in connection with your use
                        of the Website.</p>

                    <b>8. Indemnification</b>
                    <p>You agree to indemnify, defend, and hold harmless Liriko Music Store and its affiliates,
                        directors, officers, employees, agents, or licensors from and against any claims, liabilities,
                        damages, judgments, awards, losses, costs, expenses, or fees (including reasonable attorneys'
                        fees) arising out of or relating to your violation of these terms of service or your use of the
                        Website.</p>

                    <b>9. Governing Law</b>
                    <p>These terms of service shall be governed by and construed in accordance with the laws, without
                        regard to its conflict of law principles.
                        Any legal action or proceeding arising out of or relating to these terms shall be subject to the
                        exclusive jurisdiction of the court.</p>

                    <b>10. Changes to the Terms of Service</b>
                    <p>Liriko Music Store reserves the right to modify or update these terms of service at any time
                        without prior notice. The updated terms will be effective as of the date of posting on the
                        Website.
                        Your continued use of the Website after any modifications or updates constitutes your acceptance
                        of the revised terms of service.</p>

                    <br>
                    <p style="text-align:center;">Last Update: February 15, 2024</p>

                </div>

                <div class="modal-footer d-flex justify-content-center flex-column">
                    <p class="text-center">By clicking <b>"Accept,"</b> you agree to the Terms of Service.</p>
                    <div>
                        <button type="button" class="btn btn-secondary rounded-0 px-5 mx-1" data-dismiss="modal"
                            id="declineButton" data-bs-dismiss="modal">Decline</button>
                        <button type="button" class="btn btn-dark rounded-0 px-5 mx-1" id="agreeButton" data-bs-dismiss="modal">Accept</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.11.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        // Reset reCAPTCHA widget on page reload
        grecaptcha.ready(function () {
            grecaptcha.reset();
        });
    </script>
</body>

</html>