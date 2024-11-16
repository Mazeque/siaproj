<?php
session_start();

include '../../connection.php';

$query = "SELECT p.order_id, p.payment_method, p.payment_status, p.delivery_id, p.user_id, p.order_status, p.order_creation_date, SUM(c.total_price) 
AS total_price, p.order_information FROM payment p JOIN cart c ON p.cart_id = c.cart_id WHERE p.order_status = ? GROUP BY p.order_id;";

$orderstatus = "Delivered";

$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param("s", $orderstatus);
$stmt->execute();

$res = $stmt->get_result();

?>
<?php if (mysqli_num_rows($res) > 0):
    while ($row = mysqli_fetch_assoc($res)):

        $orderinfo = json_decode($row['order_information'], true);

        $name = $orderinfo['firstname'] . ' ' . $orderinfo['lastname'];

        $formattedDate = date("F j, Y, g:i a", strtotime($row['order_creation_date']));

        ?>

        <div class="col-12 order-cont p-3 mt-4">
            <div class="row px-3 mt-2">
                <div class="col-12 col-lg-9 left-panel">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col order-id-details p-0">
                                    <span class="order-id">Order ID: #<?php echo $row['order_id']; ?></span>
                                </div>
                                <div class="col order-status-details p-0">
                                    <span
                                        class="order-status <?php echo strtolower($row['order_status']); ?>"><?php echo $row['order_status']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <div class="row">
                                <div class="col-12 p-0">
                                    <span class="date-created-title">Placed on: <span
                                            class="date-created"><?php echo $formattedDate ?></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 rigt-panel my-2 my-lg-0 mt-4 mt-lg-0">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-lg-end justify-content-center p-0">
                            <span class="inter order-price">₱<?php echo $row['total_price'] ?></span>
                        </div>
                        <div class="col-12 d-flex justify-content-lg-end justify-content-center p-0">
                            <span class="order-total-price">Total Price</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="col-12">
                <span class="list-title">List of product(s) in this order: </span>
            </div>
            <div class="col-12 my-3">
                <?php

                $order = "SELECT p.payment_id, p.order_id, p.delivery_id, p.user_id, p.order_status, p.order_creation_date, c.total_price AS item_cart_price, c.product_id, c.quantity, pr.name, pr.product_images 
                FROM payment p JOIN cart c ON p.cart_id = c.cart_id JOIN products pr ON pr.product_id = c.product_id WHERE p.order_id = ?;";

                $ostmt = mysqli_prepare($conn, $order);
                $ostmt->bind_param("i", $row['order_id']);
                $ostmt->execute();

                $ores = $ostmt->get_result();
                $i = 1;
                while ($orderrow = mysqli_fetch_assoc($ores)):

                    $bg;

                    if ($i % 2 == 0) {
                        $bg = "even";
                    } else {
                        $bg = "odd";
                    }


                    $imagearray = json_decode($orderrow['product_images'], true);
                    $imagename = $imagearray[0];

                    ?>

                    <div class="col-12 p-3 my-2 rounded <?php echo $bg; ?> d-flex justify-content-center">
                        <div class="row w-100 d-flex justify-content-center">
                            <div class="col-lg-9 col-12 row px-0">
                                <div class="col order-img-col">
                                    <div class="order-img">
                                        <img class="img-fluid" src="php-addons/productimages/<?php echo $imagename; ?>"
                                            alt="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row py-1">
                                        <div class="col-12 px-0">
                                            <span class="product-name text-center"><?php echo $orderrow['name']; ?></span>
                                        </div>
                                        <div class="col-12 px-0 mt-2">
                                            <span class="product-qty">Quantity: <?php echo $orderrow['quantity'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12 center-all mt-4 mt-lg-0">
                                <div class="col-12 d-flex justify-content-lg-end justify-content-center row">
                                    <div class="row d-flex justify-content-lg-end col-12 px-0">
                                        <div class="col-12 d-flex justify-content-lg-end justify-content-center">
                                            <span class="inter order-price">₱<?php echo $orderrow['item_cart_price'] ?></span>
                                        </div>
                                        <div class="col-12 d-flex justify-content-lg-end justify-content-center">
                                            <span class="order-total-price">Item Price</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; endwhile; ?>
            </div>
        </div>

    <?php endwhile;
endif; ?>