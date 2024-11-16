document.addEventListener("DOMContentLoaded", function () {
  let cart = document.getElementById("cartContainer");

  document.getElementById("close-cart").addEventListener("click", function () {
    if (cart.classList.contains("d-block")) {
      cart.style.transform = "translateX(150%)";

      setTimeout(function () {
        cart.classList.remove("d-block");
        cart.classList.add("d-none");
      }, 300);
    }
  });

  document
    .getElementById("continueshopping")
    .addEventListener("click", function () {
      if (cart.classList.contains("d-block")) {
        cart.style.transform = "translateX(150%)";

        setTimeout(function () {
          cart.classList.remove("d-block");
          cart.classList.add("d-none");
        }, 300);
      }
    });

  document.getElementById("checkout").addEventListener("click", function () {

    let items = [];

    document.querySelectorAll('.cart-cont').forEach(box => {
      if (box.getAttribute('boxid') !== '') {
        items.push(box.getAttribute('boxid'));
      }
    });

    $.ajax({
      url: "proceedtocart.php",
      data: {
        items: items
      },
      method: "POST",
      success: function (response) {
        const json = JSON.parse(response);
        if (json.pass) {
          window.location.href = "checkout?id=" + json.id;
        } else {
          alert("not allowed: " + response);
        }
      },
    });
  });
});
