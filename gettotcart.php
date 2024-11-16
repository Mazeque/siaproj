<?php

    include 'connection.php';

    $cartuid = $_POST['userid'];

    $countcart = "SELECT * FROM cart WHERE user_id = ? AND status = 0";
    $countstmt = mysqli_prepare($conn, $countcart);
    $countstmt -> bind_param("i", $cartuid);
    $countstmt -> execute();

    $countres = $countstmt->get_result();

    if ($countres) {
        $countrow = mysqli_num_rows($countres);

        echo $countrow;

    }

    exit;


?>