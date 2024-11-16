<?php

    session_start();

    include '../connection.php';

    $paymentid = intval(htmlspecialchars($_POST['paymentid']));

    $paymentquery = "DELETE FROM paymentmethod WHERE paymentmethod_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $paymentquery);
    $stmt -> bind_param("ii", $paymentid, $_SESSION['userid']);
    $stmt -> execute();

    if ($stmt -> affected_rows > 0) {
        echo true;
    } else {
        echo false;
    }

    exit;

?>