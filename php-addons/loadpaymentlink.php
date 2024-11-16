<?php

if (isset($_GET['method'])) {
    $container = $_GET['method'];
}

?>


<div class="container-pm col-12" id="container-pm">
    <?php if ($container == 'Card'): ?>
        <div class="col-12">
            <div class="row card-container">
                <div class="col">
                    <div class="col-12 px-3 box-card py-3 " pm="mastercard">
                        <div class="row">
                            <div class="col-12 px-0">
                                <img src="Images/ModePay/mastercard-logo.png" pm="mastercard" alt="MasterCard" width="55">
                            </div>
                            <div class="col-12 px-2 mt-1">
                                <span class="title-card">MasterCard</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col-12 px-3 box-card py-3" pm="visa">
                        <div class="row">
                            <div class="col-12 px-0">
                                <img src="Images/ModePay/visa-logo.png" pm="visa" alt="Visa" width="55">
                            </div>
                            <div class="col-12 px-2 mt-1">
                                <span class="title-card">Visa</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col-12 px-3 box-card py-3" pm="amex">
                        <div class="row">
                            <div class="col-12 px-0">
                                <img src="Images/ModePay/amex-logo.png" pm="amex" alt="AMEX" width="55">
                            </div>
                            <div class="col-12 px-2 mt-1">
                                <span class="title-card">AMEX</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-12 px-3 disabled" id="card-field-container">
                <div class="col-12 mt-4 mb-5">
                    <div class="col-12 mb-1">
                        <span class="title-field">Card Name</span>
                    </div>
                    <div class="input-group w-100">
                        <input id="card-name-field" type="text" class="form-control card-field py-2"
                            placeholder="Cardholder Name">
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="col-12 mb-1">
                        <span class="title-field">Card Number</span>
                    </div>
                    <div class="input-group w-100">
                        <input id="card-number-field" type="text" class="form-control card-field py-2"
                            placeholder="16-Digit Card Number">
                        <div class="img-suffix d-flex justify-content-center ">
                            <img class="d-none" id="card-img-suffix" src="Images/ModePay/mastercard-logo.png" alt=""
                                width="43" height="30">
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5 mb-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="col-12 mb-1">
                                <span class="title-field">Expiry</span>
                            </div>
                            <div class="w-100">
                                <input id="expiry-field" type="text" class="form-control card-field py-2"
                                    placeholder="MM / YY">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 mb-1">
                                <span class="title-field">CVV / CVC</span>
                            </div>
                            <div class="input-group w-100">
                                <input id="cvccvv-field" type="text" class="form-control card-field py-2"
                                    placeholder="CVV / CVC">
                                <div class="img-suffix d-flex justify-content-center">
                                    <i class="fa-regular fa-credit-card"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($container == 'Paypal'): ?>
        <div class="col-12">
            <span>Paypal</span>
        </div>
    <?php endif; ?>
</div>