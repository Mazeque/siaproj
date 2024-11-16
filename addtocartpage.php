<?php
include 'connection.php';

$c_user_id = $_POST['userid'];
$c_prod_id = $_POST['productid'];

$check_query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ? AND status = 0";
$check_stmt = mysqli_prepare($conn, $check_query);
$check_stmt->bind_param("ii", $c_user_id, $c_prod_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {

    $crow = mysqli_fetch_assoc($result);


    $paul = array();

    $paul['cartid'] = $crow['cart_id'];
    $paul['quantity'] = $crow['quantity'];

    echo json_encode($paul);
} else {

    $c_quantity = $_POST['quantity'];
    $c_unit_price = $_POST['unitprice'];
    $c_total_price = $c_quantity * $c_unit_price; 

    $insert_query = "INSERT INTO cart(user_id, product_id, quantity, total_price) VALUES(?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    $insert_stmt->bind_param("iiid", $c_user_id, $c_prod_id, $c_quantity, $c_total_price);

    if ($insert_stmt->execute()) {
        echo "Success";
    } else {
        echo "Failed";
    }
}

$check_stmt->close();
$conn->close();
?>