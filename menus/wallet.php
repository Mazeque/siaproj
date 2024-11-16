<?php

session_start();

include '../connection.php';

$getwallet = "SELECT * FROM wallet w JOIN users u ON w.user_id = u.user_id WHERE w.user_id = ?";
$getstmt = mysqli_prepare($conn, $getwallet);
$getstmt->bind_param("i", $_SESSION['userid']);
$getstmt->execute();

$getres = $getstmt->get_result();

if (mysqli_num_rows($getres) > 0):
    $wrow = mysqli_fetch_assoc($getres);

    ?>
    <div class="container h-100 py-3">
        <div class="row">
            <div class="col-lg-6 col-12 mt-3">
                <div class="col-12 bg-light rounded p-3 wallet-container">
                    <div class="row">
                        <div class="col-8 py-2">
                            <span class="wallet-balance-title">Wallet Balance</span>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <div class="php-sign bg-dark px-3 rounded"><i class="fa-solid fa-peso-sign text-light"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-3 py-2">
                        <div class="col php-bal-logo">
                            <i class="fa-solid fa-peso-sign"></i>
                        </div>
                        <div class="col p-0">
                            <span
                                class="php-bal-text p-0 inter"><?php echo number_format($wrow['balance'], 2, '.', '') ?></span>
                        </div>
                    </div>
                    <div class="row col-12 px-3 py-2 mt-2">
                        <div class="col-12">
                            <span class="subtitle">Account Number</span>
                        </div>
                        <div class="col-12 mt-1">
                            <span class="account-number"><i class="fa-regular fa-copy copy-account-num"
                                    id="copy-account-num"></i> <span
                                    id="account-number"><?php echo $wrow['wallet_number'] ?></span></span>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <button class="btn btn-outline-dark w-100 transfer-button mt-3"><i
                                    class="fa-solid fa-money-bill-transfer"></i> Transfer money</button>
                        </div>
                        <div class="col-lg-6 col-12">
                            <button class="btn btn-dark w-100 transfer-button mt-3"><i class="fa-solid fa-plus"></i> Add
                                Funds</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mt-3">
                <div class="col-12 bg-light rounded p-3 wallet-container">
                    <div class="row">
                        <div class="col-12 py-2">
                            <span class="wallet-balance-title">Wallet Information</span>
                        </div>
                    </div>
                    <div class="row col-12 px-3 py-2">
                        <div class="col info-title-box">
                            <span class="info-title">Wallet ID: </span>
                        </div>
                        <div class="col info-details-box">
                            <span class="info-details"><?php echo $wrow['wallet_id'] ?></span>
                        </div>
                    </div>
                    <div class="row col-12 px-3 py-2">
                        <div class="col info-title-box">
                            <span class="info-title">Wallet Holder: </span>
                        </div>
                        <div class="col info-details-box">
                            <span class="info-details"><?php echo $wrow['firstname'] . ' ' . $wrow['lastname'] ?></span>
                        </div>
                    </div>
                    <div class="row col-12 px-3 py-2">
                        <div class="col info-title-box">
                            <span class="info-title">Contact Number: </span>
                        </div>
                        <div class="col info-details-box">
                            <span class="info-details"><?php echo $wrow['contactnumber'] ?></span>
                        </div>
                    </div>
                    <div class="row col-12 px-3 py-2">
                        <div class="col info-title-box">
                            <span class="info-title">Date Activated : </span>
                        </div>
                        <div class="col info-details-box">
                            <span
                                class="info-details"><?php echo date("F j, Y, g:i A", strtotime($wrow['wallet_date_creation'])) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 bg-warning row rounded mt-3">
            &nbsp;
        </div>
    </div>

    <script src="JS/wallet.js"></script>
<?php else: ?>
    <div class="container h-100 py-3">
        <div class="row">
            <div class="col-lg-6 col-12 mt-3">
                <div class="col-12 bg-light rounded p-3 not-activated">
                    <div class="row col-12 py-4">
                        <div class="col-12 d-flex justify-content-center">
                            <span class="subtitle text-center">Complete your wallet setup by clicking the activation
                                button.</span>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-3">
                            <button class="btn btn-outline-dark activate-button px-5" data-bs-toggle="modal"
                                data-bs-target="#activate-wallet-modal">Activate Wallet</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mt-3">
                <div class="col-12 rounded">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="activate-wallet-Modal" tabindex="-1" aria-labelledby="activate-wallet-modal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content activate-wallet-modal">
                <div class="modal-body">
                    <div class="col-12">
                        <h1 class="modal-title fs-5 wallet-modal-title fw-bold" id="activate-wallet-ModalLabel">Create your
                            wallet
                        </h1>
                    </div>
                    <div class="col-12 my-4 px-4">
                        <span class="wallet-creation-desc">Proceed with wallet creation? This will generate a wallet
                            address. Make sure you understand the implications.</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark close-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-dark create-button" id="wallet-creation">Create</button>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/walletcreation.js"></script>

<?php endif; ?>