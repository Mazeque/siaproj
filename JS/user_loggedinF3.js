document.addEventListener("DOMContentLoaded", function () {
  var userProfileButton = document.getElementById("profile-button");
  var userBox = document.getElementById("user-box");

  document
    .getElementById("logout-button")
    .addEventListener("click", function () {
      $.ajax({
        url: "logout.php",
        data: {},
        success: function () {
          window.location.reload();
        },
      });
    });

  function handleClickOutside(event) {
    if (!userProfileButton.contains(event.target)) {
      userBox.style.transform = "translateX(150%)";
    }
  }

  userProfileButton.addEventListener("click", function () {
    userBox.style.transform = "translateX(0%)";
  });

  document.addEventListener("click", handleClickOutside);

  document.querySelectorAll(".profile-menu-box").forEach((element) => {
    element.addEventListener("click", function () {
      window.location.href = "menu?cat=" + element.getAttribute("goto");
    });
  });

  let cart = document.getElementById("cartContainer");

  document
    .getElementById("cart-button")
    .addEventListener("click", function (event) {
      if (cart.classList.contains("d-none")) {
        cart.style.transform = "translateX(150%)";
        cart.classList.remove("d-none");
        cart.classList.add("d-block");

        setTimeout(function () {
          cart.style.transform = "translateX(0%)";

          $.ajax({
            url: "check_login.php",
            method: "GET",
            dataType: "json",
            success: function (response) {
              var isLoggedIn = response.isLoggedIn;

              if (isLoggedIn) {
                $("#cart-items-container").load(
                  "loadcart.php",
                  {
                    cuid: response.user_id,
                  },
                  function () {
                    setTimeout(function () {
                      document
                        .querySelectorAll(".quantity-field")
                        .forEach((qf) => {
                          let cart_id = parseInt(qf.getAttribute("fieldid"));
                          let product_id = parseInt(qf.getAttribute("prodid"));

                          qf.addEventListener("input", function () {
                            this.value = this.value.replace(/\D/g, "");

                            var number = parseInt(this.value);

                            if (number < 1 || this.value == "") {
                              this.value = "1";
                            }

                            $.ajax({
                              url: "quantity.php",
                              method: "POST",
                              data: {
                                quantity: this.value,
                                product_id: product_id,
                                cart_id: cart_id,
                                method: "FIELD",
                              },
                              success: function (fres) {
                                let final = JSON.parse(fres);
                                if (final.status == "success") {
                                  document.querySelector(
                                    'input[fieldid="' + cart_id + '"]'
                                  ).value = number;
                                  document.querySelector(
                                    '[itprice="' + cart_id + '"]'
                                  ).innerHTML = final.totalprice;

                                  setTimeout(function () {
                                    let subtotal = 0;

                                    document
                                      .querySelectorAll(".item-tots")
                                      .forEach((price) => {
                                        subtotal =
                                          subtotal +
                                          parseFloat(price.textContent);
                                      });

                                    document.getElementById(
                                      "subtotal-price"
                                    ).innerHTML = subtotal.toFixed(2);
                                  }, 50);
                                } else {
                                  console.error("Failed to update quantity.");
                                }
                              },
                            });

                            console.log(this.value);
                          });
                        });

                      document.querySelectorAll(".add-q").forEach((addb) => {
                        let cart_id = parseInt(addb.getAttribute("cartid"));
                        let product_id = parseInt(addb.getAttribute("prodid"));

                        addb.addEventListener("click", function () {
                          let quantityField = document.querySelector(
                            'input[fieldid="' + cart_id + '"]'
                          );

                          if (quantityField) {
                            let qty = quantityField.value;

                            qty++;

                            $.ajax({
                              url: "quantity.php",
                              method: "POST",
                              data: {
                                quantity: qty,
                                product_id: product_id,
                                cart_id: cart_id,
                                method: "ADD",
                              },
                              success: function (qtyres) {
                                let final = JSON.parse(qtyres);
                                if (final.status == "success") {
                                  document.querySelector(
                                    'input[fieldid="' + cart_id + '"]'
                                  ).value = qty;
                                  document.querySelector(
                                    '[itprice="' + cart_id + '"]'
                                  ).innerHTML = final.totalprice;

                                  setTimeout(function () {
                                    let subtotal = 0;

                                    document
                                      .querySelectorAll(".item-tots")
                                      .forEach((price) => {
                                        subtotal =
                                          subtotal +
                                          parseFloat(price.textContent);
                                      });

                                    document.getElementById(
                                      "subtotal-price"
                                    ).innerHTML = subtotal.toFixed(2);
                                  }, 50);
                                } else {
                                  console.error("Failed to update quantity.");
                                }
                              },
                            });
                          }
                        });
                      });

                      document.querySelectorAll(".sub-q").forEach((subb) => {
                        let cart_id = parseInt(subb.getAttribute("cartid"));
                        let product_id = parseInt(subb.getAttribute("prodid"));

                        subb.addEventListener("click", function () {
                          let quantityField = document.querySelector(
                            'input[fieldid="' + cart_id + '"]'
                          );

                          if (quantityField) {
                            let qty = quantityField.value;

                            if (qty > 1) {
                              qty--;
                            }

                            $.ajax({
                              url: "quantity.php",
                              method: "POST",
                              data: {
                                quantity: qty,
                                product_id: product_id,
                                cart_id: cart_id,
                                method: "SUBTRACT",
                              },
                              success: function (qtyres) {
                                let final = JSON.parse(qtyres);

                                if (final.status == "success") {
                                  document.querySelector(
                                    'input[fieldid="' + cart_id + '"]'
                                  ).value = qty;
                                  document.querySelector(
                                    '[itprice="' + cart_id + '"]'
                                  ).innerHTML = final.totalprice;

                                  setTimeout(function () {
                                    let subtotal = 0;

                                    document
                                      .querySelectorAll(".item-tots")
                                      .forEach((price) => {
                                        subtotal =
                                          subtotal +
                                          parseFloat(price.textContent);
                                      });

                                    document.getElementById(
                                      "subtotal-price"
                                    ).innerHTML = subtotal.toFixed(2);
                                  }, 50);
                                } else {
                                  console.error("Failed to update quantity.");
                                }
                              },
                            });
                          }
                        });
                      });

                      document
                        .querySelectorAll(".remove-cart-item")
                        .forEach((trash) => {
                          trash.addEventListener("click", function () {
                            $.ajax({
                              url: "removeitem.php",
                              method: "POST",
                              data: {
                                cartid: trash.getAttribute("cartid"),
                              },
                              success: function (removeresponse) {
                                if (removeresponse === "Deleted") {
                                  let box = document.querySelector(
                                    '[boxid="' +
                                      trash.getAttribute("cartid") +
                                      '"]'
                                  );

                                  if (box) {
                                    setTimeout(function () {
                                      box.style.transform = "translateX(150%)";

                                      let itemprice = parseFloat(
                                        document.querySelector(
                                          '[itprice="' +
                                            trash.getAttribute("cartid") +
                                            '"]'
                                        ).textContent
                                      );

                                      let totalprice = parseFloat(
                                        document.getElementById(
                                          "subtotal-price"
                                        ).textContent
                                      );

                                      document.getElementById(
                                        "subtotal-price"
                                      ).innerHTML = (
                                        totalprice - itemprice
                                      ).toFixed(2);

                                      let carttot =
                                        parseInt(
                                          document.getElementById(
                                            "cart-total-items"
                                          ).textContent
                                        ) - 1;

                                      document.getElementById(
                                        "cart-total-items"
                                      ).innerHTML = carttot;
                                      setTimeout(function () {
                                        box.parentNode.removeChild(box);
                                      }, 400);
                                    }, 100);
                                  }
                                }
                              },
                            });
                          });
                        });
                    }, 100);

                    setTimeout(function () {
                      let subtotal = 0;

                      document
                        .querySelectorAll(".item-tots")
                        .forEach((price) => {
                          subtotal = subtotal + parseFloat(price.textContent);
                        });

                      document.getElementById("subtotal-price").innerHTML =
                        subtotal.toFixed(2);
                    }, 50);
                  }
                );
              }
            },
          });
        }, 25);
      }
    });
});
