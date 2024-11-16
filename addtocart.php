<?php
include 'connection.php';

$c_user_id = $_POST['userid'];
$c_prod_id = $_POST['productid'];

$check_query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ? AND status = 0";
$check_stmt = mysqli_prepare($conn, $check_query);
$check_stmt->bind_param("ii",$c_user_id, $c_prod_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    echo "The product already exists in the cart for the user.";
} else {

    
    $c_quantity = 1;
    $c_unit_price = $_POST['unitprice'];

    $insert_query = "INSERT INTO cart(user_id, product_id, quantity, total_price) VALUES(?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    $insert_stmt->bind_param("iiid", $c_user_id, $c_prod_id, $c_quantity, $c_unit_price);

    if ($insert_stmt->execute()) {
        echo "New row inserted into the cart.";
    } else {
        echo "Error inserting row into the cart: " . $insert_stmt->error;
    }
}

$check_stmt->close();
$insert_stmt->close();
$conn->close();
?>