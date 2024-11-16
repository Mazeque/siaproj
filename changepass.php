<?php

session_start();

include 'connection.php';

if (isset($_SESSION['isLoggedIn']['status']) && $_SESSION['isLoggedIn']['status'] === true) {
    header('Location: home');
    exit;
}

if (!isset($_SESSION['account-success']) && isset($_SESSION['cpass-expiration']) && $_SESSION['cpass-expiration'] < time()) {
    header('Location: home');

    session_destroy();

    exit;
}

if (isset($_POST['submit-form'])) {
    $password = htmlspecialchars($_POST['password']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET password = ? WHERE username = ?";

    $prepare = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($prepare, "ss", $hashedPassword, $_SESSION['username']);
    mysqli_stmt_execute($prepare);

    if (mysqli_affected_rows($conn) > 0) {
        unset($_SESSION['account-success']);
        session_destroy();

        session_start();
        $_SESSION['isLoggedIn']['status'] = false;
        $_SESSION['alert-login'] = 3;
        header('Location: login');
        exit;
    } else {
        echo "Error updating the password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/changepasswordF1.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.11.0/dist/css/bootstrap-datepicker.min.css">
    <link rel="icon" href="Images/Icon/icon-website-l.png" type="image/x-icon">
    <script defer src="JS/changepasswordF2.js"></script>
    <title>Change Password | Liriko</title>
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
                                <a class="nav-link" href="#" style="font-size: 90%;"><span><i
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

    <div class="col-12 position-relative mt-4 d-flex justify-content-center" style="background-color: transparent;">
        <div class="col-11 col-sm-10 col-md-7 rounded col-lg-5 forgot-password-container bg-light mt-5 d-flex justify-content-center"
            style="box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2); overflow: hidden;">
            <div class="col-12 py-4">
                <div class="img col-12 d-flex justify-content-center">
                    <img src="Images/ForgotPassword/forgot-password-transparent.png" width="20%" alt="" srcset="">
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <span class="fw-bold" style="font-size: 20px;">Change Password</span>
                </div>
                <div class="col-12 py-2 d-flex justify-content-center">
                    <span class="" style="font-size: 12px; color: #a8a8a8;">Please enter your new desired
                        password!</span>
                </div>
                <hr>
                <form id="form-password-form" method="POST">
                    <div class="col-12 px-5 py-0" id="forgot-container-1">
                        <div class=" row">
                            <div class="col">
                                <label class="password-label">New Password <span class="text-danger">*</span></label>
                                <input type="password" class="input-field form-control" style="font-size: 12px"
                                    id="password" name="password" placeholder="Your New Password">
                                <label class="error-selector" id="error-password"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-5 py-0" id="forgot-container-2">
                        <div class=" row">
                            <div class="col">
                                <label class="password-label">Confirm New Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="input-field form-control" style="font-size: 12px"
                                    id="confirmpassword" name="confirmpassword" placeholder="Confirm New Password">
                                <label class="error-selector" id="error-confirmpassword"
                                    style="color: red; font-size: 10px;"></label>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="continue text-light px-4 pt-4">
                        <button id="submit-form" onclick="submitForm(event)" type="submit" name="submit-form"
                            class="btn btn-dark d-flex justify-content-center py-2 fw-bold"
                            style="font-size: 12px; width: 100%; letter-spacing: 0.4px;">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>