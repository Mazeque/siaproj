<div class="col-12 pt-3">
    <div class="col-12 px-3 pb-2">
        <div class="row ">
            <div class="col">
                <span class="user-main-title fw-bold">Vouchers </span>
            </div>
            <div class="col d-flex justify-content-end">
                <button class="btn btn-outline-dark px-lg-5 px-4 voucher-create-button" data-bs-toggle="modal"
                    data-bs-target="#voucherModal">Create Voucher</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="row px-2">
        <div class="col-12 col-lg-5 order-2 order-lg-1">
            <div class="col-12">
                <span>All Vouchers are listed here</span>
            </div>
            <div class="col-12 voucher-box">

            </div>
        </div>
        <div class="col-12 col-lg-7 bg-success order-1 order-lg-2">
            &nbsp;
        </div>
    </div>
</div>
<div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content px-3 py-3">
            <div class="modal-header">
                <h1 class="modal-title fs-5 md-lt-space fw-bold" id="voucherModalLabel">Create a Voucher</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12" id="free-shipping-vouchers">

                    <div class="col-12">
                        <span class="md-lt-space fw-bold">Name</span>
                    </div>
                    <div class="col-12">
                        <span class="subtitle">Create a name for the voucher</span>
                    </div>
                    <div class="col-12 px-1 py-2">
                        <input id = "name-field" type="text" class="w-100 form-control voucher-field">
                    </div>

                    <div class="col-12">
                        <span class="md-lt-space fw-bold">Description</span>
                    </div>
                    <div class="col-12">
                        <span class="subtitle">Description of the voucher</span>
                    </div>
                    <div class="col-12 px-1 py-2">
                        <textarea id = "description-field" type="text" class="w-100 form-control voucher-field" rows="4"></textarea>
                    </div>

                    <div class="col-12 mt-3">
                        <span class="md-lt-space fw-bold">Type</span>
                    </div>
                    <div class="col-12">
                        <span class="subtitle">Select a type of voucher</span>
                    </div>
                    <div class="col-12 px-1 py-2">
                        <div class="row d-flex justify-content-center">
                            <div class="form-check col d-flex justify-content-center">
                                <input class="form-check-input" type="radio" name="vouchertype" value="1"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Shipping Voucher
                                </label>
                            </div>
                            <div class="form-check col d-flex justify-content-center">
                                <input class="form-check-input" type="radio" name="vouchertype" value="2"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Item Voucher
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="col-12 mt-3">
                                <span class="md-lt-space fw-bold">Price</span>
                            </div>
                            <div class="col-12">
                                <span class="subtitle">Price of the voucher</span>
                            </div>
                            <div class="input-group py-2 px-1">
                                <div class="input-group-prepend voucher-prefix">
                                    <span class="input-group-text voucher-text">
                                        <i class="fa-solid fa-peso-sign"></i>
                                    </span>
                                </div>
                                <input id="price-field" type="price" class="form-control voucher-field">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 mt-3">
                                <span class="md-lt-space fw-bold">Total Allow</span>
                            </div>
                            <div class="col-12">
                                <span class="subtitle">Claim for how many times</span>
                            </div>
                            <div class="col-12 px-1 py-2">
                                <input id = "total-allowable-field" type="text" class="w-100 form-control voucher-field">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="col-12 mt-3">
                                <span class="md-lt-space fw-bold">Minimum Price</span>
                            </div>
                            <div class="col-12">
                                <span class="subtitle">Required price for voucher</span>
                            </div>
                            <div class="input-group py-2 px-1">
                                <div class="input-group-prepend voucher-prefix">
                                    <span class="input-group-text voucher-text">
                                        <i class="fa-solid fa-peso-sign"></i>
                                    </span>
                                </div>
                                <input id="minimum-price-field" type="price" class="form-control voucher-field">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 mt-3">
                                <span class="md-lt-space fw-bold">Voucher Cap</span>
                            </div>
                            <div class="col-12">
                                <span class="subtitle">Maximum discount for voucher</span>
                            </div>
                            <div class="input-group py-2 px-1">
                                <div class="input-group-prepend voucher-prefix">
                                    <span class="input-group-text voucher-text">
                                        <i class="fa-solid fa-peso-sign"></i>
                                    </span>
                                </div>
                                <input id="cap-field" type="price" class="form-control voucher-field">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="col-12 mt-3">
                                <span class="md-lt-space fw-bold">Expiration</span>
                            </div>
                            <div class="col-12">
                                <span class="subtitle">Expiration date for the voucher</span>
                            </div>
                            <div class="col-12 px-1 py-2">
                                <input id = "expiration-field" class="form-control time-picker voucher-field" type="datetime-local"
                                    name="message-date" placeholder="Pick a date...">
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light modal-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light modal-button" id = "done-button">Done</button>
            </div>
        </div>
    </div>
</div>