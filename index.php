<?php

include 'connection.php';

session_start();


if (isset($_POST['loginSubmit'])) {

    $user_name = htmlspecialchars($_POST['username']);
    $pass_word = htmlspecialchars($_POST['password']);
    $rememberme = $_POST['rememberme'];


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

            if ($rememberme == "checked") {
                setcookie('isLoggedIn_username', $row['username'], time() + 604800);
                setcookie('isLoggedIn_userid', $row['user_id'], time() + 604800);
                setcookie('isLoggedIn_status', true, time() + 604800);
            }

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


if (isset($_COOKIE['allowed'])) {
    if (isset($_COOKIE['isLoggedIn_username']) && isset($_COOKIE['isLoggedIn_userid']) && isset($_COOKIE['isLoggedIn_status'])) {
        $_SESSION['username'] = $_COOKIE['isLoggedIn_username'];
        $_SESSION['userid'] = $_COOKIE['isLoggedIn_userid'];
        $_SESSION['isLoggedIn']['status'] = true;



    }




}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Edumart</title>
    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/cookiesF2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
        <link rel="icon" href="Images/Icon/E.png" type="image/x-icon">
    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']['status'] === true): ?>
        <script src="JS/user_loggedinF3.js"></script>
        <script src="JS/loggedinACCF8.js"></script>
        <script src="JS/loggedinIndexF1.js"></script>

    <?php endif; ?>
    <?php if (isset($_SESSION['isChat'])): ?>
        <script src="JS/chatF8.js"></script>
    <?php endif; ?>
    <script src="JS/indexF11.js"></script>

    <?php if (!isset($_COOKIE['allowed'])): ?>
        <script src="JS/cookies.js"></script>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="JS/hint-searchF1.js"></script>
    <script src="JS/searchF1.js"></script>
    <link rel="stylesheet" href="CSS/indexF27.css">
    <link rel="stylesheet" href="CSS/animationF1.css">
    <script defer src="JS/animationF1.js"></script>
    <link rel="stylesheet" href="CSS/allF46.css">
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
                                <li class="nav-item ">
                                    <a class="nav-link active" style="color:white; font-size: 14px;" aria-current="page"
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
                                    <a class="nav-link" href="aboutus" style="color:white; font-size: 14px;">About&nbsp;Us</a>
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

        <section class="image-carousel d-none d-lg-block mt-5 pt-3">
            <div class="container-fluid mt-5" style="background-color: #292929; height: 5px;"></div>
            <div id="carouselExampleDark" class="carousel carousel-dark slide">
                <div class="carousel-indicators" id="carouselIndicatorLarge">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img class="d-block w-100" src="Images/CoverImages/cover p1.png" alt="First slide">
                        <div class="carousel-caption text-start" style="left: 6%; bottom: 14%;">
                            <a href="products" type="button" class="btn btn-dark px-4 fw-bold"
                                style="border-radius: 20px; font-family: Poppins;">SHOP NOW</a>
                        </div>
                    </div>
                    <!-- <div class="carousel-item" data-bs-interval="2000">
                        <img src="..." class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <section class="d-lg-none d-block mt-4 pt-3">
            <div class="container-fluid mt-5" style="background-color: #292929; height: 0px;">&nbsp;</div>
            <div id="carouselExampleDark" class="carousel carousel-dark slide">
                <div class="carousel-indicators" id="carouselIndicatorSmall">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img class="d-block w-100" src="Images/CoverImages/cover1aSmall.png" alt="First slide">
                        <div class="carousel-caption text-center" style="bottom: 6%;">
                            <button type="button" class="btn btn-dark px-4 fw-bold"
                                style="border-radius: 20px; font-family: Poppins;">SHOP NOW</button>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <!-- <img src="..." class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid mb-5" style="background-color: #292929; height: 7px;">&nbsp;</div>
        <section class="container-fluid new-arrival-container pb-4 pt-3">
            <div class="row mb-5 d-flex justify-content-center">
                <div class="hidden-bottom">
                    <div class="new-arrival-box d-flex justify-content-center " style="font-family: NotoSerif">
                        <div class="col-12 d-flex justify-content-center">
                            <span class=" new-arrival fw-bold text-center ">Edumart<span
                                    style="font-size: 60%; opacity: 0.5;">'S</span> NEW
                                ARRIVAL</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-1">
                        <span class="text-center"
                            style="font-family: Poppins; font-size: 80%; letter-spacing: 0.6px; opacity: 0.6;">Discover our newest arrivals and start finding your perfect school supplies!</span>
                    </div>
                </div>
                <div class="col-2 col-lg-1 d-flex justify-content-center mt-4 hidden-bottom">
                    <div class="d-flex justify-content-center container-fluid mb-5 rounded"
                        style="background-color: #d52b1e; height: 3px;">&nbsp;
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <?php
                $fetchitems = "SELECT * FROM products WHERE stocks > 0 ORDER BY product_date_created DESC LIMIT 4";
                $result = $conn->query($fetchitems);

                $index = 1;

                while ($row = $result->fetch_assoc()): // Iterate through each row
                    $imageString = $row['product_images'];
                    $imageString = trim($imageString, "[]");
                    $imageArray = explode(",", $imageString);
                    $imageArray = array_map('trim', $imageArray);
                    $imageArray = array_map(function ($item) {
                        return str_replace('"', '', $item);
                    }, $imageArray);
                    $imagelink = "admin/php-addons/productimages/{$imageArray[0]}";


                    if ($index === 1 || $index === 3):
                        ?>
                        <div class="col-12 col-lg-3 row hidden-left d-flex justify-content-center">
                            <div class="card col-lg-3 mx-lg-4 my-3 my-lg-0 border-0" style="width: 19.5rem;" id="guitar">
                                <div class="d-flex justify-content-center">
                                    <span class="text-light text-center fw-bold px-1"
                                        style="background-color: #d52b1e;font-size: 70%; letter-spacing: 0.8px;">NEW</span>
                                </div>
                                <?php
                                $fetchcatname = "SELECT category_name FROM category WHERE category_id = ?";
                                $fetchstmt = mysqli_prepare($conn, $fetchcatname);
                                $fetchstmt->bind_param("i", $row['category_id']);
                                $fetchstmt->execute();
                                $fetchres = $fetchstmt->get_result();


                                if ($ftchrow = $fetchres->fetch_assoc()): ?>
                                    <div class="d-flex justify-content-center mt-3">
                                        <span class="text-secondary text-center px-1"
                                            style="font-size: 80%; letter-spacing: 1.3px;"><?php echo $ftchrow['category_name'] ?></span>
                                    </div>
                                <?php endif; ?>
                                <img src="<?php echo $imagelink ?>" class="card-img-top" alt="...">
                                <div class="card-body row d-flex justify-content-center">
                                    <div class="col-12 item-desc-box row">
                                        <div class="col-12 name-box">
                                            <h5 class="card-title d-flex justify-content-center text-center my-2 mb-4">
                                                <?php echo $row['name'] ?>
                                            </h5>

                                        </div>
                                        <div class="col-12">
                                            <p class="card-text d-flex justify-content-center"><span
                                                    style="font-size: 100%; padding-right: 3px;" class="inter">₱ </span>
                                                <?php echo $row['price'] ?>
                                            </p>
                                        </div>


                                    </div>
                                    <div class="col-12">
                                        <div class="add-to-cart d-flex justify-content-center">
                                            <button <?php if (!isset($_SESSION['isLoggedIn'])): ?>data-bs-toggle="modal"
                                                    data-bs-target="#loginModal" <?php endif; ?>
                                                class="btn btn-dark add-to-cart-button px-4 mt-4 add-cart"
                                                prodid="<?php echo $row['product_id']; ?>"
                                                price="<?php echo $row['price'] ?>">Add to cart</button>
                                        </div>
                                        <div class="add-to-cart d-flex justify-content-center">
                                            <a href="products?id=<?php echo $row['product_id']; ?>"
                                                class="btn btn-outline-dark add-to-cart-button px-4 ">VIEW ITEM DETAILS
                                                <span style="color: #d52b1e">></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 d-lg-none">
                                <hr style="width: 1; height: 1px;">
                            </div>
                        </div>
                    <?php elseif ($index === 2 || $index === 4): ?>
                        <div class="col-12 col-lg-3 row hidden-right d-flex justify-content-center">
                            <div class="card col-lg-6 mx-lg-4 my-3 my-lg-0 border-0" style="width: 19.5rem;" id="guitar">
                                <div class="d-flex justify-content-center">
                                    <span class="text-light text-center fw-bold px-1"
                                        style="background-color: #d52b1e;font-size: 70%; letter-spacing: 0.8px;">NEW</span>
                                </div>
                                <?php
                                $fetchcatname = "SELECT category_name FROM category WHERE category_id = ?";
                                $fetchstmt = mysqli_prepare($conn, $fetchcatname);
                                $fetchstmt->bind_param("i", $row['category_id']);
                                $fetchstmt->execute();
                                $fetchres = $fetchstmt->get_result();


                                if ($ftchrow = $fetchres->fetch_assoc()): ?>
                                    <div class="d-flex justify-content-center mt-3">
                                        <span class="text-secondary text-center px-1"
                                            style="font-size: 80%; letter-spacing: 1.3px;"><?php echo $ftchrow['category_name'] ?></span>
                                    </div>
                                <?php endif; ?>
                                <img src="<?php echo $imagelink ?>" class="card-img-top" alt="...">
                                <div class="card-body row d-flex justify-content-center">
                                    <div class="col-12 item-desc-box row">
                                        <div class="col-12 name-box">
                                            <h5 class="card-title d-flex justify-content-center text-center my-2 mb-4">
                                                <?php echo $row['name'] ?>
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <p class="card-text d-flex justify-content-center"><span
                                                    style="font-size: 100%; padding-right: 3px;" class="inter">₱ </span>
                                                <?php echo $row['price'] ?>
                                            </p>
                                        </div>


                                    </div>
                                    <div class="col-12">
                                        <div class="add-to-cart d-flex justify-content-center">
                                            <button <?php if (!isset($_SESSION['isLoggedIn'])): ?>data-bs-toggle="modal"
                                                    data-bs-target="#loginModal" <?php endif; ?>
                                                class="btn btn-dark add-to-cart-button px-4 mt-4 add-cart"
                                                prodid="<?php echo $row['product_id']; ?>"
                                                price="<?php echo $row['price'] ?>">Add to cart</button>
                                        </div>
                                        <div class="add-to-cart d-flex justify-content-center">
                                            <a href="products?id=<?php echo $row['product_id']; ?>"
                                                class="btn btn-outline-dark add-to-cart-button px-4 ">VIEW ITEM DETAILS
                                                <span style="color: #d52b1e">></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 d-lg-none">
                                <hr style="width: 1; height: 1px;">
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $index++; endwhile; ?>
            </div>

            <div class="mx-5">
                <hr style="width: 1; height: 1px;">
            </div>
            <div class="browse-all d-flex justify-content-center hidden-bottom">
                <a href="products"><button class="btn btn-outline-dark browse px-4"> BROWSE OUR PRODUCTS <span
                            style="color: #d52b1e">></span></button></a>
            </div>
        </section>
        <div class="py-4">
            <hr class="divider py-3" style="opacity: 1">
        </div>
        <div style="padding-top: 100px; padding-bottom: 100px">
        </div>
        <div class="container-center justify-content-center d-flex mb-5">
            <!-- <div class="main-container col-10">
                <div class="container-fluid">
                    <h6 class="text-uppercase header-title text-center">
                        Video Gallery</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="video-container mb-4 mb-lg-0">

                                <div class="embed-responsive embed-responsive-16by9 bg-gray p-1">
                                    <iframe class="embed-responsive-item" width="100%" height="200"
                                        src="https://www.youtube.com/embed/ZYCZC3CRdUU?si=0RELQM_gYzsm1nnE"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>

                                <div class="video-details" style="margin:10px; font-family:Poppins">
                                    <p style="font-size:15px;"><i class="fa-brands fa-youtube"></i> Youtube</p>
                                    <p style="font-size:16px; font-weight:bold; ">Typecast - Will You Ever Learn</p>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="video-container mb-4 mb-lg-0">

                                <div class="embed-responsive embed-responsive-16by9 bg-gray p-1">
                                    <iframe class="embed-responsive-item" width="100%" height="200"
                                        src="https://www.youtube.com/embed/nvKnY5QOA4Y?si=NhVemYd-A1QwIJKn"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>

                                <div class="video-details" style="margin:10px; font-family:Poppins">
                                    <p style="font-size:15px;"><i class="fa-brands fa-youtube"></i> Youtube</p>
                                    <p style="font-size:16px; font-weight:bold; ">IV Of Spades - Kung Ayaw Mo Huwag Mo
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="video-container mb-4 mb-lg-0">

                                <div class="embed-responsive embed-responsive-16by9 bg-gray p-1">
                                    <iframe class="embed-responsive-item" width="100%" height="200"
                                        src="https://www.youtube.com/embed/Z5NoQg8LdDk?si=1pChvyIV0z4keA8i"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>

                                <div class="video-details" style="margin:10px; font-family:Poppins">
                                    <p style="font-size:15px;"><i class="fa-brands fa-youtube"></i> Youtube</p>
                                    <p style="font-size:16px; font-weight:bold; ">Polyphia - Playing God</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div> -->
        </div>


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
                                <li>
                                    <a href="#!" class="text" style="color: white;">About Us</a>
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
                                    <a href="#!" class="text" style="color: white;">Donate for a cause</a>
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
    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']['status'] === true): ?>
        <div class="fixed-top profile-container d-none" id="profile-container" style="width: 16%; left: 77%; top: 4%;">
            <ul class="list-group fw-bold" style="font-size: 11px;">
                <a class="profile-cont-item" href="#">
                    <li class="list-group-item list-profile-item"><i class="fa-solid fa-user"></i> &nbsp;Profile</li>
                </a>
                <a class="profile-cont-item" href="#">
                    <li class="list-group-item list-profile-item"><i class="fa-solid fa-bag-shopping"></i> &nbsp;Inventory
                    </li>
                </a>
                <a class="profile-cont-item" href="#">
                    <li class="list-group-item list-profile-item"><i class="fa-solid fa-gear"></i> &nbsp;Settings</li>
                </a>
            </ul>
            <div class="divider">&nbsp;</div>
            <form class="list-profile-item" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h6 class="profile-cont-item bg-white">
                    <button class="button-class-profile" type="submit" name="logout" style="background-color: transparent;">
                        <div class="logout px-3 ">
                            <h6 class=" logout"><i class="fa-solid fa-power-off"></i> &nbsp;Sign out</li>
                        </div>
                    </button>
                </h6>
            </form>
        </div>
    <?php else: ?>
    <?php endif; ?>

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
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                                                <input class="form-check-input mt-2" type="checkbox" id="rememberme"
                                                    name="rememberme" value="checked" />
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

            include 'userbox.php';
            ?>

        <?php endif; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['isLoggedIn']['status'])):

        include 'cartcontainer.php';

        ?>

    <?php endif; ?>

    <?php if (!isset($_COOKIE['allowed'])): ?>

        <div class="position-fixed cookie-container" id="cookie-container">
            <div class="cookie-img-box">
                <img class="cookie-img" src="Images/Cookies/cookiesbnw.png" alt="">
            </div>

            <div class="cookie-main-box">
                &nbsp;
                <div class="cookie-box">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <span class="cookie-title">We use Cookies</span>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <span class="sm-lt-space text-center small-text">This website uses cookies to enable that your
                                experience is better. By clicking accept, you agree to this, as outlined in our Cookie
                                Policy.</span>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-3">
                            <div class="row w-100">
                                <div class="col-6">
                                    <button id="reject-cookies" class="btn btn-outline-dark w-100">Reject</button>
                                </div>
                                <div class="col-6">
                                    <button id="accept-cookies" class="btn btn-dark w-100">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>


    <?php endif; ?>
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