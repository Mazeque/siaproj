<div class="container h-100">
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-lg-6 mt-lg-0 mt-4">
                <div class="col-12 d-flex justify-content-lg-start justify-content-center">
                    <span class="payment-title">Payment Method</span>
                </div>
                <div class="col-12 d-flex justify-content-lg-start justify-content-center">
                    <span class="payment-subtitle">Creating and Linking Payment Methods</span>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-lg-0 mt-4">
                <div class="col-12 d-flex justify-content-lg-end justify-content-center add-payment-box h-100">
                    <span id="addpmButton" class="add-span px-4" data-bs-toggle="modal" data-bs-target="#addpmModal"><i
                            class="fa-solid fa-credit-card"></i>&nbsp; Add Payment Method</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="col-12 mt-5">
            <span class="subtitle">All linked payment methods</span>
        </div>
        <div class="col-12 py-3 px-0">
            <div class="col-12 pm-method-cont">

                <?php

                session_start();

                include '../connection.php';

                $fetchpm = "SELECT * FROM paymentmethod WHERE user_id = ?";
                $fetchstmt = mysqli_prepare($conn, $fetchpm);
                $fetchstmt->bind_param("i", $_SESSION['userid']);
                $fetchstmt->execute();

                $fetchpm = $fetchstmt->get_result();

                if (mysqli_num_rows($fetchpm) > 0):
                    while ($paymentrow = mysqli_fetch_assoc($fetchpm)):
                        ?>

                        <div class="col-12 pm-box px-3 py-4 row my-3 d-flex justify-content-center ms-0">
                            <div class="col pm-img-box">
                                <div class="pm-icon-box">
                                    <img src="Images/ModePay/<?php echo $paymentrow['type'] ?>.png"
                                        alt="<?php echo $paymentrow['type'] ?>">
                                </div>
                            </div>
                            <div class="col ">
                                <div class="row ">
                                    <div class="col-12">
                                        <span class="method-details"><span
                                                class="pm-info">...<?php echo substr($paymentrow['card_number'], -4) ?></span>
                                            <span class="pm-type"><?php echo ' (' . $paymentrow['type'] . ')' ?></span></span>
                                    </div>
                                    <div class="col-12">
                                        <span class="subtitle"><?php echo $paymentrow['card_name'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col pm-del-box">
                                <i class="fa-solid fa-trash-can del-button"
                                    pid="<?php echo $paymentrow['paymentmethod_id']; ?>"></i>
                            </div>
                        </div>


                    <?php endwhile; ?>

                <?php else: ?>

                    <div class="col-12 d-flex justify-content-center my-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 d-flex justify-content-center">
                                <i class="subtitle fa-regular fa-credit-card no-link-icon"></i>
                            </div>
                            <div class="col-12 d-flex justify-content-center my-3">
                                <span class="subtitle small-text text-center">Oops! There are no currently linked payment methods</span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal-section" id="modal-section">
    <?php include '../php-addons/paymentmodal.php'; ?>
</div>