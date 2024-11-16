<?php

session_start();



include '../connection.php';


if (isset($_SESSION['admin']['isLoggedIn']) && $_SESSION['admin']['isLoggedIn'] === true) {

} else {
    header('Location: login');
    exit;
}

$panel = 'Dashboard';

if (isset($_POST['logout'])) {

    unset($_SESSION['admin']['isLoggedIn']);
    unset($_SESSION['admin']['hashed_id']);
    unset($_SESSION['admin']['firstname']);
    unset($_SESSION['admin']['middlename']);
    unset($_SESSION['admin']['lastname']);
    unset($_SESSION['admin']['id']);
    unset($_SESSION['admin']['account_type']);
    unset($_SESSION['admin']['username']);

    unset($_POST['logout']);

    header('Location: home');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Home | Edumart
    </title>
    <link rel="stylesheet" href="CSS/generalF7.css">
    <link rel="stylesheet" href="CSS/loginF2.css">
    <link rel="stylesheet" href="CSS/homeF12.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="../Images/Icon/E.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script defer src="JS/homeF17.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <link rel="stylesheet" href="CSS/dashboardF1.css">
    <link rel="stylesheet" href="CSS/usersF1.css">
    <link rel="stylesheet" href="CSS/productsF19.css">
    <link rel="stylesheet" href="CSS/ordersF8.css">
    <link rel="stylesheet" href="CSS/vouchersF1.css">
    <link rel="stylesheet" href="CSS/alert.css">
</head>

<body class="bg-theme poppins white-text">
    <header class="fixed-tops">
        <nav class="navbar navbar-expand-lg theme-color">
            <div class="container-fluid">
                <div class="col-6 px-4 d-flex align-items-center">
                    <a class="navbar-brand" href="#"><img src="../Images/Logo/E.png" width="130px"
                            alt="" srcset=""></a>
                    <div class="d-none d-lg-block ml-2">
                        <span class="admin-panel">
                            <?php echo strtoupper($_SESSION['admin']['account_type']) ?> PANEL
                        </span>
                    </div>
                </div>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="text-light">☰</span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-lg-none">
                        <li class="nav-item">
                            <div class="col-12 px-3 py-2 menu-item menu-item-active " id="dashboard"
                                category="dashboard-sm">
                                <div class="row">
                                    <div class="col">
                                        <span class="menu-item-text"><i class="fa-solid fa-gauge-high"></i>
                                            &nbsp;Dashboard</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="col-12 px-3 py-2 menu-item mt-2" category="users-sm" id="users">
                                <div class="row">
                                    <div class="col">
                                        <span class="menu-item-text"><i class="fa-solid fa-users"></i>
                                            &nbsp;Users</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="col-12 px-3 py-2 menu-item mt-2" category="products-sm" id="products">
                                <div class="row">
                                    <div class="col">
                                        <span class="menu-item-text"><i class="fa-solid fa-box-open"></i>
                                            &nbsp;Products</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="col-12 px-3 py-2 menu-item mt-2" category="orders-sm" id="orders">
                                <div class="row">
                                    <div class="col">
                                        <span class="menu-item-text"><i class="fa-solid fa-list"></i>
                                            &nbsp;Orders</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="col-12 px-3 py-2 menu-item mt-2" category="vouchers-sm" id="vouchers">
                                <div class="row">
                                    <div class="col">
                                        <span class="menu-item-text"><i class="fa-solid fa-ticket"></i>
                                            &nbsp;Vouchers</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container-fluid content d-flex justify-content-center ">
        <div class="row row-content d-flex justify-content-center pt-3 mx-3">
            <div class="col-lg-2 d-none d-lg-block left-panel rounded py-3 px-3">
                <div class="profile-container">
                    <div class="row">
                        <div class="col-4 img-container">
                            <img src="../Images/Admin/default-img-trans.png" class="avatar-size img-fluid" alt="">
                        </div>
                        <div class="col-6 d-flex justify-content-start px-0 py-1">
                            <div class="col-12">
                                <span class="account-name">
                                    <?php echo $_SESSION['admin']['firstname'] ?> <?php echo $_SESSION['admin']['lastname'] ?> 
                                    <br>
                                </span>
                                <span class="account-type">
                                    <?php echo $_SESSION['admin']['account_type'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-1 d-flex justify-content-center ">
                            <div class="col-12 d-flex justify-content-center three-dots">

                                <div class="dropdown">
                                    <span class="three-dots-selector " data-bs-toggle="dropdown">
                                        ⋮
                                    </span>
                                    <ul class="dropdown-menu bg-dark text-light">
                                        <form action="home" method="POST">
                                            <li><span class="dropdown-item text-light" type="submit" name="settings"><i
                                                        class="fa-solid fa-gear"></i> &nbsp;Settings</span></li>
                                            <li><button type="submit" name="logout" class="dropdown-item text-light"><i
                                                        class="fa-solid fa-power-off"></i> &nbsp;Logout</button></li>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12 mb-3">
                    <span class="tools-text">Menu</span>
                </div>
                <div class="col-12 px-3 py-2 menu-item menu-item-active " category="dashboard">
                    <div class="row">
                        <div class="col">
                            <span class="menu-item-text"><i class="fa-solid fa-gauge-high"></i> &nbsp;Dashboard</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-3 py-2 menu-item mt-2" category="users">
                    <div class="row">
                        <div class="col">
                            <span class="menu-item-text"><i class="fa-solid fa-users"></i> &nbsp;Users</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-3 py-2 menu-item mt-2" category="products">
                    <div class="row">
                        <div class="col">
                            <span class="menu-item-text"><i class="fa-solid fa-box-open"></i> &nbsp;Products</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-3 py-2 menu-item mt-2" category="orders">
                    <div class="row">
                        <div class="col">
                            <span class="menu-item-text"><i class="fa-solid fa-list"></i> &nbsp;Orders</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-3 py-2 menu-item mt-2" category="vouchers">
                    <div class="row">
                        <div class="col">
                            <span class="menu-item-text"><i class="fa-solid fa-ticket"></i> &nbsp;Vouchers</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-10 d-flex justify-content-end px-lg-4 px-0">
                <div class="col-12 right-panel rounded px-3  py-1" id="content-panel">
                    &nbsp;

                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>


</body>

</html>