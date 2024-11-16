<?php

    session_start();

    unset($_SESSION['admin']['isLoggedIn']);
    unset($_SESSION['admin']['isLoggedIn']);
    unset($_SESSION['admin']['hashed_id']);
    unset($_SESSION['admin']['firstname']);
    unset($_SESSION['admin']['middlename']);
    unset($_SESSION['admin']['lastname']);
    unset($_SESSION['admin']['id']);
    unset($_SESSION['admin']['account_type']);
    unset($_SESSION['admin']['username']);

    unset($_POST['logout']);

    print($_SESSION);

    header('Location: home');

?>