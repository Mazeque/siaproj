<?php

include 'connection.php';


session_start();

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

if (isset($_POST['logout'])) {

    session_destroy();

    unset($_POST['logout']);

    header('Location: home');

} else {

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Edumart</title>
    <link rel="stlyesheet" href="allF46.css">
    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="icon" href="Images/Icon/E.png" type="image/x-icon">
    <script src="JS/indexF11.js"></script>
    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']['status'] === true): ?>
        <script src="JS/user_loggedinF1.js"></script>
        <script src="JS/loggedinIndex.js"></script>
    <?php endif; ?>
    <?php if (isset($_SESSION['isChat'])): ?>
        <script src="JS/chatF8.js"></script>
    <?php endif; ?>
    <script src="JS/hint-search.js"></script>
    <link rel="stylesheet" href="CSS/animationF1.css">
    <link rel="stylesheet" href="CSS/aboutusF3.css">
    <link rel="stylesheet" href="CSS/allF46.css">
    <script defer src="JS/animationF1.js"></script>
</head>

<body style="font-family: Poppins">
    <div class="position-absolute container-fluid" style="margin: 0; padding: 0">
    <header class="head fixed-top">
            <div class="cont d-none d-lg-block px-lg-5 bg-white">
                <div class="row px-lg-5">
                    <div class="col say pb-1">
                        <small style="font-size: 10px; letter-spacing: 0.5px; opacity: 0.9; font-family: Poppins;">Free
                            Delivery: Take advantage
                            of this opportunity!</small>
                    </div>
                    <div class="col user-panel">
                        <div class="cont text-end">
                            <?php if (!isset($_SESSION['isLoggedIn'])): ?>
                                <span class="login-button" data-bs-toggle="modal" data-bs-target="#loginModal"><i
                                        class="fa-solid fa-user"></i>&nbsp; Login your account</span>
                            <?php else: ?>
                                <span class="login-button px-4" data-bs-toggle="modal" data-bs-target="#loginModal"><i
                                        class="fa-solid fa-bell "></i>&nbsp; Notifications
                                </span>
                                <span class="login-button px-3" id="profile-button" style="padding-bottom: 13px;"><i
                                        class="fa-solid fa-user "></i>&nbsp;
                                    <?php echo $_SESSION['username'] ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg bg-dark ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="Images/Logo/Edumart Logo.png" width="125px" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="margin: 0">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0 mx-auto fw-bold" style="font-family: Poppins;">
                            <div class="cont px-3" style="width: 100%;">
                                <li class="nav-item">
                                    <a class="nav-link" style="color:white; font-size: 14px;" aria-current="page"
                                        href="home">Home</a>
                                </li>
                            </div>
                            <div class="cont px-3" style="width: 100%;">
                                <li class="nav-item">
                                    <a class="nav-link" href="products" style="color:white; font-size: 14px;">Shop</a>
                                </li>
                            </div>
                            <div class="cont px-3" style="width: 100%;">
                                <li class="nav-item">
                                    <a class="nav-link" href="aboutus" style="color:white; font-size: 14px;">Contact&nbsp;Us</a>
                                </li>
                            </div>
                            <div class="cont px-3" style="width: 100%;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="aboutus" style="color:white; font-size: 14px;">About&nbsp;Us</a>
                                </li>
                            </div>
                            <div class="small-screen d-lg-none d-block">
                                <hr>
                                <?php if (!isset($_SESSION['isLoggedIn'])): ?>
                                    <div class="cont px-3" style="width: 100%;">
                                        <li class="nav-item">
                                            <h6 data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link"
                                                href="#" style="font-size: 15px; cursor: pointer;">Login</h6>
                                        </li>
                                    </div>
                                    <div class="cont px-3" style="width: 100%;">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" style="font-size: 15px;">Sign&nbsp;up</a>
                                        </li>
                                    </div>
                                <?php else: ?>
                                    <div class="cont px-3" style="width: 100%;">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" style="font-size: 15px;">Profile</a>
                                        </li>
                                    </div>
                                    <div class="cont px-3" style="width: 100%;">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" style="font-size: 15px;">Inventory</a>
                                        </li>
                                    </div>
                                    <div class="cont px-3" style="width: 100%;">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" style="font-size: 15px;">Settings</a>
                                        </li>
                                    </div>
                                    <hr>
                                    <div class="cont px-3" style="width: 100%;">
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <button class="border-0 rounded bg-dark" type="submit" name="logout"
                                                style="width: 100%;">
                                                <li class="nav-item">
                                                    <h6 class="nav-link text-light fw-bold pb-0" style="font-size: 15px; ">
                                                        <i class="fa-solid fa-power-off"></i>&nbsp;Sign out
                                                    </h6>
                                                </li>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </ul>
                        <div class="right-panel d-none d-lg-block" id="right-panel"
                            style="width: 38%; height: 35px; display: flex; justify-content: start; align-content: center;">
                            <div class="row">
                                <div id="search-button"
                                    class="search-button col-5 d-flex justify-content-end align-items-center border-end">
                                    <div class="search-click" id="search-click">
                                        <p class="mx-1" style="color:white; font-family: Poppins; margin: 0; font-size: 14px;">
                                            <span><i class="fas fa-search fa-sm"></i></span>&nbsp; Search
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-start align-items-center border-start"
                                    style="padding: 0">
                                    <div <?php if (!isset($_SESSION['isLoggedIn'])): ?> data-bs-toggle="modal"
                                            data-bs-target="#loginModal" <?php endif; ?>id="cart-button"
                                        class=" px-2 cart-div d-flex justify-content-start align-items-center">
                                        <p style="display: flex; text-decoration: none; color: inherit;">
                                        <p class="mx-2" style="color:white; font-family: Poppins; margin: 0; font-size: 14px;">
                                            Cart &nbsp;<span><i class="fa-solid fa-basket-shopping fa-sm"></i></span>
                                        </p>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-3 row inbox-box " style="margin-top: 5px;">
                                    <?php if (!isset($_SESSION['isLoggedIn'])): ?>
                                        <a class="" href="signup">
                                            <button type="button" class="btn btn-outline-dark fw-bold img-fluid"
                                                style="color:white; font-family: Poppins; font-size: 12px; border-radius: 30px; border-width:2px;">Sign&nbsp;Up</button>
                                        </a>
                                    <?php else: ?>
                                        <div class="col-6 d-flex px-0 justify-content-center">
                                            <span class="px-2"><i class="fa-solid fa-envelope"
                                                    style="font-size: 20px; margin: 0; padding: 0;"></i></span>
                                        </div>
                                        <div class="col-6 d-flex px-0 justify-content-start text-start">
                                            <h6 style="font-size: 13px; padding: 0; margin: 0; padding-top: 3px;">Inbox</h6>
                                        </div>

                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <div class="search-panel d-none" id="search-panel"
                            style="padding-right: 4%; width: 38%; height: 80px; display: flex; justify-content: start; align-content: center;">
                            <div class="input-group search-group" style="height: 20px !important; margin-bottom: 40px;">
                                <input class="search-field form-control me-2 rounded-0" id="search-input-field"
                                    type="text" name="search-field" style="font-size: 11px; margin: 0"
                                    placeholder="Search">
                                <button class="btn btn-outline-dark fw-bold rounded-0 letter-spacing" type="submit"
                                    style="font-size: 11px;" id="cancel-button">Cancel</button>
                                <button class="btn btn-outline-dark fw-bold rounded-0 d-none" type="submit"
                                    style="font-size: 11px;" id="searching-button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container-fluid" style="background-color: #292929; height: 3px;"></div>
        </header>

        <div class="container py-4 mt-4 space-head"></div>

        <!-- Carousel Header -->
        <div class="container-fluid" style="background-color: #292929; height: 7px;">&nbsp;</div>

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                    aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"
                    aria-label="Slide 6"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="Images/Edumart Pics Main/aboutus/C1.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="Images/Edumart Pics Main/aboutus/C2.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="Images/Edumart Pics Main/aboutus/C3.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="Images/Edumart Pics Main/aboutus/C4.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="Images/Edumart Pics Main/aboutus/C5.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="Images/Edumart Pics Main/aboutus/C6.png" class="d-block w-100" alt="">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container-fluid" style="background-color: #292929; height: 7px;">&nbsp;</div>


        <!-- CSS -->
        <style>
            .containerBox {
                bottom: 0;
                left: 0;
                right: 0;
                padding-left: 100px;
                padding-bottom: 50px;
            }

            .main {
                width: 1200px;
                max-width: 95%;
                margin: 0 auto;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-around;
            }

            .all-text {
                width: 600px;
                max-width: 100%;
                padding: 0 10px;
            }




            @media screen and (max-width: 1250px) {
                .about {
                    width: 100%;
                    height: auto;
                    padding: 60px 0;
                }

                .all-text {
                    text-align: center;
                    margin-top: 40px;
                }
            }
        </style>

        <div class="container py-1"></div>

        <section class="about">
            <div class="main">
                <img src="Images/Edumart Pics Main/aboutus/EdumartPH.png" width="50%" height="50%" alt="">
                <div class="all-text">
                    <h5 class="letter-spacing subtitle">About Us</h5>
                    <h1 class="text py-2 title">Edumart Philippines</h1>
                    <p class="text py-2 desc">Edumart offers a wide range of essential school supplies, 
                        including notebooks, pens, backpacks, calculators, and more. The company’s commitment to 
                        quality, affordability, and convenience has made them a trusted name in the education sector.
                        With a focus on providing students, parents, and educators with everything they need for a 
                        successful school experience, EduSupplies has become a go-to destination for all academic levels, from elementary to college. Their dedication to customer satisfaction and reliable products ensures every learner is well-prepared for the school year.


                    </p>

                    <div class="btn" style="padding-left: 0;">
                        <button type="button" class="btn btn-secondary rounded-0" onclick="openChat()">Contact
                            Us</button>
                        <script>
                            function openChat() {
                                document.getElementById('chatConvo').classList.remove('d-none');
                            }
                        </script>
                    </div>


                    <div class="btn" style="padding-left: 0;">
                        <button type="button" class="btn btn-dark rounded-0 mx-3"
                            onclick="window.location.href='index.php'">More</button>
                    </div>

                </div>
            </div>
        </section>

        <div class="container py-1"></div>


        <div class="container py-1"></div>




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
                                    <a href="aboutus.php" class="text" style="color: white;">About</a>
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
                                    <a href="#!" class="text" style="color: white;">Donate For a cause</a>
                                </li>
                            </ul>
                        </div>


                        <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-center text-lg-start"
                        style="padding-top:40px; font-family:Poppins;">
                        <h6 class="text-uppercase px-lg-4" style="color: white; font-weight: bold;">FOLLOW
                            OUR SOCIALS</h6>
                        <div class="mt-4">
                            <a href="https://www.facebook.com" type="button" class="btn "><i
                                    class="social-icon fab fa-facebook-f fa-2x" style="color: white;"></i> </a>
                            <a href="#!" type="button" class="btn"><i class="social-icon fab fa-twitter fa-2x"
                                    style="color: white;"></i> </a>
                            <a href="#!" type="button" class="btn"><i class="social-icon fab fa-google fa-2x"
                                    style="color: white;"></i> </a>
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
    </div>
    <?php if (!isset($_SESSION['isLoggedIn']['status'])): ?>
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md mt-5 pt-5">
                <div class="modal-content rounded-0">
                    <div class="cont">
                        <div class="col-12 px-4" style="">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-header pt-3 px-2 py-1">
                                        <h6 class="sign-in-title fw-bold">SIGN IN</h6>
                                    </div>
                                </div>
                                <div class="col-6 text-end d-flex justify-content-end" data-bs-dismiss="modal"
                                    style="cursor: pointer;">
                                    <div class="text-center" style="background-color: #292929; width: 11%; height:53%;">
                                        <span style="color: white;">✖</span>
                                    </div>
                                </div>
                            </div>
                            <div class="contents px-2 pt-4">
                                <form
                                    action=" <?php if (!isset($_GET['id'])): ?>products<?php else: ?>products?id=<?php echo $_GET['id']; endif; ?>"
                                    method="POST">
                                    <div class="username-div pt-2">
                                        <h6 class="username-title">USERNAME <span class="text-danger">*</span></h6>
                                        <input type="username" name="username" style="font-size: 13px;"
                                            class="form-control username-field rounded-0" id="username" name="username"
                                            aria-describedby="usernameHelp">
                                    </div>
                                    <div class="username-div pt-4">
                                        <h6 class="password-title">PASSWORD <span class="text-danger">*</span></h6>
                                        <input type="password" name="password" style="font-size: 13px;"
                                            class="form-control password-field rounded-0" id="password" name="password"
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
                                            <a href="forgotpassword"
                                                style="color: gray; text-decoration-thickness: 1px;"><span
                                                    class="forgot-password">Forgot password?</span></a>
                                        </div>
                                    </div>
                                    <div class="text-end py-2 justify-content-end d-flex">
                                        <button onclick="donebutton(event)" type="submit" name="loginSubmit"
                                            class="btn btn-dark rounded-0 px-3 login-button text-center d-flex justify-content-center"
                                            style="font-size: 11px;" id="login-button">Login</button>
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
                </div>
            </div>
        </div>
    <?php else:

        $getinfo = "SELECT * FROM users WHERE user_id = ?";

        $getstmt = mysqli_prepare($conn, $getinfo);
        $getstmt->bind_param("i", $_SESSION['userid']);
        $getstmt->execute();

        $getresult = $getstmt->get_result();

        if ($u_row = mysqli_fetch_assoc($getresult)):

            include 'userbox.php'
                ?>

        <?php endif; ?>
    <?php endif; ?>
    <!-- CHAT -->

    <div class="chat-container">
        <span onclick="toggleChat()" class="fab text-center d-flex justify-content-center align-items-center">💬</span>
        <?php if (!isset($_SESSION['isChat'])): ?>
            <div id="chatConvo" class="chat-convo d-none">
                <div class="container-fluid">
                    <div class="row chat-header">
                        <div class="col text-start" style="padding-top: 4%; padding-left: 5%">
                            <h6 class="text-dark fw-bold" style="font-size: 15px; letter-spacing: 0.6px;">Live Chat</h6>
                        </div>
                        <div class="col text-end " style="padding-top: 2%;">
                            <div style="width: 20%; padding-left: 80%;">
                                <h5 class="text-dark" style="cursor: pointer; color: white;" onclick="toggleChat()">×</h5>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content text-center">
                        <div class="chat-welcome">
                            <img src="Images/Logo/LIRIKO-LOGO-1.png" class="pt-5" width="50%" alt="">
                            <p class="pt-3" style="font-size: 12px;">Welcome to Liriko! Please fill out the form to be
                                connected to a support agent!</p>
                            <div class="form-div text-start">
                                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="form-group py-1">
                                        <label style="font-size: 11px;">Name</label>
                                        <input type="name" class="chat-control form-control" name="name-chat" id="nameChat"
                                            placeholder="ex. Sharraine" style="font-size: 12px;">
                                    </div>
                                    <div class="form-group py-1">
                                        <label style="font-size: 11px;">Email</label>
                                        <input type="email" class="chat-control form-control" name="email-chat"
                                            id="emailChat" placeholder="ex. name@liriko.com" style="font-size: 12px;">
                                    </div>
                                    <div class="form-group py-1">
                                        <label style="font-size: 11px;">Support</label>
                                        <select class="chat-control form-control" id="supportChat" name="support-chat"
                                            style="font-size: 12px;">
                                            <option>Sales Support</option>
                                            <option>Technical Support</option>
                                            <option>Billing and Account</option>
                                        </select>
                                    </div>
                                    <div class="form-group py-1">
                                        <label style="font-size: 11px;">How can we help you?</label>
                                        <textarea class="chat-control form-control" id="messageChat" name="message-chat"
                                            rows="3" style="font-size: 12px;"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button onclick="startchat(event)" id="chat-submit" type="submit" name="chat-submit"
                                            class="btn btn-dark my-3 mb-4 fw-bold"
                                            style="font-size: 12px; width: 100%; letter-spacing: 0.4px;"><span
                                                class="px-1"><i class="fa-solid fa-paper-plane"></i></span> Start
                                            Chat</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>

            <div id="chatConvo" class="chat-convo d-none">
                <div class="container-fluid" style="height: 100%; width: 100%; ">
                    <div class="row chat-header">
                        <div class="col text-start" style="padding-top: 4%; padding-left: 5%">
                            <h6 class="text-dark fw-bold" style="font-size: 15px; letter-spacing: 0.6px;">Live Chat <span
                                    class="text-success"> •</span></h6>
                        </div>
                        <div class="col text-end" style="padding-top: 2%;">
                            <div style="width: 20%; padding-left: 83%;">
                                <h5 class="text-dark" style="cursor: pointer; color: white;" onclick="toggleChat()">_</h5>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content text-center" style="height: 84%; width: 100%;  ">
                        <input type="hidden" id="sender-value" name="sender-value"
                            value="<?php echo $_SESSION['sender'] ?>">
                        <input type="hidden" id="chat-id" name="chat-id"
                            value="<?php echo $_SESSION['chat-details']['id'] ?>">
                        <span class="text-secondary" style="font-size: 12px;">You are chatting with <span
                                class="text-dark fw-bold">
                                <?php echo $_SESSION['chat-details']['type'] ?>
                            </span></span>
                        <div class="chat-welcome justify-content-center d-flex py-2"
                            style="height: 78%; width: 100%;  display: contents;">
                            <div class="conversation rounded" id="conversation"
                                style="flex: 1 1 auto; height: auto; width: 100%; overflow-y: auto;">
                                <!-- <div class="TEST" style = "height: 110%">sd</div> -->
                            </div>
                        </div>
                        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                            <button class="btn btn-outline-danger fw-bold" id="endchat" type="submit" name="end-chat"
                                style="width: 100%; height: 27px; border-radius: 0; letter-spacing: 0.5px; padding: 0; font-size: 11px;">End
                                Chat</button>
                        </form>
                        <div class="row mt-2">
                            <div class="col-10">
                                <input type="text" class="form-control" placeholder="Your message here..."
                                    id="chat-message-field" style="width: 100%; font-size: 12px;">
                            </div>
                            <div class="col-1 px-0 d-flex justify-content-start" style=" padding-right: 30px;">
                                <button class="btn btn-dark d-flex" id="chat-send" style="height: 32px; width: 40px;"><i
                                        class="fa-solid fa-paper-plane" style="font-size: 12px; padding-top: 2px;">
                                    </i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md mt-5 pt-5">
            <div class="modal-content rounded-0">
                <div class="cont">
                    <div class="col-12 px-4" style="">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-header pt-3 px-2 py-1">
                                    <h6 class="sign-in-title fw-bold">SIGN IN</h6>
                                </div>
                            </div>
                            <div class="col-6 text-end d-flex justify-content-end" data-bs-dismiss="modal"
                                style="cursor: pointer;">
                                <div class="text-center" style="background-color: #292929; width: 11%; height:53%;">
                                    <span style="color: white;">✖</span>
                                </div>
                            </div>
                        </div>
                        <div class="contents px-2 pt-4">
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="username-div pt-2">
                                    <h6 class="username-title">USERNAME <span class="text-danger">*</span></h6>
                                    <input type="username" name="username" style="font-size: 13px;"
                                        class="form-control username-field rounded-0" id="username" name="username"
                                        aria-describedby="usernameHelp">
                                </div>
                                <div class="username-div pt-4">
                                    <h6 class="password-title">PASSWORD <span class="text-danger">*</span></h6>
                                    <input type="password" name="password" style="font-size: 13px;"
                                        class="form-control password-field rounded-0" id="password" name="password"
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
                                        <a href="forgotpassword"
                                            style="color: gray; text-decoration-thickness: 1px;"><span
                                                class="forgot-password">Forgot password?</span></a>
                                    </div>
                                </div>
                                <div class="text-end py-2 justify-content-end d-flex">
                                    <button onclick="donebutton(event)" type="submit" name="loginSubmit"
                                        class="btn btn-dark rounded-0 px-3 login-button text-center d-flex justify-content-center"
                                        style="font-size: 11px;" id="login-button">Login</button>
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
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <?php include 'php-addons/search.php' ?>
    <script>
        var autocomplete = new Autocomplete(document.getElementById('search-input-field'), {
            data: <?php echo json_encode($data); ?>,
        });
    </script>

</body>

</html>