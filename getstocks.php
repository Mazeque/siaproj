<?php

include 'connection.php';


$id = $_POST['id'];

$getstocks = "SELECT * FROM products WHERE product_id = ?";

$getstmt = mysqli_prepare($conn, $getstocks);
$getstmt->bind_param("i", $id);
$getstmt->execute();

$gsresult = $getstmt->get_result();

if ($gsresult && mysqli_num_rows($gsresult) > 0) {
    $row = mysqli_fetch_assoc($gsresult);
    echo $row['stocks'];

    exit;   
} else {
    echo false;
}

?>