<?php

session_start();

include 'connection.php';

if (isset($_SESSION['isLoggedIn']['status']) && $_SESSION['isLoggedIn']['status'] === true) {
    header('Location: home');
    exit;
}

$alertType = null;

if ((isset($_SESSION['error-login']) && $_SESSION['error-login'] !== null) || (isset($_SESSION['alert-login']) && $_SESSION['alert-login'] !== null)) {
    if (isset($_SESSION['error-login']) && $_SESSION['error-login'] !== null) {
        $alertType = $_SESSION['error-login'];
    } else {
        $alertType = $_SESSION['alert-login'];
    }

}



if (isset($_POST['loginSubmit'])) {

    $user_name = htmlspecialchars($_POST['username']);
    $pass_word = htmlspecialchars($_POST['password']);


    $queryAccounts = "SELECT * FROM users WHERE username = ?";
    $stmtCheck = mysqli_prepare($conn, $queryAccounts);

    mysqli_stmt_bind_param($stmtCheck, "s", $user_name);
    mysqli_stmt_execute($stmtCheck);

    $result = mysqli_stmt_get_result($stmtCheck);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = htmlspecialchars($row['password']);

        if (password_verify($pass_word, $hashedPassword)) {

            $_SESSION['username'] = $row['username'];
            $_SESSION['userid'] = $row['user_id'];
            $_SESSION['isLoggedIn']['status'] = true;

            header('Location: home');
            exit;
        } else {

            $_SESSION['error-login'] = 0;

            header('Location: login');
            exit;
        }
    } else {

        $_SESSION['error-login'] = 1;

        header('Location: login');
        exit;
    }
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.11.0/dist/css/bootstrap-datepicker.min.css">
        <link rel="icon" href="Images/Icon/E.png" type="image/x-icon">
    <title>Login | Edumart</title>
</head>

