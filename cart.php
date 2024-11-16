<?php

session_start();


include 'connection.php';

if (!isset($_SESSION['isLoggedIn']['status'])) {

    header("Location: home");

    exit;


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out | </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="Images/Icon/E.png" type="image/x-icon">

    <link rel="stylesheet" href="CSS/styleF1.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="CSS/general.css">

    <link rel="stylesheet" href="CSS/cartF8.css">
    <script defer src="JS/cartF3.js"></script>

    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']['status'] === true): ?>

    <?php else: ?>

    <?php endif; ?>
    <script src="JS/hint-searchF1.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body style="font-family: Poppins">
    <header class="header">
        <div class="position-absolute container-fluid " style="margin: 0; padding: 0">
            <nav class="navbar navbar-expand-lg bg-light px-lg-5 px-3 d-flex justify-content-center">
                <div class="container-fluid py-2 position-relative" id="navbar-head">
                    <button class="navbar-toggler left-head" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="home">
                        <img src="Images/Logo/Edumart Black Logo.png" width="130px" alt="">
                    </a>
                    <div class="d-block right-head order-lg-2 px-2">
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
                                    <a class="nav-link " href="products" style="font-size: 14px;">Shop</a>
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
                <h1 class="fw-bold head-title">Cart</h1>
            </div>
            <div class="col-12 d-flex justify-content-center text-center">
                <h1 class="subtitle">Customize your current shopping cart items</h1>
            </div>
        </div>
    </section>
    <div class="col-12 d-flex justify-content-center mt-5  px-4 px-lg-0">
        <div class="col-12 col-lg-9">
            <div class="col-12 cart-container-box px-4 py-3">
                <div class="form-check">
                    <input class="form-check-input main-select-button" type="checkbox" value="" id="select-all-button">
                    <label class="form-check-label select-all" for="flexCheckDefault">
                        Select all
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 d-flex justify-content-center mt-5  px-4 px-lg-0">
        <div class="col-12 col-lg-9 content-box">
            <div class="col-12 cart-container-box px-4 py-5">

                <div class="col-12 px-3">
                    <span class="subtitle">Summary of your cart contents:</span>
                </div>
                <hr>
                <?php

                $getcart = "SELECT * FROM cart c JOIN products p ON c.product_id = p.product_id WHERE user_id = ? AND status = 0";

                $getstmt = mysqli_prepare($conn, $getcart);
                $getstmt->bind_param("i", $_SESSION['userid']);
                $getstmt->execute();
                $getresult = $getstmt->get_result();
                $ind = 0;

                if (mysqli_num_rows($getresult) > 0):
                    while ($crow = mysqli_fetch_assoc($getresult)):

                        $image = json_decode($crow['product_images'], true);

                        $imglocation = 'admin/php-addons/productimages/' . $image[0];


                        ?>

                        <div class="col-12 py-3 box-for-<?php echo $crow['cart_id'] ?> item-box">
                            <div class="row col-12">
                                <div class="col check-item-box">
                                    <div class="col-12 d-flex justify-content-centers">
                                        <input class="form-check-input check-item" type="checkbox"
                                            value="<?php echo $crow['cart_id'] ?>">
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center justify-content-lg-start">
                                    <div class="row col-12">
                                        <div class="col-12 col-lg">
                                            <div class="row">
                                                <div class="col img-box">
                                                    <img class="img-fluid" src="<?php echo $imglocation ?>" alt="" />
                                                </div>
                                                <div class="col">
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <span class="item-name"><?php echo $crow['name'] ?></span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="item-subtitle"><span class="inter">₱<span
                                                                        unitpriceof="<?php echo $crow['cart_id'] ?>"><?php echo number_format($crow['price'], 2, '.', '') ?></span></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg d-flex justify-content-center mt-2 mt-lg-0">
                                            <div class="row col-12">
                                                <div class="col-12 col-lg-10">
                                                    <div class="row h-100 px-0">
                                                        <div class="col-lg-6 my-3 my-lg-0 main-qty-box">
                                                            <div class="row col-12 qty-box">
                                                                <div class="qty-field-box row p-0 m-0">
                                                                    <div class="col qty-btn add-btn"
                                                                        fieldid="<?php echo $crow['cart_id'] ?>">
                                                                        <i class="fa-solid fa-plus"></i>
                                                                    </div>
                                                                    <div class="col qty-field px-0">
                                                                        <input type="text"
                                                                            class="quantity-field h-100 m-0 p-0 inter"
                                                                            fieldid="<?php echo $crow['cart_id'] ?>"
                                                                            value="<?php echo $crow['quantity'] ?>">
                                                                    </div>
                                                                    <div class="col qty-btn sub-btn"
                                                                        fieldid="<?php echo $crow['cart_id'] ?>">
                                                                        <i class="fa-solid fa-minus"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 d-flex justify-content-center mt-2">
                                                                    <span class="item-subtitle">Stock(s): <span
                                                                            stocksid="<?php echo $crow['cart_id'] ?>"><?php echo $crow['stocks'] ?></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 total-price-box my-3 mb-4 mb-lg-0 my-lg-0 ">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-12 d-flex justify-content-center">
                                                                    <span class="item-subtitle">Total Item Price</span>
                                                                </div>
                                                                <div class="col-12 d-flex justify-content-center">
                                                                    <span class="inter total-item-price">₱<span
                                                                            class="total-price-span"
                                                                            totalpriceof="<?php echo $crow['cart_id'] ?>"><?php echo number_format((floatval($crow['price']) * intval($crow['quantity'])), 2, '.', '') ?></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="col-12 h-100 main-remove-box">
                                                        <div class="remove-box col-12 col-lg-1">
                                                            <button class="btn btn-outline-danger w-100 btn-remove"
                                                                removeid="<?php echo $crow['cart_id'] ?>"><i
                                                                    class="fa-solid fa-trash-can"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($ind < mysqli_num_rows($getresult)): ?>
                                <hr class = "mt-5">
                            <?php endif; ?>
                        </div>

                        <?php $ind++; endwhile; else: ?>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="col-12 add-to-cart-box d-flex justify-content-center">
        <div class="col-12 col-lg-9 checkout-box px-lg-5 px-3 py-4" id="checkout-box">
            <div class="row">
                <div class="col d-flex justify-content-start">
                    <div class="row">
                        <div class="col-12">
                            <span class="total-price-text">₱<span id="total-price">0.00</span></span>
                        </div>
                        <div class="col-12">
                            <span class="total-price-subtitle">
                                Total price to pay
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-end checkout-btn-box">
                    <button id="checkout" class="btn btn-outline-dark px-5 checkout-btn">Checkout</button>
                </div>
            </div>
            <hr class="mb-2">
            <div class="col-12 px-2">
                <span class="item-selected-counter"><span id="item-counter">0</span> selected item(s)</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>