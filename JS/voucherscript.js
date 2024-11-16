document.querySelectorAll(".item-voucher-box").forEach((element) => {
  if (!element.classList.contains("unclickable")) {
    element.addEventListener("click", function () {
      if (!element.classList.contains("selected-voucher")) {
        element.classList.add("selected-voucher");
        document.getElementById("use-button").disabled = false;
        currentvoucher = JSON.parse(
          JSON.stringify(vouchers[parseInt(element.getAttribute("vid"))])
        );

        currentvid = parseInt(element.getAttribute("vid"));
        alert(1);
      }
    });
  }
});

document.getElementById("use-button").addEventListener("click", function () {
  document.getElementById("item-discount-text").innerHTML =
    "₱" + currentvoucher.price.toFixed(2);

  if (document.getElementById("saved-box").classList.contains("d-none")) {
    document.getElementById("saved-box").classList.remove("d-none");
  }

  document.getElementById("saved-price").innerHTML =
    currentvoucher.price.toFixed(2);

  totalprice = parseFloat(totalprice) - parseFloat(currentvoucher.price);
  document.getElementById("total").innerHTML = totalprice.toFixed(2);
  $("#voucherModal").modal("hide");
});
