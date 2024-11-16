<div class="containerPay" id="containerpay">
    <div class="title">
        <span class="title-text">Select a type of Payment</span>
        <br>
        <h5 class="subtitle">Available Payment Methods</h5>
    </div>

    <form action="#">
        <input type="radio" name="payment" id="visa">
        <input type="radio" name="payment" id="paypal">
        <input type="radio" name="payment" id="gcash">
        <input type="radio" name="payment" id="cod">
        <input type="radio" name="payment" id="wallet">

        <div class="category">
            <label for="visa" class="visaMethod">
                <div class="imgName">
                    <div class="imgContainer visa">
                        <img src="Images/ModePay/card.png" alt="">
                    </div>
                    <span class="name">Card</span>
                </div>

                <span class="check">
                    <i class="fa-solid fa-circle-check" styke="color: black"></i>
                </span>
            </label>

            <label for="paypal" class="paypalMethod disabled" id="paypal">
                <div class="imgName">
                    <div class="imgContainer paypal">
                        <img src="Images/ModePay/Paypal.png" alt="">
                    </div>
                    <span class="name">Paypal</span>
                </div>

                <span class="check">
                    <i class="fa-solid fa-circle-check" styke="color: black"></i>
                </span>
            </label>

            <label for="gcash" class="gcashMethod disabled">
                <div class="imgName">
                    <div class="imgContainer gcash">
                        <img src="Images/ModePay/Gcash.png" alt="">
                    </div>
                    <span class="name">Gcash</span>
                </div>

                <span class="check">
                    <i class="fa-solid fa-circle-check" styke="color: black"></i>
                </span>
            </label>

        </div>
        <p id="warningMessage" style="color: red; display: none; white-space: nowrap; padding-top: 10px;">
            Please choose a mode of payment.</p>

    </form>
</div>