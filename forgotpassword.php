<?php

session_start();

include 'connection.php';

if (isset($_SESSION['isLoggedIn']['status']) && $_SESSION['isLoggedIn']['status'] === true) {
    header('Location: home');
    exit;
}

$optionChoosed = null;

if (isset($_POST['submit-form'])) {
    $_SESSION['account-success'] = true;

    $_SESSION['cpass-expiration'] = time() + 300;

    header('Location: changepass');

    exit;
    
}

if (isset($_POST['submit']) && isset($_POST['recoverymethods'])) {

    if ($_POST['recoverymethods'] !== null) {
        $optionChoosed = $_POST['recoverymethods'];

    }
}

if (isset($_POST['submit']) && isset($_POST['cancel'])) {
    session_destroy();
    unset($_POST['cancel']);
    unset($_POST['submit']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/forgotpasswordF7.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.11.0/dist/css/bootstrap-datepicker.min.css">
    <link rel="icon" href="Images/Icon/icon-website-n.png" type="image/x-icon">
    <script src="JS/forgotpasswordF14.js"></script>
    <title>Forgot Password | Liriko</title>
    <style>
        span {
            letter-spacing: .5px;
        }

        .sec-container {
            cursor: pointer;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
</head>

<body style="font-family: Poppins">
    <header style="background-color: #121212;">
        <nav class="navbar navbar-expand-lg px-lg-5">
            <div class="container-fluid">
                <a class="navbar-brand px-4" href="home">
                    <img src="Images/Logo/LIRIKO-LOGO-WHITE.png" width="160px" alt="">
                </a>
                <div class="row right-panel">
                    <div class="col">
                        <div class="cont px-2 px-lg-3">
                            <div class="nav-item text-light" style="width: 140%;">
                                <a class="nav-link " style="font-size: 90%;" aria-current="page" href="home"><span><i
                                            class="fa fa-home px-1" aria-hidden="true"></i>
                                        Home</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cont px-2 px-lg-3">
                            <div class="nav-item text-light" style="width: 140%;">
                                <a class="nav-link" href="products" style="font-size: 90%;"><span><i
                                            class="fa-solid fa-store px-1"></i> Shop</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="contents col-12 position-absolute" style="">

        <div class="space-containers" style="background-color: #121212;">
            <div class="space py-5" style="height: 100%">&nbsp;</div>
            <div class="space py-5 <?php if ($optionChoosed === null): ?> my-5 <?php endif; ?> " style="height: 100%">
                &nbsp;</div>
            <div class="text-center" style="background-color: black; height: 10px;">
                &nbsp;

            </div>
        </div>
        <div class="space-containers" style="background-color: white">
            <div class="space py-5 <?php if ($optionChoosed === null): ?> my-5 <?php endif; ?>" style="height: 100%">
                &nbsp;</div>
            <div class="space py-5 <?php if ($optionChoosed === null): ?> my-5<?php else: ?> my-4 <?php endif; ?>"
                style="height: 100%">&nbsp;</div>
        </div>
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
                                <a href="https://www.facebook.com" type="button" class="btn "><i
                                        class="social-icon fab fa-facebook-f fa-2x" style="color: white;"></i> </a>
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
                            Copyright ©2024. Liriko Philippines. All Rights Reserved.
                        </p>
                    </div>

                </div>
    </div>
    </footer>
    </div>

    <!-- For null -->
    <?php if ($optionChoosed === null): ?>
        <div class="col-12 position-relative mt-4 d-flex justify-content-center" style="background-color: transparent;">
            <div class="col-11 col-sm-10 col-md-7 rounded col-lg-5 forgot-password-container bg-light mt-5 d-flex justify-content-center"
                style="box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="col-12 py-4">
                    <div class="img col-12 d-flex justify-content-center">
                        <img src="Images/ForgotPassword/forgot-password-transparent.png" width="20%" alt="" srcset="">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <span class="fw-bold" style="font-size: 20px;">Forgot Password</span>
                    </div>
                    <div class="col-12 py-2 d-flex justify-content-center">
                        <span class="" style="font-size: 12px; color: #a8a8a8;">Please select the preferred method for
                            password recovery!</span>
                    </div>
                    <hr>
                    <form id="form-password-form" method="POST">
                        <div class="col-12 px-5" id="forgot-container-1">
                            <div class=" row">
                                <div class="col-2 d-flex justify-content-center pt-2">
                                    <input class="form-check-input" type="radio" name="recoverymethods" id="email-recovery"
                                        value="option1">

                                </div>
                                <div class="col-10 sec-container disabled" style="padding: 0; margin: 0;">
                                    <label class="form-check-label" for="inlineRadio1"><span class="fw-bold"><i
                                                class="fa-solid fa-envelope"></i> &nbsp;Email Recovery
                                        </span> </label>
                                    <div class="col-12">
                                        <span
                                            style="font-size: 11px; opacity: 0.6; letter-spacing: 0.4px; padding: 0; margin: 0;">Receive
                                            a password reset link via email.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12 px-5" id="forgot-container-2">
                            <div class=" row">
                                <div class="col-2 d-flex justify-content-center pt-2">
                                    <input class="form-check-input" type="radio" name="recoverymethods"
                                        id="security-question-recovery" value="option2">
                                </div>
                                <div class="col-10 sec-container disabled" style="padding: 0; margin: 0;">
                                    <label class="form-check-label" for="inlineRadio1"><span class="fw-bold"><i
                                                class="fa-solid fa-circle-question"></i> &nbsp;Security Question
                                        </span> </label>
                                    <div class="col-12">
                                        <span
                                            style="font-size: 11px; opacity: 0.6; letter-spacing: 0.4px; padding: 0; margin: 0;">Answer
                                            security questions to verify your identity and reset your password.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12 px-5" id="forgot-container-3">
                            <div class=" row">
                                <div class="col-2 d-flex justify-content-center pt-2">
                                    <input class="form-check-input" type="radio" name="recoverymethods"
                                        id="recovery-password-recovery" value="option3">
                                </div>
                                <div class="col-10 sec-container" style="padding: 0; margin: 0;">
                                    <label class="form-check-label" for="inlineRadio1"><span class="fw-bold"><i
                                                class="fa-solid fa-key"></i> &nbsp;Recovery Password
                                        </span> </label>
                                    <div class="col-12">
                                        <span
                                            style="font-size: 11px; opacity: 0.6; letter-spacing: 0.4px; padding: 0; margin: 0;">Obtain
                                            password using your recovery password provided during account setup.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12 px-5" id="forgot-container-4">
                            <div class=" row">
                                <div class="col-2 d-flex justify-content-center pt-2">
                                    <input class="form-check-input" type="radio" name="recoverymethods" id="phone-recovery"
                                        value="option4">
                                </div>
                                <div class="col-10 sec-container disabled" style="padding: 0; margin: 0;">
                                    <label class="form-check-label" for="inlineRadio1"><span class="fw-bold"><i
                                                class="fa-solid fa-mobile-screen-button"></i> &nbsp;Phone Recovery
                                        </span> </label>
                                    <div class="col-12">
                                        <span
                                            style="font-size: 11px; opacity: 0.6; letter-spacing: 0.4px; padding: 0; margin: 0;">Recover
                                            your password by receiving a verification code via SMS.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="continue text-light d-flex justify-content-center px-4 pt-4">
                            <button onclick = "continuebutton()" type="submit" name="submit"
                                class="btn btn-dark py-2 d-flex justify-content-center fw-bold" id = "continue-button"
                                style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                Continue
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php elseif ($optionChoosed === 'option1'): ?>
        <div class="col-12 position-relative mt-4 d-flex justify-content-center" style="background-color: transparent;">
            <div class="col-11 col-sm-10 col-md-7 rounded col-lg-5 forgot-password-container bg-light mt-5 d-flex justify-content-center"
                style="box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="col-12 py-4">
                    <div class="img col-12 d-flex justify-content-center">
                        <img src="Images/ForgotPassword/forgot-password-transparent.png" width="20%" alt="" srcset="">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <span class="fw-bold" style="font-size: 20px;">Email Recovery</span>
                    </div>
                    <div class="col-12 py-2 d-flex justify-content-center">
                        <span class="" style="font-size: 12px; color: #a8a8a8;">Recover your password through <span
                                class="text-info">Email</span>!</span>
                    </div>
                    <hr>
                    <form action="forgotpassword" method="POST" style="font-size: 11px;">
                        <div class="col-12 px-5" id="forgot-container-1">
                            <span class="form-label fw-bold px-2 " style="letter-spacing: 0.6px;">EMAIL ADDRESS <span
                                    class="text-danger">*</span></span>
                            <input type="email" class="form-control" style="font-size: 11px; height: 35px;" id="email"
                                name="email">
                        </div>
                        <div class="continue text-light px-4 pt-4 row">
                            <div class="col">
                                <button onclick="submitRegister(event)" type="submit" name="submit"
                                    class="btn btn-dark py-2 fw-bold"
                                    style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                    Cancel
                                </button>
                            </div>
                            <div class="col">
                                <button onclick="submitRegister(event)" type="submit" name="submit"
                                    class="btn btn-success py-2 fw-bold"
                                    style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                    Receive Email
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php elseif ($optionChoosed === 'option2'): ?>
        <div class="col-12 position-relative mt-4 d-flex justify-content-center" style="background-color: transparent;">
            <div class="col-11 col-sm-10 col-md-7 rounded col-lg-5 forgot-password-container bg-light mt-5 d-flex justify-content-center"
                style="box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="col-12 py-4">
                    <div class="img col-12 d-flex justify-content-center">
                        <img src="Images/ForgotPassword/forgot-password-transparent.png" width="20%" alt="" srcset="">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <span class="fw-bold" style="font-size: 20px;">Security Question</span>
                    </div>
                    <div class="col-12 py-2 d-flex justify-content-center">
                        <span class="" style="font-size: 12px; color: #a8a8a8;">Recover your password through answering
                            <span class="text-info">Security Question</span>!</span>
                    </div>
                    <hr>
                    <form action="forgotpassword" id = "security-question-form" method="POST" style="font-size: 11px;">
                        <div class="form-containers">
                            <div class="second-container-initial col-12 px-5" id="forgot-container-initial">
                                <span class="form-label fw-bold px-2 " style="letter-spacing: 0.6px;">Username <span
                                        class="text-danger">*</span></span>
                                <input type="username" class="form-control" style="font-size: 11px; height: 35px;"
                                    id="username" name="username">
                                <label class="error-selector" id="error-username"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                            <div class="second-container-final col-12 px-5 d-none" id="forgot-container-final">
                                <div class="col-12">
                                    <span class="form-label fw-bold px-2 " style="letter-spacing: 0.8px; font-size: 10px; opacity: 0.7;">Question you picked:</span>
                                </div>
                                <div class="col-12 pb-3">
                                    <span class="form-label fw-bold px-2 " style="letter-spacing: 0.6px; font-size: 17px" id = "security-question-fetched"></span>
                                </div>
                                <span class="form-label fw-bold px-2 " style="letter-spacing: 0.6px;">Answer <span
                                        class="text-danger">*</span></span>
                                <input type="text" class="form-control" style="font-size: 11px; height: 35px;"
                                    id="answer" name="answer">
                                <label class="error-selector" id="error-securityanswer"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                        </div>
                        <div class="continue text-light px-4 pt-4 row">
                            <div class="col">
                                <button type="submit" name="submit" class="btn btn-dark py-2 fw-bold"
                                    style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                    Cancel
                                </button>
                            </div>
                            <div class="col">
                                <button onclick="submitOption2(event)" type="submit" name="submit-form"
                                    class="btn btn-success d-flex justify-content-center py-2 fw-bold" id="submit-form"
                                    style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                    Next
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php elseif ($optionChoosed === 'option3'): ?>
        <div class="col-12 position-relative mt-4 d-flex justify-content-center" style="background-color: transparent;">
            <div class="col-11 col-sm-10 col-md-7 rounded col-lg-5 forgot-password-container bg-light mt-5 d-flex justify-content-center"
                style="box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="col-12 py-4">
                    <div class="img col-12 d-flex justify-content-center">
                        <img src="Images/ForgotPassword/forgot-password-transparent.png" width="20%" alt="" srcset="">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <span class="fw-bold" style="font-size: 20px;">Recovery Password</span>
                    </div>
                    <div class="col-12 py-2 d-flex justify-content-center">
                        <span class="" style="font-size: 12px; color: #a8a8a8;">Change your password through answering
                            <span class="text-info">Recovery Password</span>!</span>
                    </div>
                    <hr>
                    <form action="forgotpassword" id = "recovery-pasword-form" method="POST" style="font-size: 11px;">
                        <div class="form-containers">
                            <div class="second-container-initial col-12 px-5" id="forgot-container-initial">
                                <span class="form-label fw-bold px-2 " style="letter-spacing: 0.6px;">Username <span
                                        class="text-danger">*</span></span>
                                <input type="username" class="form-control" style="font-size: 11px; height: 35px;"
                                    id="username" name="username">
                                <label class="error-selector" id="error-username"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                            <div class="second-container-final col-12 px-5 d-none" id="forgot-container-final">
                                <span class="form-label fw-bold px-2 " style="letter-spacing: 0.6px;">Your Recovery Password <span
                                        class="text-danger">*</span></span>
                                <input type="password" class="form-control" style="font-size: 11px; height: 35px;"
                                    id="recoverypassword" name="answer">
                                <label class="error-selector" id="error-recoverypasword"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                        </div>
                        <div class="continue text-light px-4 pt-4 row">
                            <div class="col">
                                <button type="submit" name="submit" class="btn btn-dark py-2 fw-bold"
                                    style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                    Cancel
                                </button>
                            </div>
                            <div class="col">
                                <button onclick="submitOption3(event)" type="submit" name="submit-form"
                                    class="btn btn-success d-flex justify-content-center py-2 fw-bold" id="submit-form"
                                    style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                    Next
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php elseif ($optionChoosed === 'option4'): ?>
        <div class="col-12 position-relative mt-4 d-flex justify-content-center" style="background-color: transparent;">
            <div class="col-11 col-sm-10 col-md-7 rounded col-lg-5 forgot-password-container bg-light mt-5 d-flex justify-content-center"
                style="box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="col-12 py-4">
                    <div class="img col-12 d-flex justify-content-center">
                        <img src="Images/ForgotPassword/forgot-password-transparent.png" width="20%" alt="" srcset="">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <span class="fw-bold" style="font-size: 20px;">Phone Recovery</span>
                    </div>
                    <div class="col-12 py-2 d-flex justify-content-center">
                        <span class="" style="font-size: 12px; color: #a8a8a8;">Recover your password via SMS through
                            <span class="text-info">Phone Recovery</span>!</span>
                    </div>
                    <hr>
                    <form action="forgotpassword" id = "phone-recovery-form" method="POST" style="font-size: 11px;">
                        <div class="form-containers">
                            <div class="second-container-initial col-12 px-5" id="forgot-container-initial">
                                <span class="form-label fw-bold px-2 " style="letter-spacing: 0.6px;">Username <span
                                        class="text-danger">*</span></span>
                                <input type="username" class="form-control" style="font-size: 11px; height: 35px;"
                                    id="username" name="username">
                                <label class="error-selector" id="error-username"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                            <div class="second-container-final col-12 px-5 d-none" id="forgot-container-final">
                                <span class="form-label fw-bold px-2 " style="letter-spacing: 0.6px;">SMS code <span
                                        class="text-danger">*</span></span>
                                <input type="text" class="form-control" style="font-size: 11px; height: 35px;"
                                    id="phonerecovery" name="answer">
                                <label class="error-selector" id="error-phonerecovery"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                        </div>
                        <div class="continue text-light px-4 pt-4 row">
                            <div class="col">
                                <button type="submit" name="submit" class="btn btn-dark py-2 fw-bold"
                                    style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                    Cancel
                                </button>
                            </div>
                            <div class="col">
                                <button onclick="submitOption4(event)" type="submit" name="submit"
                                    class="btn btn-success d-flex justify-content-center py-2 fw-bold" id="submit-form"
                                    style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                                    Next
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>