<body style="font-family: Poppins; background-color: #f8f9fa;">
    <header style="background-color: white;">
        <nav class="navbar navbar-expand-lg bg-dark px-lg-5">
            <div class="container-fluid">
                <a class="navbar-brand px-4" href="home">
                    <img src="Images/Logo/Edumart Logo.png" width="160px" alt="">
                </a>
                <div class="row right-panel" style="padding-right: 4%;">
                    <div class="col">
                        <div class="cont px-2 px-lg-3">
                            <div class="nav-item" style="width: 140%;">
                                <a class="nav-link " style="color:white; font-size: 90%;" aria-current="page" href="home"><span><i
                                            class="fa fa-home px-1" aria-hidden="true"></i> Home</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cont px-2 px-lg-3">
                            <div class="nav-item" style="color:white; width: 140%;">
                                <a class="nav-link" href="#" style="font-size: 90%;"><span><i
                                            class="fa-solid fa-store px-1"></i> Shop</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="text-center" style="background-color: black;">
            &nbsp;
            <!-- <h6 class="poppins text-light small py-1 py-lg-2 px-2" style="font-size: 70%; letter-spacing: 0.3px;">
                Ready to start <span style="color: yellow">shopping</span>? Sign up now and enjoy exclusive access to
                discounts, promotions, and more.
            </h6> -->
        </div>
    </header>
    <?php if ($alertType !== null): ?>
        <?php if ($alertType < 3): ?>
            <div class="d-flex justify-content-center mt-4 pt-2">
                <div class="col-9">
                    <div class="alert alert-danger" role="alert"
                        style="padding: 0; padding-left: 1.5%; padding-right: 1.5%; padding-top: 0.7%; padding-bottom: 0.7%; font-size: 13px;">
                        <span class="fw-bold">Error : </span>
                        <?php if ($alertType === 0): ?>
                            <span>The password you’ve entered is incorrect.</span>
                        <?php elseif ($alertType === 1): ?>
                            <span>The username you entered isn’t connected to an account.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php $_SESSION['error-login'] = null;
            unset($_SESSION['error-login']); ?>
        <?php else: ?>
            <div class="d-flex justify-content-center mt-4 pt-2">
                <div class="col-9">
                    <div class="alert alert-success" role="alert"
                        style="padding: 0; padding-left: 1.5%; padding-right: 1.5%; padding-top: 0.7%; padding-bottom: 0.7%; font-size: 13px;">
                        <span class="fw-bold">Success : </span>
                        <?php if ($alertType === 3): ?>
                            <span>Your password has been successfully changed. Please proceed to login using your new
                                password.</span>
                        <?php elseif ($alertType === 4): ?>
                            <span></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php $_SESSION['alert-login'] = null;
            unset($_SESSION['alert-login']); ?>
        <?php endif; ?>
    <?php endif; ?>
    <section class="d-flex justify-content-center pb-4">
        <div class="cont col-11 col-sm-9 col-md-6 col-lg-5 mt-4 bg-light"
            style="box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2);">
            <div class="col-12 px-4" style="">
                <div class="row">
                    <div class="col-6">
                        <div class="text-header pt-3 px-2 py-1">
                            <h6 class="sign-in-title fw-bold">SIGN IN</h6>
                        </div>
                    </div>

                </div>
                <div class="contents px-2 pt-4">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="username-div pt-2">
                            <h6 class="username-title">USERNAME <span class="text-danger">*</span></h6>
                            <input type="username" name="username" style="font-size: 13px;"
                                class="form-control username-field rounded-0" id="username" name="username" placeholder = "Username"
                                aria-describedby="usernameHelp">
                        </div>
                        <div class="username-div pt-4">
                            <h6 class="password-title">PASSWORD <span class="text-danger">*</span></h6>
                            <input type="password" name="password" style="font-size: 13px;"
                                class="form-control password-field rounded-0" id="password" name="password" placeholder = "Password"
                                aria-describedby="passwordHelp">
                        </div>
                        <div class="row py-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input mt-2" type="checkbox" value=""
                                        id="flexCheckChecked" />
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col forgot-password-cont text-end">
                                <a href="forgotpassword" style="color: gray; text-decoration-thickness: 1px;"><span
                                        class="forgot-password">Forgot password?</span></a>
                            </div>
                        </div>
                        <div class="text-end py-2">
                            <button type="submit" name="loginSubmit" class="btn btn-dark rounded-0 px-3 login-button"
                                style="font-size: 11px;" data-bs-dismiss="modal">Login</button>
                        </div>
                    </form>
                    <hr>
                    <div class="create-account text-center pb-3">
                        <h6 class="createaccount text-secondary">Don't have an account? <a href="signup"><span
                                    class="text-primary" style="cursor: pointer;"> Sign up</span></a></h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                                    <a href="#!" class="text" style="color: white;">Bag's</a>
                                </li>
                                <li>
                                    <a href="#!" class="text" style="color: white;">Notebooks</a>
                                </li>
                                <li>
                                    <a href="#!" class="text" style="color: white;">Books</a>
                                </li>
                                <li>
                                    <a href="#!" class="text" style="color: white;">Pen</a>
                                </li>
                                <li>
                                    <a href="#!" class="text" style="color: white;">Pencils</a>
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
                        <h5 class="text-uppercase" style="color: white; font-weight: bold; text-align: center;">
                            Partnership</h5>
                    </div>
                </div>
                <div class="d-lg-flex justify-content-center">
                    <div class="row d-flex justify-content-center">
                    <div class="col-3 col-lg-1">
                                <img class="img-fluid" src="Images/Brands/Nb1.png" alt="">
                            </div>
                    <div class="col-3 col-lg-1">
                        
                                <img class="img-fluid" src="Images/Brands/Nb2.png" alt="">
                            </div>
                            <div class="col-3 col-lg-1">
                                <img class="img-fluid" src="Images/Brands/Nb3.png" alt="">
                            </div>
                            <div class="col-3 col-lg-1">
                                <img class="img-fluid" src="Images/Brands/Nb4.png" alt="">
                            </div>
                            <div class="col-3 col-lg-1">
                                <img class="img-fluid" src="Images/Brands/Nb5.png" alt="">
                            </div>
                            <div class="col-3 col-lg-1">
                                <img class="img-fluid" src="Images/Brands/Nb6.png" alt="">
                            </div>
                            <div class="col-3 col-lg-1 ">
                                <img class="img-fluid" src="Images/Brands/Nb7.png" alt="">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>