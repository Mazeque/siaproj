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

            if (isset($_GET['id'])) {
                header('Location: products?id=' . $_GET['id']);
            } else {
                header('Location: products');
            }
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

if (isset($_GET['id'])) {
    $pid = $_GET['id'];
}



$queryCategory = "SELECT * FROM category ORDER BY category_name ASC";
$queryCat = mysqli_prepare($conn, $queryCategory);

mysqli_stmt_execute($queryCat);
$catresult = mysqli_stmt_get_result($queryCat);

// NEW
$queryProductsCat = "SELECT category_id FROM products";
$queryProd = mysqli_prepare($conn, $queryProductsCat);

if (mysqli_stmt_execute($queryProd)) {
    $prodresult = mysqli_stmt_get_result($queryProd);

    $arrayofcategory = array();
    $arrayofcategorysm = array();

    while ($prodrow = mysqli_fetch_assoc($prodresult)) {
        $words = explode(" ", $prodrow['category_id']);
        $arrayofcategory[] = $words[0];
        $arrayofcategorysm[] = $words[0];
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
    exit;
}


$queryCategorySM = "SELECT * FROM category ORDER BY category_name ASC";
$queryCatSM = mysqli_prepare($conn, $queryCategory);

mysqli_stmt_execute($queryCatSM);
$catresultSM = mysqli_stmt_get_result($queryCatSM);

// NEW
$queryProductsCatSM = "SELECT category_id FROM products";
$queryProdSM = mysqli_prepare($conn, $queryProductsCatSM);

if (mysqli_stmt_execute($queryProdSM)) {

    $prodresultSM = mysqli_stmt_get_result($queryProdSM);

    $arrayofcategorySM = array();
    $arrayofnumberofprod = array();



    while ($prodrowSM = mysqli_fetch_assoc($prodresultSM)) {
        $wordsSM = explode(" ", $prodrowSM['category_id']);
        $arrayofcategorySM[] = $wordsSM[0];

        $countProdSM = "SELECT * FROM products WHERE category_id = ? AND stocks > 0 ";
        $countPrep = mysqli_prepare($conn, $countProdSM);
        $countPrep->bind_param("i", $prodrowSM['category_id']);

        $countPrep->execute();
        $cresult = $countPrep->get_result();

        $arrayofnumberofprod[$prodrowSM['category_id']] = mysqli_num_rows($cresult);

    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
    exit;
}





if (isset($_SESSION['isLoggedIn']['status']) && $_SESSION['isLoggedIn']['status'] === true) {


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
    <title>Shop | Edumart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="Images/Icon/E icon.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="CSS/general.css">

    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']['status'] === true): ?>
        <script defer src="JS/loggedinACCF7.js"></script>
        <script src="JS/user_loggedinF3.js"></script>

    <?php else: ?>
        <script src="JS/notloggedin.JS"></script>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/animationF1.css">
    <link rel="stylesheet" href="CSS/indexF27.css">
    <link rel="stylesheet" href="CSS/allF46.css">
    <?php if (isset($_GET['id'])): ?>
        <link rel="stylesheet" href="CSS/itemtemplateF8.css">
        <script defer src="JS/itemtemplateF14.js"></script>
    <?php else: ?>
        <script defer src="JS/productsF30.js"></script>
    <?php endif; ?>
    <script defer src="JS/loadcarttot.js"></script>
</head>

<body style="font-family: Poppins; ">
    <header class="header">
        <div class="position-absolute container-fluid " style="margin: 0; padding: 0">
            <nav class="navbar navbar-expand-lg bg-dark px-lg-5 d-flex justify-content-center">
                <div class="container-fluid py-2 position-relative" id="navbar-head">
                    <button class="navbar-toggler left-head" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand d-none d-lg-block" href="home">
                        <img src="Images/Logo/Edumart Logo.png" width="130px" alt="">
                    </a>
                    <div class="d-block right-head order-lg-2">
                        <div class="row">
                            <?php if (!isset($_SESSION['isLoggedIn']['status'])): ?>
                                <div class="col-4 ">
                                    <svg class="svg-icon icon-menu icon-profile" data-bs-toggle="modal"
                                        data-bs-target="#loginModal" style="color: black" width="24px" height="40px"
                                        viewBox="0 0 20 20">
                                        <path fill="#fff" class="icon-menu" d="M14.023,12.154c1.514-1.192,2.488-3.038,2.488-5.114c0-3.597-2.914-6.512-6.512-6.512
            c-3.597,0-6.512,2.916-6.512,6.512c0,2.076,0.975,3.922,2.489,5.114c-2.714,1.385-4.625,4.117-4.836,7.318h1.186
            c0.229-2.998,2.177-5.512,4.86-6.566c0.853,0.41,1.804,0.646,2.813,0.646c1.01,0,1.961-0.236,2.812-0.646
            c2.684,1.055,4.633,3.568,4.859,6.566h1.188C18.648,16.271,16.736,13.539,14.023,12.154z M10,12.367
            c-2.943,0-5.328-2.385-5.328-5.327c0-2.943,2.385-5.328,5.328-5.328c2.943,0,5.328,2.385,5.328,5.328
            C15.328,9.982,12.943,12.367,10,12.367z"></path>
                                    </svg>
                                </div>
                            <?php else: ?>
                                <div class="col-4 position-relative " id="profile-button">
                                    <div class="col-12 icon-profile">
                                        <svg class="svg-icon icon-menu" style="color: black" width="24px" height="40px"
                                            viewBox="0 0 20 20">
                                            <path fill="#fff" class="icon-menu" d="M14.023,12.154c1.514-1.192,2.488-3.038,2.488-5.114c0-3.597-2.914-6.512-6.512-6.512
            c-3.597,0-6.512,2.916-6.512,6.512c0,2.076,0.975,3.922,2.489,5.114c-2.714,1.385-4.625,4.117-4.836,7.318h1.186
            c0.229-2.998,2.177-5.512,4.86-6.566c0.853,0.41,1.804,0.646,2.813,0.646c1.01,0,1.961-0.236,2.812-0.646
            c2.684,1.055,4.633,3.568,4.859,6.566h1.188C18.648,16.271,16.736,13.539,14.023,12.154z M10,12.367
            c-2.943,0-5.328-2.385-5.328-5.327c0-2.943,2.385-5.328,5.328-5.328c2.943,0,5.328,2.385,5.328,5.328
            C15.328,9.982,12.943,12.367,10,12.367z"></path>
                                        </svg>
                                        <div class="boxx position-absolute userinfo bg-dark text-white rounded px-1">
                                            <span class="text-white infoprofile">0</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-4">
                                <svg id="search-icon-button" class="svg-icon icon-search icon-menu" width="22px"
                                    height="40px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="icon-search" fill="#fff" fill-rule="nonzero">
                                            <path
                                                d="M19.129,18.164 L14.611,13.644 C15.763,12.271 16.463,10.501 16.463,8.567 C16.463,4.206 12.928,0.671 8.567,0.671 C4.206,0.671 0.671,4.206 0.671,8.567 C0.671,12.928 4.206,16.463 8.567,16.463 C10.501,16.463 12.272,15.765 13.645,14.61 L18.165,19.129 C18.431,19.397 18.864,19.397 19.13,19.129 C19.396,18.863 19.396,18.431 19.129,18.164 Z M8.53051964,15.2499971 C4.85786268,15.2499971 1.88000488,12.2723698 1.88000488,8.59999704 C1.88000488,4.92762429 4.85786268,1.94999695 8.53051964,1.94999695 C12.2031766,1.94999695 15.1800051,4.92762429 15.1800051,8.59999704 C15.1800051,12.2723698 12.2031766,15.2499971 8.53051964,15.2499971 Z"
                                                id="Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-4">
                                <div class="col-12 icon-cart" <?php if (!isset($_SESSION['isLoggedIn'])): ?>
                                        data-bs-toggle="modal" data-bs-target="#loginModal" <?php endif; ?>>
                                    <div class="col cart-icon-cont icon-menu" id="cart-button">
                                        <svg class="svg-icon " width="22px" height="37px" viewBox="0 0 21 25"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <path
                                                    d="M10.5,1.6 C7.29036034,1.6 4.64648287,4.6183258 4.60060619,8.4 L16.3993938,8.4 C16.3535171,4.6183258 13.7096397,1.6 10.5,1.6 Z M3.4474665,9.6 L3.41518915,9.03417106 C3.40507688,8.85690071 3.4,8.67878095 3.4,8.5 C3.4,4.0440531 6.55817935,0.4 10.5,0.4 C14.4418206,0.4 17.6,4.0440531 17.6,8.5 C17.6,8.67878095 17.5949231,8.85690071 17.5848109,9.03417106 L17.5525335,9.6 L3.4474665,9.6 Z M19.1093638,9.60089815 C19.1095767,9.59637884 19.1092978,9.59159151 19.109,9.58647974 L19.109,9.59466911 C19.1091249,9.59681091 19.1092461,9.59888639 19.1093638,9.60089815 Z M19.1137785,9.66215698 C19.1146026,9.67118512 19.1153369,9.67454651 19.1166636,9.68061913 C19.1150665,9.6728505 19.1141547,9.66841593 19.1132436,9.65916249 L19.1137785,9.66215698 Z M1.6,9.60006905 L1.6,23.6024797 L19.109,23.6024797 L19.109,9.60092222 L1.6,9.60006905 Z M1.59939174,9.600069 C1.59893793,9.59567197 1.59946112,9.59114377 1.6,9.58647974 L1.6,9.59480353 C1.59979486,9.5965802 1.59959212,9.59833507 1.59939174,9.600069 Z M20.309,23.6184797 C20.309,24.2718506 19.7783708,24.8024797 19.125,24.8024797 L1.585,24.8024797 C0.930942563,24.8024797 0.4,24.272164 0.4,23.6184797 L0.4,9.58647974 C0.401874146,9.25892137 0.521129512,8.95986976 0.744735931,8.73821567 C0.988257209,8.49469439 1.31824169,8.37979881 1.613,8.40147974 L19.0553287,8.40292857 C19.3899108,8.37963488 19.7218948,8.49484643 19.9652641,8.73821567 C20.1885204,8.96147198 20.3082253,9.26105993 20.3080528,9.57019657 C20.3082491,9.57356468 20.3085649,14.2563257 20.309,23.6184797 Z M0.419117427,9.43347631 C0.422702788,9.41326727 0.425880909,9.40591438 0.431790021,9.39224308 C0.426825193,9.40327674 0.424044504,9.40945645 0.420916144,9.42722959 L0.419117427,9.43347631 Z"
                                                    id="Combined-Shape" fill="#fff" width="22px" fill-rule="nonzero">
                                                </path>
                                            </g>
                                        </svg>
                                        <div class="col ctitems">
                                            <span class="count-tot-items" id="count-tot-items"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse order-lg-1 position-relative" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto fw-bold px-lg-4" style="font-family: Poppins;">
                            <div class="cont px-3" style="width: 100%;">
                                <li class="nav-item">
                                    <a class="nav-link" style="font-size: 14px;" aria-current="page"
                                        href="home">Home</a>
                                </li>
                            </div>
                            <div class="cont px-3" style="width: 100%;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#" style="font-size: 14px;">Shop</a>
                                </li>
                            </div>
                            <div class="cont px-3" style="width: 100%;">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" style="font-size: 14px;">Contact&nbsp;Us</a>
                                </li>
                            </div>
                            <div class="cont px-3" style="width: 100%;">
                                <li class="nav-item">
                                    <a class="nav-link" href="aboutus" style="font-size: 14px;">About&nbsp;Us</a>
                                </li>
                            </div>
                            <div class="small-screen d-lg-none d-block bg-light position-relative">
                                <hr>
                                <?php if (!isset($_SESSION['isLoggedIn']['status'])): ?>
                                    <div class="cont px-3 " style="width: 100%;">
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
                                    <div class="cont px-3 bg-light" style="width: 100%;">
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
                                    <div class="cont px-3 position-relative" style="width: 100%;">
                                        <form class="cont-button" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
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
                    </div>
                </div>
                <div class="col-12 position-fixed search-container d-none px-5 py-0" id="search-container">
                    <div class="col-12 search-content w-100 d-flex justify-content-center position-relative">
                        <div class="input-group search-group-cont">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-magnifying-glass search-buttons"></i>
                                </span>
                            </div>
                            <input type="search-field" placeholder="Search an item"
                                class="form-control search-input-field" id="search-field">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-xmark search-buttons" id="close-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 position-absolute search-prompt-box d-flex justify-content-center px-5">
                        <div class="col-12">
                            <div class="col-12 prompt-cont justify-content-center" id="prompt-cont">

                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container-fluid" style="background-color: #292929; height: 3px;"></div>
    </header>
    <?php if (!isset($_GET['id'])): ?>
        <section class="header-container mb-5 d-flex justify-content-center">
            <div class="row container-fluid">
                <div class="col-12 d-flex justify-content-center">
                    <h1 class="fw-bold head-title">Shop</h1>
                </div>
                <div class="col-12 d-flex justify-content-center text-center">
                    <h1 class="subtitle">Start shopping by selecting your preferred category</h1>
                </div>
            </div>
        </section>
        <section>
            <div class="col-12 d-lg-none d-flex justify-content-center">
                <div class="btn-group w-100 menu-small ">
                    <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown"
                        id="dropdown-toggle" aria-expanded="false">
                        Loading...
                    </button>
                    <ul class="dropdown-menu w-100 ">
                        <?php while ($catrowSM = mysqli_fetch_assoc($catresultSM)): ?>
                            <?php

                            $numberofprodSM = 0;

                            for ($i = 0; $i < count($arrayofcategorySM); $i++) {
                                if ($arrayofcategorySM[0] === $catrowSM['category_name']) {
                                    $numberofprodSM++;
                                }
                            }

                            ?>
                            <li><a class="dropdown-item py-2" name="<?php echo $catrowSM['category_name'] ?>"
                                    category="<?php echo $catrowSM['category_id'] ?>">
                                    <?php echo $catrowSM['category_name'] ?><small class="total-prod px-2">
                                   
                                    </small>
                                </a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </section>
        <section>
            <div class="col-12 mb-4 px-5">
                <div class="row d-flex justiy-content-center px-5 py-3 ">
                    <div class="col-12 col-lg-3 d-none d-lg-block">
                        <div class="col-12 col-lg-4 px-3 py-2">
                            <div class="container-fluid d-flex fw-bold flex-wrap justify-content-start col-12">
                                <span class="category-header-title">
                                    Menu
                                </span>

                            </div>
                        </div>
                        <?php
                        while ($catrow = mysqli_fetch_assoc($catresult)): ?>
                            <?php

                            $numberofprod = 0;

                            for ($i = 0; $i < count($arrayofcategory); $i++) {
                                if ($arrayofcategory[0] === $catrow['category_name']) {
                                    $numberofprod++;
                                }
                            }

                            ?>
                            <div class="col-12 col-lg-4 px-3 py-2">
                                <div class="category-container container-fluid d-flex flex-wrap justify-content-start col-12">
                                    <span class="category-title" name="<?php echo $catrow['category_name'] ?>"
                                        category="<?php echo $catrow['category_id'] ?>">
                                        <?php echo $catrow['category_name'] ?>
                                    </span>

                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="col-12 col-lg-9 px-4">
                        <div class="col-12 d-flex justify-content-lg-start justify-content-center mb-4" id="title-cat-box">
                            <div class="row main-menu-head col-12">
                                <div class="col-12 col-lg-9 head-title-box">
                                    <div class="row">
                                        <div class="col-12 col-lg-0 d-flex justify-content-center justify-content-lg-start">
                                            <span class="title-cat text-center" id="title-cat"></span>
                                        </div>
                                        <div
                                            class="col-12 col-lg-0 d-flex justify-content-center justify-content-lg-start ">
                                            <span class="text-start subtitle-cat" id="tot-title-cat"></span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-lg-3 d-flex justify-content-center justify-content-lg-end  position-relative mt-3 mt-lg-0 sort-box">
                                    <div class="row col-12 d-flex justify-content-center justify-content-lg-start ">
                                        <div class="col-12 d-flex justify-content-center justify-content-lg-start pt-1">
                                            <span class="letter-spacing fade-text small-text">Sort&nbsp;by: </span>
                                        </div>
                                        <div class="col-12 w-100 d-flex justify-content-center justify-content-lg-start align-center text-center main-cont-sort display-filter"
                                            filter="1">
                                            <span class="letter-spacing">Price <span class="fw-bold">L <i
                                                        class="fa-solid fa-arrow-right"></i> H</span> </span>
                                        </div>

                                        <div class="col-12 w-100 d-flex justify-content-center justify-content-lg-start main-cont-sort"
                                            filter="2">
                                            <span class="letter-spacing">Price <span class="fw-bold">H <i
                                                        class="fa-solid fa-arrow-right"></i> L</span> </span>
                                        </div>

                                        <div class="col-12 w-100 d-flex justify-content-center justify-content-lg-start main-cont-sort"
                                            filter="3">
                                            <span class="letter-spacing">Latest </span>
                                        </div>

                                        <!-- BUTTON -->
                                        <div class="col-12 d-flex justify-content-center justify-content-lg-start pt-1">
                                            <div class="sort-button-container">
                                                <button id="previous-button" class="btn btn-outline-dark w-100 sort-button">
                                                    Previous
                                                </button>
                                            </div>
                                            &nbsp;
                                            <div class="sort-button-container">
                                                <button id="next-button" class="btn btn-dark w-100 sort-button">
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 d-flex justify-content-lg-start justify-content-center">
                            &nbsp;
                            <div class="shop-content col-12 justify-content-lg-start justify-content-center mt-5 pt-5 mt-lg-0 pt-lg-0"
                                id="shop-content">

                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-center mt-5 page-nav-main-box">
                            <div class="page-box row">
                                <div class="col page-button d-flex justify-content-center" id="previous-page">
                                    <i class="fa-solid fa-chevron-left pg-icon"></i>
                                </div>
                                <div class="col page-number-box mx-3">
                                    <span class="fw-bold inter text-dark" id="page-number">1</span>
                                </div>
                                <div class="col page-button d-flex justify-content-center" id="next-page">
                                    <i class="fa-solid fa-chevron-right pg-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid mb-5">
                <div class="col-12 newsletter-box d-flex justify-content-center">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 d-flex justify-content-center">
                            <span class="fw-bold newsletter-title">Stay Connected</span>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <span class="subtitle">Tell us your email to receive news and updates</span>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <div class="input-group py-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa-regular fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" id="email-field" class="form-control px-0 py-0"
                                    placeholder="Your email" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa-regular fa-paper-plane submit-email"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <?php include 'itemtemplate.php' ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['isLoggedIn']['status'])): 
        
            include 'cartcontainer.php';
        ?>
      
    <?php endif; ?>

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
                                <a href="#!" class="text" style="color: white;">Donate For a Cause</a>
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
                        <h5 class="text-uppercase" style="color: white; font-weight: bold; text-align: center;">Paid
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <?php //include '../php-addons/search.php'           ?>
    <!-- <script>
        var autocomplete = new Autocomplete(document.getElementById('search-input-field'), {
            data: <?php //echo json_encode($data);               ?>,
        });
    </script> -->

</body>

</html>