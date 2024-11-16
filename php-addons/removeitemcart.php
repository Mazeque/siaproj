<?php

    session_start();

    include '../connection.php';

    $cartid = $_POST['cartid'];

    $query = "DELETE FROM cart WHERE cart_id = ? AND user_id = ? AND status = 0";

    $stmt = mysqli_prepare($conn, $query);
    $stmt -> bind_param("ii", $cartid, $_SESSION['userid']);
    $stmt -> execute();

    if ($stmt -> affected_rows > 0) {
        echo true;
    } else {
        echo false;
    }

?>