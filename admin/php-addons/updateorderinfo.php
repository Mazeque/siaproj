<?php

    include '../../connection.php';

    $orderid = $_POST['orderid'];

    $updateord = "UPDATE payment SET order_status = 'On-delivery' WHERE order_id = ?";
    $updatestmt = mysqli_prepare($conn, $updateord);
    $updatestmt -> bind_param("i", $orderid);
    $updatestmt -> execute();

    if ($updatestmt->affected_rows > 0) {
        echo true;
    } else {
        echo false;
    }


?>