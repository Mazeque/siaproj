<?php

include 'connection.php';

$search = $_GET['search'];

$searchquery = "SELECT product_id, name FROM products WHERE name LIKE ? ORDER BY name DESC LIMIT 3";
$searchstmt = mysqli_prepare($conn, $searchquery);
$search_param = "%$search%";
mysqli_stmt_bind_param($searchstmt, "s", $search_param);
mysqli_stmt_execute($searchstmt);
$searchresult = mysqli_stmt_get_result($searchstmt);

$arrayitems = array();

while ($srow = mysqli_fetch_assoc($searchresult)) {
    $arrayitems[] = $srow;
}

echo json_encode($arrayitems);
?>
