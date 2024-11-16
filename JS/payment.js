document.getElementById("proceedButton").addEventListener("click", function () {
    var visaRadio = document.getElementById("visa");
    var paypalRadio = document.getElementById("paypal");
    var gcashRadio = document.getElementById("gcash");
    var codRadio = document.getElementById("cod");
    var walletRadio = document.getElementById("wallet");
    alert(1);
    if (visaRadio.checked) {
        window.location.href = "pay_visa.php";
    } else if (paypalRadio.checked) {
        window.location.href = "pay_paypal.php";
    } else if (gcashRadio.checked) {
        window.location.href = "pay_gcash.php";
    } else if (codRadio.checked) {
        window.location.href = "pay_cod.php";
    } else if (walletRadio.checked) {
        window.location.href = "pay_wallet.php";
    } else {
        document.getElementById("warningMessage").style.display = "block";
    }
});