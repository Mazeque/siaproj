<?php

session_start();

include '../connection.php';

if (isset($_SESSION['admin']['isLoggedIn']) && $_SESSION['admin']['isLoggedIn'] === true) {
    header('Location: home');
    exit;
}

$alertType = null;


if ((isset($_SESSION['admin-error-login']) && $_SESSION['admin-error-login'] !== null)) {
    echo $_SESSION['admin-error-login'];

    if (isset($_SESSION['admin-error-login']) && $_SESSION['admin-error-login'] !== null) {
        $alertType = $_SESSION['admin-error-login'];
    }
}


if (isset($_POST['submit'])) {

    $adminusername = htmlspecialchars($_POST['username']);
    $adminpassword = htmlspecialchars($_POST['password']);
    $usertype = htmlspecialchars("Admin");

    $fetchpass = "SELECT * FROM users WHERE username = ?";

    $fetchSTMT = mysqli_prepare($conn, $fetchpass);

    mysqli_stmt_bind_param($fetchSTMT, "s", $adminusername);
    mysqli_stmt_execute($fetchSTMT);

    $fetchResult = mysqli_stmt_get_result($fetchSTMT);

    if ($fetchResult && mysqli_num_rows($fetchResult) > 0) {
        $fetchRow = mysqli_fetch_assoc($fetchResult);

        if ($fetchRow['account_type'] === $usertype) {

            $adminhashedpass = htmlspecialchars($fetchRow['password']);

            if (password_verify($adminpassword, $adminhashedpass)) {
                $_SESSION['admin']['isLoggedIn'] = true;
                $_SESSION['admin']['hashed_id'] = $fetchRow['hashed_id'];
                $_SESSION['admin']['firstname'] = $fetchRow['firstname'];
                $_SESSION['admin']['middlename'] = $fetchRow['middlename'];
                $_SESSION['admin']['lastname'] = $fetchRow['lastname'];
                $_SESSION['admin']['id'] = $fetchRow['id'];
                $_SESSION['admin']['account_type'] = $fetchRow['account_type'];
                $_SESSION['admin']['username'] = $fetchRow['username'];

                header('Location: home');
            } else {
                // echo 'Incorrect password';
                $_SESSION['admin-error-login'] = 1;

                header('Location: login');
            }

        } else {
            // echo 'This is not an admin account!';
            $_SESSION['admin-error-login'] = 2;

            header('Location: login');
        }

    } else {
        // echo 'This account doent exist';
        $_SESSION['admin-error-login'] = 3;

        header('Location: login');
    }



}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Login | Liriko</title>
    <link rel="stylesheet" href="CSS/generalF7.css">
    <link rel="stylesheet" href="CSS/loginF2.css">
    <link rel="stylesheet" href="CSS/loader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="../Images/Icon/E.png" type="image/x-icon">
    <script src="JS/loginF1.js"></script>
</head>

<body class="bg-theme">
    <?php if ($alertType !== null): ?>
        <?php if ($alertType < 4): ?>
            <div class="d-flex justify-content-center position-absolute col-12 mt-4 pt-2 mb-">
                <div class="col-9">
                    <div class="alert alert-danger py-2 py-lg-2 px-2 px-lg-3" role="alert"
                        style="padding: 0; padding-left: 1.5%; padding-right: 1.5%; padding-top: 0.7%; padding-bottom: 0.7%; font-size: 13px;">
                        <span class="fw-bold">Error : </span>
                        <?php if ($alertType === 1): ?>
                            <span>The password you’ve entered is incorrect.</span>
                        <?php elseif ($alertType === 2): ?>
                            <span>The username you entered isn’t an admin account!</span>
                        <?php elseif ($alertType === 3): ?>
                            <span>The username you entered isn’t connected to an account.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="space my-5 my-lg-0 pt-1 pt-lg-0"></div>
            <?php $_SESSION['admin-error-login'] = null;
            unset($_SESSION['admin-error-login']); ?>
        <?php endif; ?>
    <?php endif; ?>
    <section class=" d-flex justify-content-center login-container">
        <div class="col-8 col-sm-6 col-md-6 col-lg-3 bg-light py-3 login-box mt-5 mt-lg-0">
            <div class="col-12 d-flex justify-content-start" style="height: 3%;">
                <div class="col-2 bg-dark"></div>
            </div>
            <div class="px-4">
                <form action="login" method="POST">
                    <div class="col-12 d-flex justify-content-center mt-4">
                        <img src="../Images/Logo/Edumart Black Logo.png" width="40%" alt="">
                    </div>
                    <div class="col-12 d-flex justify-content-center pt-3">
                        <span class="poppins fw-bold admin-title">ADMIN PORTAL</span>
                    </div>
                    <div class="col-12 d-flex justify-content-center pb-2">
                        <span class="poppins admin-subtitle">Sign into the account with admin privileges</span>
                    </div>
                    <hr class="divider">
                    <div class="col-12 py-1">
                        <label class="label-field px-2" for="Username">Username <span
                                class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control poppins"
                            placeholder="Username">
                    </div>
                    <div class="col-12 py-1">
                        <label class="label-field px-2" for="Password">Password <span
                                class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control poppins"
                            placeholder="Password">
                    </div>
                    <button onclick="login(event)" type="submit" id="login-button" name="submit"
                        class="btn btn-dark submit-button fw-bold d-flex justify-content-center" style="">Log
                        in</button>
                    <hr class="divider py-0 my-0 pb-3">
                </form>
            </div>
        </div>
    </section>
    <section>
        <div class="col-12 d-flex justify-content-center px-0">
            <div class="col-8 col-sm-6 col-md-6 col-lg-3 d-flex justify-content-center my-4 pt-2">
                <a href="../home" class="main-page-button"><button
                        class="btn btn-dark fw-bold poppins main-page-button">Go to Main
                        Page</button></a>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>