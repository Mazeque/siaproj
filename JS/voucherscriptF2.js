document.querySelectorAll(".item-voucher-box").forEach((element) => {
  if (!element.classList.contains("unclickable")) {
    element.addEventListener("click", function () {
      if (!element.classList.contains("selected-voucher")) {
        currentelement = element;

        document.getElementById("use-button").disabled = false;
        currentelement.classList.add("selected-voucher");
      }
    });
  }
});

function usebutton() {
  if (!document.getElementById('subtotal').classList.contains('text-decoration-line-through')) {
    document.getElementById('subtotal').classList.add('text-decoration-line-through');
  }
  document.getElementById("use-button").disabled = false;
  currentvoucher = JSON.parse(
    JSON.stringify(vouchers[parseInt(currentelement.getAttribute("vid"))])
  );

  currentvid = currentelement.getAttribute("vid");

  document.getElementById("item-discount-text").innerHTML =
    "₱" + currentvoucher.price.toFixed(2);

  if (document.getElementById("saved-box").classList.contains("d-none")) {
    document.getElementById("saved-box").classList.remove("d-none");
  }

  document.getElementById("saved-price").innerHTML =
    currentvoucher.price.toFixed(2);

  let discountedprice =
    parseFloat(totalprice) - parseFloat(currentvoucher.price);
  document.getElementById("total").innerHTML = discountedprice.toFixed(2);

  if (document.getElementById("item-voucher-box-name").classList.contains("d-none")) {
    document.getElementById("item-voucher-box-name").classList.remove("d-none");
  }
  
  document.getElementById("item-voucher-box-name").innerHTML = currentvoucher.name.toUpperCase();

  document.getElementById("use-button").removeEventListener("click", usebutton);
  document
    .getElementById("use-button")
    .removeEventListener("click", cancelbutton);
  $("#voucherModal").modal("hide");
}

function cancelbutton() {
  document.getElementById("use-button").removeEventListener("click", usebutton);
  document
    .getElementById("canel-button")
    .removeEventListener("click", cancelbutton);
  if (currentelement.classList.contains("selected-voucher")) {
    currentelement.classList.remove("selected-voucher");
  }
}

document.getElementById("use-button").addEventListener("click", usebutton);
document
  .getElementById("cancel-button")
  .addEventListener("click", cancelbutton);
