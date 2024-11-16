<?php


    include 'connection.php';

    $cart_id = $_POST['cartid'];
    $newqty = $_POST['newqty'];
    $unitprice = $_POST['unitprice'];
    $totalprice = $newqty * $unitprice;
    
    $updateqty = "UPDATE cart SET quantity = ?, total_price = ? WHERE cart_id = ?";
    $updatestmt = mysqli_prepare($conn, $updateqty);
    $updatestmt->bind_param("idi", $newqty, $totalprice, $cart_id);
    $updatestmt->execute();

    $getrow = "SELECT * FROM cart WHERE cart_id = ?";
    $getrowstmt = mysqli_prepare($conn, $getrow);
    $getrowstmt->bind_param("i", $cart_id);
    $getrowstmt->execute();
    $result = $getrowstmt->get_result();
    $updatedRow = $result->fetch_assoc();
    
    if ($updatestmt->affected_rows > 0) {
        echo json_encode($updatedRow);
    } else {
        echo "Update failed.";
    }



?>