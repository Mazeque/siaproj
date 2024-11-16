<?php

session_start();

include '../connection.php';


$firstname = htmlspecialchars($_POST['firstname']);
$lastname = htmlspecialchars($_POST['lastname']);
$address = htmlspecialchars($_POST['address']);
$regionstate = htmlspecialchars($_POST['regionstate']);
$country = htmlspecialchars($_POST['country']);
$postcode = htmlspecialchars($_POST['postcode']);
$contactnumber = htmlspecialchars($_POST['contactnumber']);
$note = htmlspecialchars($_POST['note']);
$selectedpm = htmlspecialchars($_POST['selectedpm']);
$mode = htmlspecialchars($_POST['mode']);
$dfee = htmlspecialchars($_POST['deliveryfee']);

$cartid = json_decode($_POST['cartid'], true);

$order_info = array();

$order_info['firstname'] = htmlspecialchars($_POST['firstname']);
$order_info['lastname'] = htmlspecialchars($_POST['lastname']);
$order_info['address'] = htmlspecialchars($_POST['address']);
$order_info['regionstate'] = htmlspecialchars($_POST['regionstate']);
$order_info['country'] = htmlspecialchars($_POST['country']);
$order_info['postcode'] = htmlspecialchars($_POST['postcode']);
$order_info['contactnumber'] = htmlspecialchars($_POST['contactnumber']);
$order_info['note'] = htmlspecialchars($_POST['note']);
$order_info['selectedpm'] = htmlspecialchars($_POST['selectedpm']);
$orderstatus = "Processing";


if ($mode == 1) {
    if (isset($_POST['selectedpmid'])) {
        $selectetpmid = htmlspecialchars($_POST['selectetpmid']);
        $order_info['selectetpmid'] = htmlspecialchars($_POST['selectetpmid']);
    }
}


// GET ORDER ID

$selecthighest = "SELECT * FROM payment WHERE order_id = (SELECT MAX(order_id) FROM payment);";
$selectstmt = mysqli_prepare($conn, $selecthighest);
$selectstmt->execute();
$selectresult = $selectstmt->get_result();


$orderid = 0;

if ($selectresult && mysqli_num_rows($selectresult) > 0) {
    $srow = mysqli_fetch_assoc($selectresult);

    $orderid = intval($srow['order_id']) + 1;
} else {
    $orderid = 1;
}


// GET DELIVERY ID

$deliveryid = 0;

$destination = $address . ', ' . $regionstate . ', ' . $country . ', ' . $postcode;

$insertdID = "INSERT INTO delivery(destination, delivery_fee) VALUES (?, ?)";
$insertdSTMT = mysqli_prepare($conn, $insertdID);
$insertdSTMT->bind_param("sd", $destination, $dfee);
$insertdSTMT->execute();

if ($insertdSTMT->affected_rows > 0) {
    $deliveryid = $insertdSTMT->insert_id;
}




