<div id="cartContainer" class="cartContainer px-3 py-3 d-none">
    <div class="col-12 my-2">
        <button type="button" class="btn-close" id="close-cart" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="row my-5">
        <div class="col-12">
            <div class="col-12 position-relative">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="col-12">
                            <span class="cart-title">Shopping cart</span>
                        </div>
                        <div class="col-12">
                            <span class="cart-subtitle">You have (<span id="cart-total-items">0</span>) items in your
                                cart</span>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="view-main-cart">
                            <div class="col d-flex justify-content-center justify-content-lg-end py-2 py-lg-0 mt-2"><a
                                    href="cart" class="btn btn-outline-dark checkout-button py-2">VIEW FULL
                                    CART</a></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 cart-items-container" id="cart-items-container">
        </div>

        <div class="col-12 d-flex justify-content-lg-end py-5 justify-content-center">
            <div class="row d-flex justify-content-lg-end justify-content-center">
                <div class="col-12 d-flex justify-content-center justify-content-lg-end">
                    <span class="subtotal-price inter">Subtotal: ₱<span class="fw-bold" id="subtotal-price">0.00</span></span>
                </div>
                <div class="col-12 d-flex justify-content-center justify-content-lg-end my-2">
                    <span class="info">Taxes and Shipping are not yet included!</span>
                </div>
                <div class="col-12 d-flex justify-content-center justify-content-lg-end mt-5">
                    <div class="row d-flex justify-content-end">
                        <div class="col d-flex justify-content-center justify-content-lg-end py-2 py-lg-0 mt-2"><button
                                type="button" id="continueshopping"
                                class="btn btn-outline-dark checkout-button">CONTINUE TO SHOPPING</button></div>
                        <div class="col d-flex justify-content-center justify-content-lg-end py-2 py-lg-0 mt-2"><button
                                type="button" id="checkout" class="btn btn-dark checkout-button">CHECK
                                OUT</button></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>