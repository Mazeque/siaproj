<?php

    session_start();

    include '../connection.php';

    $title = $_POST['title'];
    $message = $_POST['review'];
    $ratings = $_POST['rating'];
    $productid = $_POST['productid'];
    $userid = $_SESSION['userid'];
    $orderid = $_POST['orderid'];
    
    $query = "INSERT INTO reviews(title, message, ratings, product_id, user_id, order_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    $stmt -> bind_param("ssiiii", $title, $message, $ratings, $productid, $userid, $orderid);
    $stmt -> execute();

    if ($stmt -> affected_rows > 0) {
        echo true;
    } else {
        echo $title . ' - ' . $message . ' - ' . $ratings . ' - ' . $productid . ' - ' . $userid . ' - ' . $orderid;
    }

?>