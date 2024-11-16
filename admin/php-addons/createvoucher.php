<?php

include '../../connection.php';

$name = $_POST['name'];
$description = $_POST['description'];
$selectedtype = $_POST['selectedtype'];
$price = $_POST['price'];
$totalallow = $_POST['totalallow'];
$minprice = $_POST['minprice'];
$capprice = $_POST['capprice'];
$expiration = $_POST['expiration'];

$query = "INSERT INTO voucher (type, name, description, price, minimum_amount, price_cap, total_allowable_claim, expiration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param("issdddis", $selectedtype, $name, $description, $price, $minprice, $capprice, $totalallow, $expiration);

if ($stmt->execute()) {
    echo true;
    exit;
} else {
    echo false;
}

$stmt->close();
$conn->close();
?>