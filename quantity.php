<?php
include 'connection.php';

$method = $_POST['method'];

$response = array();

if ($method === 'ADD') {
    $quantity = $_POST['quantity'];
    $productid = $_POST['product_id'];
    $cartid = $_POST['cart_id'];

    $checkprod = "SELECT * FROM products WHERE product_id = ?";
    $cpstmt = mysqli_prepare($conn, $checkprod);
    $cpstmt->bind_param("i", $productid);
    $cpstmt->execute();

    $cpresult = $cpstmt->get_result();

    if ($cpresult && $cprow = mysqli_fetch_assoc($cpresult)) {
        if ($quantity <= $cprow['stocks']) {

            $total_price = $quantity * $cprow['price'];

            $uquery = "UPDATE cart SET quantity = ?, total_price = ? WHERE cart_id = ?";
            $ustmt = mysqli_prepare($conn, $uquery);
            $ustmt->bind_param("idi", $quantity,  $total_price, $cartid);
            if ($ustmt->execute()) {
         
                $response['status'] = 'success';
                $response['totalprice'] = $total_price;

                echo json_encode($response);
            } else {

                $response['status'] = 'failure';

                echo json_encode($response);
            }
            exit;
        }
        exit;
    }
} else if ($method === 'SUBTRACT') {
    $quantity = $_POST['quantity'];
    $productid = $_POST['product_id'];
    $cartid = $_POST['cart_id'];


    $checkprod = "SELECT * FROM products WHERE product_id = ?";
    $cpstmt = mysqli_prepare($conn, $checkprod);
    $cpstmt->bind_param("i", $productid);
    $cpstmt->execute();

    $cpresult = $cpstmt->get_result();

    if ($cpresult && $cprow = mysqli_fetch_assoc($cpresult)) {
        if ($quantity <= $cprow['stocks']) {

            $total_price = $quantity * $cprow['price'];

            $uquery = "UPDATE cart SET quantity = ?, total_price = ? WHERE cart_id = ?";
            $ustmt = mysqli_prepare($conn, $uquery);
            $ustmt->bind_param("idi", $quantity, $total_price, $cartid);
            if ($ustmt->execute()) {

                $response['status'] = 'success';
                $response['totalprice'] = $total_price;

                echo json_encode($response);
            } else {

                $response['status'] = 'failure';

                echo json_encode($response);
            }
            exit;
        }
        exit;
    }
} else if ($method === 'FIELD') {
    $quantity = $_POST['quantity'];
    $productid = $_POST['product_id'];
    $cartid = $_POST['cart_id'];


    $checkprod = "SELECT * FROM products WHERE product_id = ?";
    $cpstmt = mysqli_prepare($conn, $checkprod);
    $cpstmt->bind_param("i", $productid);
    $cpstmt->execute();

    $cpresult = $cpstmt->get_result();

    if ($cpresult && $cprow = mysqli_fetch_assoc($cpresult)) {
        if ($quantity <= $cprow['stocks']) {

            $total_price = $quantity * $cprow['price'];

            $uquery = "UPDATE cart SET quantity = ?, total_price = ? WHERE cart_id = ?";
            $ustmt = mysqli_prepare($conn, $uquery);
            $ustmt->bind_param("idi", $quantity, $total_price, $cartid);
            if ($ustmt->execute()) {

                $response['status'] = 'success';
                $response['totalprice'] = $total_price;

                echo json_encode($response);
            } else {

                $response['status'] = 'failure';

                echo json_encode($response);
            }
            exit;
        }
        exit;
    }
}
?>