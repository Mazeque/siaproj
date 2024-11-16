<?php
session_start();

include '../../connection.php';

$query = "SELECT p.order_id, p.payment_method, p.payment_status, p.delivery_id, p.user_id, p.order_status, p.order_creation_date, SUM(c.total_price) AS total_price, p.order_information FROM payment p JOIN cart c ON p.cart_id = c.cart_id GROUP BY p.order_id;";
$stmt = mysqli_prepare($conn, $query);
$stmt->execute();
$res = $stmt->get_result();

?>

<div class="col-12 pt-3">
    <div class="col-12 px-3 pb-2">
        <span class="user-main-title fw-bold">Order Management </span>
    </div>
    <hr>
    <div class="row px-4 pb-3 d-flex justify-content-center">
        <div class="col-12 orders-navigator">
            <div class="row d-flex justify-content-center">
                <div class="col py-4 d-flex justify-content-center section-nav" id = "1">
                    <span class="section-title text-center">All <br class="d-lg-none d-block">Orders &nbsp;<span
                            class="number-counter px-1" id="all-counter"><?php echo mysqli_num_rows($res)?></span></span>
                </div>
                <div class="col py-4 d-flex justify-content-center section-nav active-section" id = "2">
                    <span class="section-title text-center">Active <br class="d-lg-none d-block">Orders &nbsp;<span
                            class="number-counter px-1" id="active-counter">0</span></span>
                </div>
                <div class="col py-4 d-flex justify-content-center section-nav" id = "3">
                    <span class="section-title text-center">Successful <br class="d-lg-none d-block">Orders &nbsp;<span
                            class="number-counter px-1" id="successful-counter">0</span></span>
                </div>
                <div class="col py-4 d-flex justify-content-center section-nav" id = "4">
                    <span class="section-title text-center">Cancelled <br class="d-lg-none d-block">Orders &nbsp;<span
                            class="number-counter px-1" id="cancelled-counter">0</span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 order-content" id="order-content">
        <?php include 'loadallorders.php';?>
    </div>
</div>