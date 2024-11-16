<?php
session_start();

include '../connection.php';

$cardtype = $_POST['type'];
$cardname = $_POST['cardname'];
$cardnumber = $_POST['cardnumber'];
$cardexpiry = $_POST['cardexpiry'];
$cardcvv = $_POST['cardcvv'];

$insertcard = "INSERT INTO paymentmethod(type, card_name, card_number, expiration, cvv, user_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $insertcard);
$stmt->bind_param("sssssi", $cardtype, $cardname, $cardnumber, $cardexpiry, $cardcvv, $_SESSION['userid']);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo 1;
} else {
    echo mysqli_error($conn);
}

$stmt->close();
$conn->close();
?>