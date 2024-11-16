<?php

    include '../connection.php';

    $quantity = htmlspecialchars($_POST['quantity']);
    $unitprice = htmlspecialchars($_POST['unitprice']);
    $cartid = htmlspecialchars($_POST['cartid']);

    $totalprice = floatval(number_format((floatval($quantity) * floatval($unitprice)), 2, '.', ''));

    $query = "UPDATE cart SET quantity = ?, total_price = ? WHERE cart_id = ?";

    $stmt = mysqli_prepare($conn, $query);
    $stmt -> bind_param("isi", $quantity, $totalprice, $cartid);
    $stmt -> execute();

    if ($stmt -> affected_rows > 0) {
        echo true;
    } else {
        echo mysqli_error($conn);
    }


?>