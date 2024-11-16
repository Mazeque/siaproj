<?php

session_start();

include '../connection.php';

$checkuser = "SELECT * FROM wallet WHERE user_id = ?";
$checkstmt = mysqli_prepare($conn, $checkuser);
$checkstmt->bind_param("i", $_SESSION['userid']);
$checkstmt->execute();

$checkres = $checkstmt->get_result();

if (mysqli_num_rows($checkres) > 0) {

} else {

    $balance = 0;

    $notmatched = true;
    $walletNumber = null;

    while ($notmatched) {
        $walletNumber = mt_rand(100000000000, 999999999999);

        $checkrandnumber = "SELECT * FROM wallet WHERE wallet_number = ?";
        $cstmt = mysqli_prepare($conn, $checkrandnumber);
        $cstmt->bind_param("s", $walletNumber);
        $cstmt->execute();
    
        $cres = $cstmt->get_result();

        if (!(mysqli_num_rows($cres) > 0)) {
            $notmatched = false;

            break;
        }
    }

    $insertwallet = "INSERT INTO wallet(user_id, balance, wallet_number) VALUES(?, ?, ?)";
    $istmt = mysqli_prepare($conn, $insertwallet);
    $istmt -> bind_param("ids", $_SESSION['userid'], $balance, $walletNumber);
    $istmt -> execute();

    if ($istmt -> affected_rows > 0) {
        echo true;
    }

}


?>