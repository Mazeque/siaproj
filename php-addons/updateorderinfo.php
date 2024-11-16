<?php

    session_start();

    include '../connection.php';

    $orderid = $_POST['orderid'];

    $updateord = "UPDATE payment SET order_status = 'Delivered' WHERE order_id = ? AND user_id = ?";
    $updatestmt = mysqli_prepare($conn, $updateord);
    $updatestmt -> bind_param("ii", $orderid, $_SESSION['userid']);
    $updatestmt -> execute();

    if ($updatestmt->affected_rows > 0) {
        echo true;
    } else {
        echo false;
    }


?>