if ($mode == 1) {

    $noerror = array();

    $fetchcart = "SELECT * FROM cart c JOIN products p ON c.product_id = p.product_id WHERE cart_id = ?";

    $finalized_order_info = json_encode($order_info);

    foreach ($cartid as $cid) {

        $fetchstmt = mysqli_prepare($conn, $fetchcart);
        $fetchstmt->bind_param("i", $cid);
        $fetchstmt->execute();
        $fetchresult = $fetchstmt->get_result();

        if ($fetchresult && mysqli_num_rows($fetchresult) > 0) {
            $cartrow = mysqli_fetch_assoc($fetchresult);

            $quantity = intval($cartrow['quantity']);
            $stocks = intval($cartrow['stocks']);

            $currentstocks = $stocks - $quantity;

            if ($currentstocks > 0) {

                $updateproductstocks = "UPDATE products SET stocks = ? WHERE product_id = ?";
                $updateprodstmt = mysqli_prepare($conn, $updateproductstocks);
                $updateprodstmt->bind_param("ii", $currentstocks, $cartrow['product_id']);

                $updateprodstmt->execute();

                if ($updateprodstmt->affected_rows > 0) {

                    $payment_status = "Unpaid";
                    if ($selectedpm != 'Cash On Delivery') {
                        $payment_status = "Paid";
                    }

                    $insert_query = "INSERT INTO payment(cart_id, payment_method, payment_status, delivery_id, user_id, order_id, order_status, order_information) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                    $insert_stmt = mysqli_prepare($conn, $insert_query);
                    $insert_stmt->bind_param("issiiiss", $cid, $selectedpm, $payment_status, $deliveryid, $_SESSION['userid'], $orderid, $orderstatus, $finalized_order_info);
                    $insert_stmt->execute();


                    if ($insert_stmt->affected_rows > 0) {

                        $updatecart = "UPDATE cart SET status = true WHERE cart_id = ?";
                        $updatestmt = mysqli_prepare($conn, $updatecart);
                        $updatestmt->bind_param("i", $cid);
                        $updatestmt->execute();

                        if ($updatestmt->affected_rows > 0) {


                        } else {
                            $noerror[] = false;
                        }

                    } else {
                        echo mysqli_error($conn);
                    }



                }



            } else {


                echo 'Stocks not enough';
            }



        }



    }

    $allow = true;

    foreach ($noerror as $error) {
        if ($error == false) {
            $allow = false;

            break;
        }
    }

    unset($_SESSION['checkout-id']);
    unset($_SESSION['checkout-pass']);
    unset($_SESSION['checkout-items']);

    echo $allow;

    exit;


} else if ($mode == 2) {

    $noerror = array();

    $fetchcart = "SELECT * FROM cart c JOIN products p ON c.product_id = p.product_id WHERE cart_id = ?";

    $finalized_order_info = json_encode($order_info);

    foreach ($cartid as $cid) {

        $fetchstmt = mysqli_prepare($conn, $fetchcart);
        $fetchstmt->bind_param("i", $cid);
        $fetchstmt->execute();
        $fetchresult = $fetchstmt->get_result();

        if ($fetchresult && mysqli_num_rows($fetchresult) > 0) {
            $cartrow = mysqli_fetch_assoc($fetchresult);

            $quantity = intval($cartrow['quantity']);
            $stocks = intval($cartrow['stocks']);

            $currentstocks = $stocks - $quantity;

            if ($currentstocks >= 0) {

                $updateproductstocks = "UPDATE products SET stocks = ? WHERE product_id = ?";
                $updateprodstmt = mysqli_prepare($conn, $updateproductstocks);
                $updateprodstmt->bind_param("ii", $currentstocks, $cartrow['product_id']);

                $updateprodstmt->execute();

                if ($updateprodstmt->affected_rows > 0) {

                    $payment_status = $selectedpm != "Cash On Delivery" ? "Paid" : "Unpaid";

                    $insert_query = "INSERT INTO payment(cart_id, payment_method, payment_status, delivery_id, user_id, order_id, order_status, order_information) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                    $insert_stmt = mysqli_prepare($conn, $insert_query);
                    $insert_stmt->bind_param("issiiiss", $cid, $selectedpm, $payment_status, $deliveryid, $_SESSION['userid'], $orderid, $orderstatus, $finalized_order_info);
                    $insert_stmt->execute();


                    if ($insert_stmt->affected_rows > 0) {

                        $updatecart = "UPDATE cart SET status = true WHERE cart_id = ?";
                        $updatestmt = mysqli_prepare($conn, $updatecart);
                        $updatestmt->bind_param("i", $cid);
                        $updatestmt->execute();

                        if ($updatestmt->affected_rows > 0) {


                        } else {
                            $noerror[] = false;
                        }

                    } else {
                        echo mysqli_error($conn);
                    }



                }



            } else {
                echo 'Stocks not enough';
            }

        }



    }

    $allow = true;

    foreach ($noerror as $error) {
        if ($error == false) {
            $allow = false;

            break;
        }
    }

    unset($_SESSION['checkout-id']);
    unset($_SESSION['checkout-pass']);
    unset($_SESSION['checkout-items']);

    echo $allow;

    exit;
}



?>