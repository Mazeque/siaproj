<?php

if (isset($_GET['totprice'])) {
    $totprice = $_GET['totprice'];
}

if (isset($_GET['vid'])) {
    $currentvid = $_GET['vid'];
}

include '../connection.php';

$query = "SELECT * FROM voucher WHERE expiration_date > CURRENT_TIMESTAMP() AND type = 2";

$stmt = mysqli_prepare($conn, $query);
$stmt->execute();
$rs = $stmt->get_result();




if (intval($currentvid) > 0):
    if ($rs && mysqli_num_rows($rs) > 0):
        while ($vrow = mysqli_fetch_assoc($rs)):

            ?>

            <div vid="<?php echo $vrow['voucher_id']; ?>"
                class="item-voucher-box px-3 container-fluid <?php if ($totprice < doubleval($vrow['minimum_amount'])): ?> unclickable <?php endif; ?> <?php if ($currentvid == $vrow['voucher_id']): ?> selected-voucher <?php endif; ?>">
                <div class="row h-100">
                    <div class="col ticket-box-logo">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <div class="col">
                        <div class="row py-2">
                            <div class="col-12">
                                <span class="voucher-name"><?php echo $vrow['name']; ?></span>
                            </div>
                            <div class="col-12">
                                <span class="requirements">
                                    Requirements: <br><?php

                                    if ($vrow['minimum_amount'] != null || doubleval($vrow['minimum_amount']) > 0):
                                        ?>
                                        Cart price must be atleast
                                        ₱<span><?php echo number_format($vrow['minimum_amount'], 2, '.', ''); ?></span>

                                    <?php else: ?>
                                        CLAIM ANYTIME!
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col voucher-price-box pb-2">
                        <div class="row">
                            <div class="col-12">
                                <span class="discount-title">Discounted</span>
                            </div>
                            <div class="col-12 ">
                                <span class="inter voucher-price">
                                    ₱<?php echo number_format($vrow['price'], 2, '.', ''); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>


            <?php echo '<script>vouchers[' . $vrow['voucher_id'] . '] = ' . json_encode($vrow) . ';</script>'; endwhile; else: ?>
        <span class="subtitle">There are no currently available item vouchers.</span>
    <?php endif;

else:
    if ($rs && mysqli_num_rows($rs) > 0):
        while ($vrow = mysqli_fetch_assoc($rs)):
            ?>
            <div vid="<?php echo $vrow['voucher_id']; ?>"
                class="item-voucher-box px-3 container-fluid <?php if ($totprice < doubleval($vrow['minimum_amount'])): ?> unclickable <?php endif; ?> <?php if ($currentvid == $vrow['voucher_id']): ?> selected-voucher <?php endif; ?>">
                <div class="row h-100">
                    <div class="col ticket-box-logo">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <div class="col">
                        <div class="row py-2">
                            <div class="col-12">
                                <span class="voucher-name"><?php echo $vrow['name']; ?></span>
                            </div>
                            <div class="col-12">
                                <span class="requirements">
                                    Requirements: <br><?php

                                    if ($vrow['minimum_amount'] != null || doubleval($vrow['minimum_amount']) > 0):
                                        ?>
                                        Cart price must be atleast
                                        ₱<span><?php echo number_format($vrow['minimum_amount'], 2, '.', ''); ?></span>

                                    <?php else: ?>
                                        CLAIM ANYTIME!
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col voucher-price-box pb-2">
                        <div class="row">
                            <div class="col-12">
                                <span class="discount-title">Discounted</span>
                            </div>
                            <div class="col-12 ">
                                <span class="inter voucher-price">
                                    ₱<?php echo number_format($vrow['price'], 2, '.', ''); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <?php echo '<script>vouchers[' . $vrow['voucher_id'] . '] = ' . json_encode($vrow) . ';</script>'; endwhile; else: ?>
        <span class="subtitle">There are no currently available item vouchers.</span>
    <?php endif; endif; ?>