<?php

session_start();

include 'connection.php';

if (!isset($_POST['items'])) {
    exit;
}

$checkcart = "SELECT * FROM cart WHERE user_id = ? AND status = 0";

$checkstmt = mysqli_prepare($conn, $checkcart);
$checkstmt->bind_param("i", $_SESSION['userid']);
$checkstmt->execute();
$checkres = $checkstmt->get_result();


$checkoutarr = array();

if ($checkres && mysqli_num_rows($checkres) > 0) {
    $_SESSION['checkout-pass'] = true;
    $_SESSION['checkout-id'] = uniqid();
    $_SESSION['checkout-items'] = $_POST['items'];

    $checkoutarr['pass'] = true;
    $checkoutarr['id'] = $_SESSION['checkout-id'];

    echo json_encode($checkoutarr);
}
?>