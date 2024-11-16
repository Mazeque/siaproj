<?php
include '../../connection.php';

$section = $_POST['productsec'];

$getsubcategory = "SELECT COUNT(*) FROM products WHERE category = ?";

$getsubcategorystmt = mysqli_prepare($conn, $getsubcategory);

mysqli_stmt_bind_param($getsubcategorystmt, "s", $section);

mysqli_stmt_execute($getsubcategorystmt);

$getresult = mysqli_stmt_get_result($getsubcategorystmt);

$count = mysqli_fetch_row($getresult)[0];

echo $count;
?>