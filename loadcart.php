<?php
include 'connection.php';
session_start();

$cuid = $_POST['cuid'];

$lcquery = "SELECT * FROM cart c JOIN products p ON c.product_id = p.product_id WHERE user_id = ? AND status = 0";
$lcstmt = mysqli_prepare($conn, $lcquery);

$lcstmt->bind_param("i", $cuid);
$lcstmt->execute();

$lcresult = $lcstmt->get_result();

if ($lcresult) {

    $rowCount = mysqli_num_rows($lcresult);

    echo "<script>document.getElementById('cart-total-items').innerHTML = $rowCount</script>";

    while ($row = mysqli_fetch_assoc($lcresult)):


        $pquery = "SELECT * FROM products WHERE product_id = ?";
        $pstmt = mysqli_prepare($conn, $pquery);
        $pstmt->bind_param("i", $row['product_id']);
        $pstmt->execute();

        $presult = $pstmt->get_result();

        if ($presult && $prow = mysqli_fetch_assoc($presult)):

            $cid = $row['cart_id'];

            $pimage = $prow['product_images'];

            $pimage = trim($pimage, "[]");

            $parray = explode(",", $pimage);

            $parray = array_map('trim', $parray);

            $parray = array_map(function ($item) {
                return str_replace('"', '', $item);
            }, $parray);

            $plink = "admin/php-addons/productimages/{$parray[0]}"; ?>
            <div class="col-12 my-1 cart-cont" boxid = "<?php echo $cid?>">
                <hr>
                <div class="row px-3 d-flex justify-content-center">
                    <div class="col-3 image-cart"
                        style="background-image: url(<?php echo $plink; ?>); background-size: cover; background-position: center; background-repeat: no-repeat">

                    </div>
                    <div class="col-9 px-3 py-2">
                        <div class="row d-flex justify-content-between">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="product-title">
                                            <?php echo $prow['name'] ?>
                                        </span>
                                    </div>
                                    <div class="col-12">
                                        <span class="product-subtitle inter">₱
                                        <?php echo number_format($prow['price'], 2, '.', '') ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 justify-content-end right-cart-panel">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-8 col-lg-7 ">
                                        <div class=" px-2">
                                            <div class="row">
                                                <div class="col-12 quantity-box">
                                                    <div class="row">
                                                        <div class="col quantity-button add-q p-0" cartid="<?php echo $row['cart_id'] ?>"
                                                            prodid="<?php echo $row['product_id'] ?>">
                                                            <span class="px-0 fw-bold">&nbsp;+&nbsp;</span>
                                                        </div>
                                                        <div class="col quantity-field-box">
                                                            <input type="text" class="quantity-field"
                                                                fieldid="<?php echo $row['cart_id'] ?>" prodid="<?php echo $row['product_id'] ?>" stocks = "<?php echo $row['stocks']?>"/>
                                                        </div>
                                                        <div class="col quantity-button sub-q p-0" style = "overflow: hidden;" cartid="<?php echo $row['cart_id'] ?>"
                                                            prodid="<?php echo $row['product_id'] ?>">
                                                            <span class="p-0 fw-bold d-flex justify-content-center align-items-center">&nbsp;-&nbsp;</span>
                                                        </div>

                                                        <script> document.querySelector('[fieldid="<?php echo $cid ?>"]').value = <?php echo $row['quantity'] ?></script>
                                                    </div>
                                                </div>
                                                <div class="col-12 px-0">
                                                    <span class = "price-total inter">Total: ₱<span class = "item-tots" id = "item-total-price" itprice = "<?php echo $cid?>"><?php echo number_format($row['total_price'], 2, '.', '')?></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 delete-container">
                                        <i class="fa-regular fa-trash-can remove-cart-item" cartid="<?php echo $row['cart_id'] ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; endwhile;
} else {
    echo 'Failed to retrieve data.';
}
?>