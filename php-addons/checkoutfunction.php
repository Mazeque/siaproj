<?php

    session_start();

    include '../connection.php';

    $quantity = htmlspecialchars($_POST['quantity']);
    $prodid = htmlspecialchars($_POST['prodid']);
    $userid = $_SESSION['userid'];
    $prodprice = htmlspecialchars($_POST['prodprice']);

    $totalprice = intval($quantity) * floatval($prodprice);
    $status = 0;

    $query = "SELECT * FROM cart WHERE product_id = ? AND user_id = ? AND status = 0";
    $stmt = mysqli_prepare($conn, $query);
    $stmt -> bind_param("ii", $prodid, $userid);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if (!(mysqli_num_rows($result) > 0)) {
        
        $insertcart = "INSERT INTO cart(user_id, product_id, quantity, total_price, status) VALUES (?, ?, ?, ?, ?)";
        $insertSTMT = mysqli_prepare($conn, $insertcart);
        $insertSTMT -> bind_param("iiidi", $userid, $prodid, $quantity, $totalprice, $status);
        $insertSTMT -> execute();

        if ($insertSTMT -> affected_rows > 0) {
            echo mysqli_insert_id($conn);
        } else {
            echo 'False: ' . $userid . ' - ' . $prodid . ' - ' . $quantity . ' - ' . $totalprice . ' - ' . $status;
        }

    } else {
        
    }

?>