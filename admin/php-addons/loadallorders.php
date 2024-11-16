<?php

include '../../connection.php';

$query = "SELECT p.order_id, p.payment_method, p.payment_status, p.delivery_id, p.user_id, p.order_status, p.order_creation_date, SUM(c.total_price) AS total_price, p.order_information FROM payment p JOIN cart c ON p.cart_id = c.cart_id GROUP BY p.order_id;";
$stmt = mysqli_prepare($conn, $query);
$stmt->execute();
$res = $stmt->get_result();

?>
<div class="row d-flex justify-content-center">
    <div class="col check-column">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    </div>
    <div class="col order-id-column">
        <span class="column-title">ORDER ID</span>
    </div>
    <div class="col customer-column d-none d-lg-block ">
        <span class="column-title">CUSTOMER</span>
    </div>
    <div class="col amount-column">
        <span class="column-title">AMOUNT</span>
    </div>
    <div class="col paid-by-column d-none d-lg-block">
        <span class="column-title">PAID BY</span>
    </div>
    <div class="col status-column">
        <span class="column-title">STATUS</span>
    </div>
    <div class="col order-date-column d-none d-lg-block">
        <span class="column-title">ORDER DATE</span>
    </div>
    <div class="col action-column">
        <span class="column-title">ACTION</span>
    </div>
</div>
<div class="col-12">
    <?php

    if (mysqli_num_rows($res) > 0):
        while ($currentrow = mysqli_fetch_assoc($res)):


            $orderinfo = json_decode($currentrow['order_information'], true);

            $name = $orderinfo['firstname'] . ' ' . $orderinfo['lastname'];

            $formattedDate = date("F j, Y, g:i a", strtotime($currentrow['order_creation_date']));

            ?>
            <div class="row d-flex justify-content-center mt-4">
                <div class="col check-column">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                </div>
                <div class="col order-id-column">
                    <span class="column-title"><?php echo $currentrow['order_id'] ?></span>
                </div>
                <div class="col customer-column d-none d-lg-block ">
                    <span class="column-title"><?php echo $name ?></span>
                </div>
                <div class="col amount-column">
                    <span class="column-title inter">₱<?php echo number_format($currentrow['total_price'], 2, '.', '') ?></span>
                </div>
                <div class="col paid-by-column d-none d-lg-block">
                    <span class="column-title"><?php echo $currentrow['payment_method'] ?></span>
                </div>
                <div class="col status-column">
                    <span
                        class="column-title <?php echo strtolower($currentrow['order_status']) ?>"><?php echo $currentrow['order_status'] ?></span>
                </div>
                <div class="col order-date-column d-none d-lg-block">
                    <span class="column-title"><?php echo $formattedDate ?></span>
                </div>
                <div class="col action-column">
                    <span class="column-title">ACTION</span>
                </div>
            </div>
        <?php endwhile; endif; ?>
</div>