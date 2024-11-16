<?php 

    session_start();

    include '../connection.php';

    $query = "UPDATE payment SET order_status = 'Cancelled' WHERE order_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    $stmt -> bind_param('ii', $_POST['orderid'], $_SESSION['userid']);
    $stmt -> execute();

    if ($stmt -> affected_rows > 0) {
        echo true;
    } else {
        echo false;
    }


?>