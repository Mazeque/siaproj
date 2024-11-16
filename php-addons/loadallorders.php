<?php

session_start();

include '../connection.php';

$query = "SELECT p.order_id, p.payment_method, p.payment_status, p.delivery_id, p.user_id, p.order_status, p.order_creation_date, SUM(c.total_price) 
AS total_price, p.order_information FROM payment p JOIN cart c ON p.cart_id = c.cart_id WHERE p.user_id = ? GROUP BY p.order_id;";
$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param("i", $_SESSION['userid']);
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
                            <span class="inter order-price">₱<?php echo number_format($row['total_price'], 2, '.', '') ?></span>
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
                FROM payment p JOIN cart c ON p.cart_id = c.cart_id JOIN products pr ON pr.product_id = c.product_id WHERE p.user_id = ? AND p.order_id = ?;";

                $ostmt = mysqli_prepare($conn, $order);
                $ostmt->bind_param("ii", $_SESSION['userid'], $row['order_id']);
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
                                        <img class="img-fluid" src="admin/php-addons/productimages/<?php echo $imagename; ?>"
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
                                            <span
                                                class="inter order-price">₱<?php echo number_format($orderrow['item_cart_price'], 2, '.', '') ?></span>
                                        </div>
                                        <div class="col-12 d-flex justify-content-lg-end justify-content-center">
                                            <span class="order-total-price">Item Price</span>
                                        </div>
                                    </div>
                                    <?php if ($row['order_status'] == 'Delivered'): ?>
                                        <div class="col-12  d-flex justify-content-lg-end justify-content-center pt-3 px-0">
                                            <?php

                                            $checkreview = "SELECT * FROM reviews WHERE product_id = ? AND user_id = ? AND order_id = ?";

                                            $checkstmt = mysqli_prepare($conn, $checkreview);
                                            $checkstmt->bind_param("iii", $orderrow['product_id'], $_SESSION['userid'], $row['order_id']);
                                            $checkstmt->execute();

                                            $checkres = $checkstmt->get_result();

                                            if (mysqli_num_rows($checkres) > 0):
                                                ?>
                                                <span class="reviewed"><i class="fa-solid fa-circle-check"></i> Reviewed</span>
                                            <?php else: ?>
                                                <span class="leave-a-review" data-bs-toggle="modal" data-bs-target="#review_modal" orderid="<?php echo $row['order_id'] ?>" productid = "<?php echo $orderrow['product_id']?>"><i class="fa-solid fa-pen-to-square"></i> Leave a Review</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; endwhile; ?>
            </div>
            <?php if ($row['order_status'] == 'Processing'): ?>
                <div class="col-12  d-flex justify-content-center pt-3 px-0">
                    <span class="cancel-order" orderid="<?php echo $row['order_id'] ?>"><i class="fa-solid fa-trash-can"></i> Cancel
                        Order</span>
                </div>
            <?php endif; ?>
            <?php if ($row['order_status'] == 'Delivered' || $row['order_status'] == 'On-delivery'): ?>
                <?php if ($row['order_status'] == 'On-delivery'): ?>
                    <div class="col-12 d-flex justify-content-center">
                        <div class="row col-12">
                            <div class="col-lg-6 col-12 mt-4 d-flex justify-content-center justify-content-lg-start">
                                <button class="btn btn-outline-success w-100 order-received p-0" orderid="<?php echo $row['order_id'] ?>"><i
                                        class="fa-regular fa-circle-check"></i> Order
                                    Received</button>
                            </div>
                            <div class="col-lg-6 col-12 mt-4 d-flex justify-content-center justify-content-lg-end">
                                <div class="col order-receipt-box">
                                <a class="order-receipt" target="_blank" href="generate_invoice.php?order_id=<?php echo $row['order_id'] ?>"><i class="fa-solid fa-receipt"></i>
                            Generate Invoice Receipt</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-12 d-flex justify-content-center justify-content-lg-end pt-3 px-0">
                        <div class="col order-receipt-box">
                        <a class="order-receipt" target="_blank" href="generate_invoice.php?order_id=<?php echo $row['order_id'] ?>"><i class="fa-solid fa-receipt"></i>
                            Generate Invoice Receipt</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    <?php endwhile; ?>

<?php else: ?>
    <div class="col-12 no-item-box">
        <div class="row col-12">
            <div class="col-12 d-flex justify-content-center">
                <i class="fa-solid fa-list-ul order-icon"></i>
            </div>
            <div class="col-12 d-flex justify-content-center mt-4">
                <span class="no-order-text">There are no currently order(s) for this section!</span>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="review_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h5 class="modal-title review-title">Create a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12 my-3 d-flex justify-content-center">
                <span class="subtitle">Tell us about the product you bought!</span>
            </div>
            <div class="modal-body">
                <h4 class="text-center mt-1 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"
                        style="color:#E7E2E1;"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"
                        style="color:#E7E2E1;"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"
                        style="color:#E7E2E1;"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"
                        style="color:#E7E2E1;"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"
                        style="color:#E7E2E1;"></i>
                </h4>
                <div class="col-12 d-flex justify-content-center">
                    <div class="row col-12">
                        <div class="col-12 d-flex justify-content-center">
                            <span class="extra-big-text fw-bold" id = "product-rated">0</span>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <span class="subtitle">Star(s) Rating</span>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <input type="text" name="title" id="title" class="form-control review-field" placeholder="Title" />
                </div>

                <div class="form-group mt-2">
                    <textarea name="user_review" id="user_review" class="form-control review-field" rows="5"
                        placeholder="Your Review"></textarea>
                </div>

                <div class="form-group text-center mt-4">
                    <button type="button" class="btn btn-dark submit-button" id="save_review">Submit</button>
                </div>
            </div>

        </div>
    </div>
</div>