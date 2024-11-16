<?php

    include 'connection.php';

    $d_cart_id = $_POST['cartid'];

    $d_query = "DELETE FROM cart WHERE cart_id = ?";
    $d_stmt = mysqli_prepare($conn, $d_query);

    if ($d_stmt) {
        mysqli_stmt_bind_param($d_stmt, "i", $d_cart_id);
        mysqli_stmt_execute($d_stmt);

        if (mysqli_stmt_affected_rows($d_stmt) > 0) {
            echo 'Deleted';
        } else {
            echo 'Failed';
        }

        mysqli_stmt_close($d_stmt);
    } else {
        echo 'Statement preparation failed.';
    }

    mysqli_close($conn);

?>