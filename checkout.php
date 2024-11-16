<?php

session_start();

$checkoutid = $_GET['id'];

include 'connection.php';

if (!isset($_SESSION['isLoggedIn']['status'])) {

    header("Location: home");

    exit;


}


if (!isset($_SESSION['checkout-pass']) || !isset($_SESSION['checkout-id'])) {
    header('Location: home');

    exit;
} else {

    if ($_SESSION['checkout-id'] !== $checkoutid) {
        unset($_SESSION['checkout-id']);
        unset($_SESSION['checkout-pass']);
        unset($_SESSION['checkout-items']);

        header('Location: home');

        exit;
    }

}


$query = "SELECT * FROM users WHERE user_id =?";

$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param("i", $_SESSION['userid']);
$stmt->execute();
$resultset = $stmt->get_result();

if ($resultset && mysqli_num_rows($resultset) > 0) {
    $rs = mysqli_fetch_assoc($resultset);


} else {

    header('Location: home');

    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out | Edumart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="Images/Icon/E.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="CSS/general.css">

    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']['status'] === true): ?>
        <script src="JS/checkout_loggedin.js"></script>
    <?php else: ?>
        <script src="JS/notloggedin.JS"></script>
    <?php endif; ?>
    <script src="JS/hint-searchF1.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/animationF1.css">
    <link rel="stylesheet" href="CSS/indexF27.css">
    <link rel="stylesheet" href="CSS/allF46.css">

    <link rel="stylesheet" href="CSS/checkoutF16.css">

    <?php if (isset($_GET['id'])): ?>
        <link rel="stylesheet" href="CSS/itemtemplateF7.css">
        <script defer src="JS/itemtemplateF11.js"></script>
    <?php else: ?>
        <script defer src="JS/productsF30.js"></script>
    <?php endif; ?>
    <script defer src="JS/loadcarttot.js"></script>

    <script defer src="JS/checkoutF12.js"></script>
</head>

<body style="font-family: Poppins; ">
    <header class="header">
        <div class="position-absolute container-fluid " style="margin: 0; padding: 0">
            <nav class="navbar navbar-expand-lg bg-light px-lg-5 d-flex justify-content-center">
                <div class="container-fluid py-2 position-relative" id="navbar-head">
                    <button class="navbar-toggler left-head" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="home">
                        <img src="Images/Logo/Edumart Black Logo.png" width="130px" alt="">
                    </a>
                    <div class="d-block right-head order-lg-2">
                        <div class="row">
                            <?php if (!isset($_SESSION['isLoggedIn']['status'])): ?>
                                <div class="col-4 ">
                                    <svg class="svg-icon icon-menu icon-profile" data-bs-toggle="modal"
                                        data-bs-target="#loginModal" style="color: black" width="24px" height="40px"
                                        viewBox="0 0 20 20">
                                        <path fill="#000" class="icon-menu" d="M14.023,12.154c1.514-1.192,2.488-3.038,2.488-5.114c0-3.597-2.914-6.512-6.512-6.512
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
                                            <path fill="#000" class="icon-menu" d="M14.023,12.154c1.514-1.192,2.488-3.038,2.488-5.114c0-3.597-2.914-6.512-6.512-6.512
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
                                        <g id="icon-search" fill="#000000" fill-rule="nonzero">
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
                                                    id="Combined-Shape" fill="#000" width="22px" fill-rule="nonzero">
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
    <div class="header-space">&nbsp;</div>
    <section class="d-flex justify-content-center">
        <div class="row container-fluid ">
            <div class="col-12 d-flex justify-content-center">
                <h1 class="fw-bold head-title">Checkout</h1>
            </div>
            <div class="col-12 d-flex justify-content-center text-center">
                <h1 class="subtitle">Complete your purchase and finalize your order!</h1>
            </div>
        </div>
    </section>
    <section class="d-flex justify-content-center px-lg-5 mt-5 mb-5">
        <div class="row col-12 col-lg-11 px-3">
            <div class="col-12 col-lg-8 px-lg-4 px-0 my-2">
                <div class="row bg-white div-container rounded">
                    <div class="col icon-box">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="col details-box">
                        <div class="col-12">
                            <span class="details-title">LOGIN <i class="fa-solid fa-circle-check"></i></span>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="details-content"><?php echo $rs['firstname'] . ' ' . $rs['lastname'] ?>
                                &nbsp;<span class="phonenum">(<?php

                                $contactnumb = substr_replace($rs['contactnumber'], "+63", 0, 1);
                                $countrycode = substr($contactnumb, 0, 3);
                                $areacode1 = substr($contactnumb, 3, 3);
                                $areacode2 = substr($contactnumb, 6, 3);
                                $localnumber = substr($contactnumb, 9, 4);

                                $formattedPhone = $countrycode . " " . $areacode1 . " " . $areacode2 . " " . $localnumber;
                                echo $formattedPhone;
                                ?>)</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row bg-white div-container rounded mt-4">
                    <div class="col-12 row">
                        <div class="col icon-box">
                            <i class="fa-solid fa-file-invoice"></i>
                        </div>
                        <div class="col details-box row justify-content-between">
                            <div class="col-7">
                                <span class="details-title">BILLING ADDRESS <i
                                        class="fa-solid fa-circle-check"></i></span>
                            </div>
                            <div class="col-5 d-flex justify-content-end py-1 px-1">
                                <i class="fa-solid fa-chevron-right pointer dragger" id="billing-address-drag"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 billing-details-container toggle-bd-container" id="billing-address-details">
                        <div class="container-fluid d-flex justify-content-center mt-4">
                            <div class="col-12 row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 px-3">
                                            <label class="field-title" for="firstname">First name <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <input type="text" class="form-control text-field" id="firstname"
                                                value="<?php echo $rs['firstname'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3 mt-lg-0 ">
                                    <div class="row">
                                        <div class="col-12 px-3">
                                            <label class="field-title" for="lastname">Last name <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <input type="text" class="form-control text-field" id="lastname"
                                                value="<?php echo $rs['lastname'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3 px-lg-0 px-4">
                            <div class="row px-lg-4 px-0">
                                <div class="col-12 px-3">
                                    <label class="field-title" for="address">Address <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 mt-1">
                                    <input type="text" class="form-control text-field" id="address"
                                        value="<?php echo $rs['street'] . ' ' . $rs['barangay'] . ', ' . $rs['city'] . ' City' ?>">
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-center mt-4">
                            <div class="col-12 row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 px-3">
                                            <label class="field-title" for="regionstate">Region / State <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <input type="text" class="form-control text-field" id="regionstate"
                                                value="<?php echo $rs['regionstate'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3 mt-lg-0 ">
                                    <div class="row">
                                        <div class="col-12 px-3">
                                            <label class="field-title" for="country">Country <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <input type="text" class="form-control text-field" id="country"
                                                value="<?php echo $rs['country'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-center mt-4">
                            <div class="col-12 row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 px-3">
                                            <label class="field-title" for="regionstate">Postal Code <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <input type="text" class="form-control text-field" id="postcode"
                                                value="<?php echo $rs['postcode'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3 mt-lg-0 ">
                                    <div class="row">
                                        <div class="col-12 px-3">
                                            <label class="field-title" for="country">Contact Number <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group my-0 py-0 w-100 text-field mt-1 border-rad">
                                                <div class="input-group-prepend py-0">
                                                    <span class="input-group-text position-absolute">
                                                        <select class="country-code" name="" id="countrycode">
                                                            <option value="+63">+63</option>
                                                        </select>
                                                    </span>

                                                </div>
                                                <input type="text" class="form-control contactnum-field"
                                                    id="contactnumber" value="<?php $contnum = substr_replace($rs['contactnumber'], '', 0, 1);
                                                    echo $contnum; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3 px-lg-0 px-4 mb-3">
                            <div class="row px-lg-4 px-0">
                                <div class="col-12 px-3">
                                    <label class="field-title" for="address">Note <span
                                            class="text-secondary">(Optional)</span></label>
                                </div>
                                <div class="col-12 mt-1">
                                    <textarea type="text" class="form-control textarea-field" id="note" rows="3"
                                        placeholder="Say something for your delivery information..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row bg-white div-container rounded mt-4">
                    <div class="col-12 row">
                        <div class="col icon-box">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <div class="col details-box row justify-content-between">
                            <div class="col-7">
                                <span class="details-title">PAYMENT METHOD <i
                                        class="fa-solid fa-circle-check"></i></span>
                            </div>
                            <div class="col-5 d-flex justify-content-end py-1 px-1">
                                <i class="fa-solid fa-chevron-right pointer dragger" id="payment-drag"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 payment-container toggle-bd-container" id="payment-details">
                        <div class="container-fluid d-flex justify-content-center mt-4 mb-3">
                            <div class="col-12 row d-flex justify-content-center px-3">
                                <div class="row px-3 container-fluid payment-method-box my-1" paymentmethod="Cash On Delivery">
                                    <div class="col payment-method-logo py-3">
                                        <div class="img-pm-logo-box ">
                                            <img class="img-fluid" src="Images/Checkout/cashondelivery.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col py-3 d-flex justify-content-start payment-title-box">
                                        <span class="payment-method-title">Cash on Delivery</span>
                                    </div>
                                    <div class="col d-flex justify-content-end checked-pm-box">
                                        <i class="fa-solid fa-circle-check checked-pm d-none"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="row px-3 container-fluid payment-method-box my-1" paymentmethod="Wallet">
                                    <div class="col payment-method-logo py-3">
                                        <div class="img-pm-logo-box ">
                                            <img class="img-fluid" src="Images/Checkout/wallet.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col py-3 d-flex justify-content-start payment-title-box">
                                        <span class="payment-method-title">Wallet</span>
                                    </div>
                                    <div class="col d-flex justify-content-end checked-pm-box">
                                        <i class="fa-solid fa-circle-check checked-pm d-none"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-3">
                            <div class="row">
                                <div
                                    class="col-12 col-lg-7 d-flex justify-content-center justify-content-lg-start my-lg-0 ">
                                    <span class="saved-methods ">Saved cards & other payment methods</span>
                                </div>
                                <div
                                    class="col-12 col-lg-5 d-flex justify-content-center justify-content-lg-end my-3 my-lg-0  other-card-box">
                                    <a href="menu?cat=payments" class="link-payment text-decoration-none"><i
                                            class="fa-solid fa-circle-plus"></i> Link Payment
                                        Method</a>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 row d-flex justify-content-center  mt-3">
                                <?php

                                $pmquery = "SELECT * FROM paymentmethod WHERE user_id = ?";

                                $pmstmt = mysqli_prepare($conn, $pmquery);
                                $pmstmt->bind_param("i", $_SESSION['userid']);
                                $pmstmt->execute();
                                $resultset = $pmstmt->get_result();

                                if ($resultset && mysqli_num_rows($resultset) > 0):

                                    while ($pmrow = mysqli_fetch_assoc($resultset)): ?>
                                        <div class="row px-3 container-fluid payment-method-box my-1" paymentmethod="<?php echo $pmrow['type']?>" paymentid = "<?php echo $pmrow['paymentmethod_id']?>">
                                            <div class="col payment-method-logo py-4 px-3">
                                                <div class="img-pm-logo-box">
                                                    <img class="img-fluid" src="Images/ModePay/<?php echo $pmrow['type'] ?>.png"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col py-3 d-flex justify-content-start payment-title-box">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span
                                                            class="payment-method-title fw-bold col-12 lg-lt-space">....<?php echo substr($pmrow['card_number'], -4); ?>
                                                            <span
                                                                class="px-2 small-text lg-lt-space">(<?php echo $pmrow['type']; ?>)</span></span>
                                                    </div>
                                                    <div class="col-12">
                                                        <span class="subtitle"><?php echo $pmrow['card_name']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col d-flex justify-content-end checked-pm-box">
                                                <i class="fa-solid fa-circle-check checked-pm d-none"></i>
                                            </div>
                                        </div>
                                    <?php endwhile; else: ?>
                                    <div class="row container-fluid py-3">
                                        <div class="col-12 d-flex justify-content-center">
                                            <i class="fa-solid fa-link-slash"></i>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center py-1 mt-4">
                                            <span class="no-linked-text text-center">There are no currently linked payment
                                                methods</span>
                                        </div>
                                    </div>

                                <?php endif; ?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 px-lg-4 px-0  my-2">
                <div class="row bg-white div-container rounded">
                    <div class="col-12 py-3">
                        <span class="fw-bold sm-lt-space big-text">Your Order</span>
                    </div>
                    <hr>
                    <div class="col-12 py-0">
                        <?php
                        $checkoutItems = $_SESSION['checkout-items'];
                        $placeholders = implode(',', array_fill(0, count($checkoutItems), '?'));
                        $sql = "SELECT * FROM cart c JOIN products p ON c.product_id = p.product_id WHERE cart_id IN ($placeholders) AND c.user_id = ?";

                        $datatypes = str_repeat('i', count($checkoutItems)) . 'i';
                        $params = array_merge($checkoutItems, [$_SESSION['userid']]);

                        $stmt = mysqli_prepare($conn, $sql);
                        $stmt->bind_param($datatypes, ...$params);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $ind = 0;

                        $totalprice = 0;

                        while ($frow = mysqli_fetch_assoc($result)):


                            $image = json_decode($frow['product_images'], true);

                            $imglocation = 'admin/php-addons/productimages/' . $image[0];

                            if ($ind > 0):
                                ?>
                                <hr>
                            <?php endif; ?>

                            <div class="col-12 my-3 fetched-item" cartid = "<?php echo $frow['cart_id']; ?>">
                                <div class="row">
                                    <div class="col img-box">
                                        <img class="img-fluid" src="<?php echo $imglocation ?>" alt="" />
                                    </div>
                                    <div class="col item-details-box py-3">
                                        <div class="col-12 mb-2">
                                            <span class="item-name"><?php echo $frow['name']; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="item-qty">Quantity: <span
                                                    class="quantity-num"><?php echo $frow['quantity']; ?></span></span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <span
                                                class="item-price inter">₱<?php echo number_format($frow['total_price'], 2, '.', '') ?></span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php $totalprice += doubleval($frow['total_price']);
                            $ind++;
                        endwhile; ?>
                    </div>
                    &nbsp;
                    <hr>
                    <div class="col-12 py-3">
                        <div class="row d-flex justify-content-between">
                            <div class="col">
                                <span class="details-content">Delivery</span>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <span class="inter discount-price"><span class="free-delivery px-2">FREE DELIVERY</span>
                                    ₱<span id = "d-fee">0.00</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 py-3">
                        <div class="row d-flex justify-content-between">
                            <div class="col">
                                <div class="col-12">
                                    <span class="details-content">Discount</span>
                                </div>
                                <div class="col-12">
                                    <div class="select-voucher">
                                        <span id="select-voucher" class="" data-bs-toggle="modal"
                                            data-bs-target="#voucherModal">(Select
                                            Voucher)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <span class="inter discount-price"><span id="item-voucher-box-name"
                                        class="item-voucher px-2 d-none"></span> <span
                                        id="item-discount-text">₱0.00</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 py-3">
                        <div class="row d-flex justify-content-between">
                            <div class="col">
                                <span class="details-content">Subtotal</span>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <span class="inter ">₱<span
                                        id="subtotal"><?php echo number_format($totalprice, 2, '.', ''); ?></span></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 py-3 ">
                        <div class="row d-flex justify-content-between">
                            <div class="col">
                                <span class="fw-bold sm-lt-space big-text">Total</span>
                            </div>
                            <div class="row col d-flex justify-content-end">
                                <div class="col-12 d-flex justify-content-end"><span class="inter big-text">₱<span
                                            id="total"
                                            class="fw-bold lg-lt-space"><?php echo number_format($totalprice, 2, '.', ''); ?></span></span>
                                </div>
                                <div class="col-12 d-flex justify-content-end d-none" id="saved-box"><span
                                        class="small-text total-subtitle">Yay, you saved <span
                                            class="inter saved-price">₱<span id="saved-price"
                                                class="fw-bold sm-lt-space"><?php echo number_format($totalprice, 2, '.', ''); ?>
                                            </span><i class="fa-solid fa-money-bill"></i></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 py-2">
                        <button id = "proceeddelivery" class="btn btn-dark w-100 lg-lt-space py-2 fw-bold">Proceed to Delivery</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content px-3 py-3">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 md-lt-space fw-bold" id="voucherModalLabel">Select a Voucher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12" id="free-shipping-vouchers">
                        <div class="col-12">
                            <span class="md-lt-space fw-bold">Shipping Vouchers</span>
                        </div>
                        <div class="col-12">
                            <span class="subtitle">Available vouchers</span>
                        </div>
                        <div class="col-12 d-flex justify-content-center py-4 voucher-box">
                            <span class="subtitle">There are no currently available shipping vouchers.</span>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12" id="item-vouchers">
                        <div class="col-12">
                            <span class="md-lt-space fw-bold">Item Vouchers</span>
                        </div>
                        <div class="col-12">
                            <span class="subtitle">Available vouchers</span>
                        </div>
                        <div id="item-voucher-box" class="col-12 py-4 voucher-box px-2">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cancel-button" type="button" class="btn btn-outline-dark modal-button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button id="use-button" type="button" class="btn btn-dark modal-button" disabled>Use</button>
                </div>
            </div>
        </div>
    </div>

    <?php

    $getinfo = "SELECT * FROM users WHERE user_id = ?";

    $getstmt = mysqli_prepare($conn, $getinfo);
    $getstmt->bind_param("i", $_SESSION['userid']);
    $getstmt->execute();

    $getresult = $getstmt->get_result();

    if ($u_row = mysqli_fetch_assoc($getresult)):

        include 'userbox.php';
        ?>

    <?php endif; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>