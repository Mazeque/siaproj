document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("qty-field").value = 1;

  const limit = parseInt(document.querySelector(".stocks-total").textContent);

  document.getElementById("qty-field").addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");

    var number = parseInt(this.value);

    if (number < 1 || this.value == "") {
      this.value = "1";
    }

    if (number > limit) {
      this.value = limit;
    }
  });

  document.querySelector(".qty-top").addEventListener("click", function () {
    let currentqty = document.getElementById("qty-field").value;
    if (currentqty < limit) {
      document.getElementById("qty-field").value++;
    }
  });

  document.querySelector(".qty-bot").addEventListener("click", function () {
    let currentqty = document.getElementById("qty-field").value;

    if (currentqty > 1) {
      document.getElementById("qty-field").value--;
    }
  });

  document.getElementById("back-prod").addEventListener("click", function () {
    window.location.href = "products";
  });

  document.getElementById("addcart").addEventListener("click", function () {
    $.ajax({
      url: "check_login.php",
      method: "GET",
      dataType: "json",
      success: function (response) {
        var isLoggedIn = response.isLoggedIn;

        if (isLoggedIn) {
          $.ajax({
            url: "addtocartpage.php",
            method: "POST",
            data: {
              userid: response.user_id,
              productid: document
                .getElementById("addcart")
                .getAttribute("prodid"),
              unitprice: document
                .getElementById("addcart")
                .getAttribute("price"),
              quantity: document.getElementById("qty-field").value,
            },
            success: function (resp) {
              const cartCont = document.getElementById("cartContainer");
              if (resp === "Success") {
                if (cartCont.classList.contains("d-none")) {
                  cartCont.style.transform = "translateX(150%)";
                  cartCont.classList.remove("d-none");
                  cartCont.classList.add("d-block");

                  $("#cart-items-container").load(
                    "loadcart.php",
                    {
                      cuid: response.user_id,
                    },
                    function () {
                      setTimeout(function () {
                        $.ajax({
                          url: "gettotcart.php",
                          method: "POST",
                          data: {
                            userid: response.user_id,
                          },
                          success: function (cartresponse) {
                            if (cartresponse) {
                              document.getElementById(
                                "count-tot-items"
                              ).innerHTML = cartresponse;
                              setTimeout(function () {
                                document
                                  .getElementById("count-tot-items")
                                  .classList.add("show-tot-items");

                                if (
                                  document
                                    .getElementById("count-tot-items")
                                    .classList.contains("show-tot-items")
                                ) {
                                  document
                                    .getElementById("count-tot-items")
                                    .classList.remove("show-tot-items");
                                  document
                                    .getElementById("count-tot-items")
                                    .classList.add("show-tot-items");
                                } else {
                                  document
                                    .getElementById("count-tot-items")
                                    .classList.add("show-tot-items");
                                }
                              }, 300);
                            }
                          },
                        });

                        document
                          .querySelectorAll(".quantity-field")
                          .forEach((qf) => {
                            let cart_id = parseInt(qf.getAttribute("fieldid"));
                            let product_id = parseInt(
                              qf.getAttribute("prodid")
                            );
                            let limit = parseInt(qf.getAttribute("stocks"));

                            // QUANTITY INPUT FIELD
                            qf.addEventListener("input", function () {
                              this.value = this.value.replace(/\D/g, "");
                              var number = parseInt(this.value);

                              if (isNaN(number) || this.value === "") {
                                qf.value = 1;
                              } else {
                                qf.value = number;
                              }

                              if (number > limit) {
                                this.value = limit.toString();
                              }

                              var self = this;

                              setTimeout(function () {
                                $.ajax({
                                  url: "quantity.php",
                                  method: "POST",
                                  data: {
                                    quantity: parseInt(self.value),
                                    product_id: product_id,
                                    cart_id: cart_id,
                                    method: "FIELD",
                                  },
                                  success: function (fres) {
                                    let final = JSON.parse(fres);
                                    if (final.status == "success") {
                                      document.querySelector(
                                        'input[fieldid="' + cart_id + '"]'
                                      ).value = self.value;
                                      document.querySelector(
                                        '[itprice="' + cart_id + '"]'
                                      ).innerHTML = final.totalprice.toFixed(2);

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
                                      console.error(
                                        "Failed to update quantity."
                                      );
                                    }
                                  },
                                });
                              }, 100);
                            });
                          });

                        document.querySelectorAll(".add-q").forEach((addb) => {
                          let cart_id = parseInt(addb.getAttribute("cartid"));
                          let product_id = parseInt(
                            addb.getAttribute("prodid")
                          );

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
                                    ).innerHTML = final.totalprice.toFixed(2);

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
                          let product_id = parseInt(
                            subb.getAttribute("prodid")
                          );

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
                                    ).innerHTML = final.totalprice.toFixed(2);

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
                                      const container = document.getElementById(
                                        "cart-items-container"
                                      );

                                      setTimeout(function () {
                                        let boxheight = box.offsetHeight + 20;

                                        let initial = container.offsetHeight;

                                        container.style.height = initial + "px";

                                        box.style.transform =
                                          "translateX(150%)";

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
                                        document.getElementById(
                                          "count-tot-items"
                                        ).innerHTML = carttot;
                                        setTimeout(function () {
                                          setTimeout(function () {
                                            box.parentNode.removeChild(box);

                                            const fcontainer =
                                              document.getElementById(
                                                "cart-items-container"
                                              );

                                            let final =
                                              container.offsetHeight -
                                              boxheight;

                                            fcontainer.style.height =
                                              final + "px";

                                            setTimeout(function () {
                                              fcontainer.style.removeProperty(
                                                "height"
                                              );
                                            }, 500);
                                          }, 30);
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

                  setTimeout(function () {
                    cartCont.style.transform = "translateX(0%)";
                  }, 25);
                } else {
                  $("#cart-items-container").load(
                    "loadcart.php",
                    {
                      cuid: response.user_id,
                    },
                    function () {
                      setTimeout(function () {
                        $.ajax({
                          url: "gettotcart.php",
                          method: "POST",
                          data: {
                            userid: response.user_id,
                          },
                          success: function (cartresponse) {
                            if (cartresponse) {
                              document.getElementById(
                                "count-tot-items"
                              ).innerHTML = cartresponse;
                              setTimeout(function () {
                                document
                                  .getElementById("count-tot-items")
                                  .classList.add("show-tot-items");

                                if (
                                  document
                                    .getElementById("count-tot-items")
                                    .classList.contains("show-tot-items")
                                ) {
                                  document
                                    .getElementById("count-tot-items")
                                    .classList.remove("show-tot-items");
                                  document
                                    .getElementById("count-tot-items")
                                    .classList.add("show-tot-items");
                                } else {
                                  document
                                    .getElementById("count-tot-items")
                                    .classList.add("show-tot-items");
                                }
                              }, 300);
                            }
                          },
                        });

                        document
                          .querySelectorAll(".quantity-field")
                          .forEach((qf) => {
                            let cart_id = parseInt(qf.getAttribute("fieldid"));
                            let product_id = parseInt(
                              qf.getAttribute("prodid")
                            );

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
                                    ).innerHTML = final.totalprice.toFixed(2);

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
                          let product_id = parseInt(
                            addb.getAttribute("prodid")
                          );

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
                                    ).innerHTML = final.totalprice.toFixed(2);

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
                          let product_id = parseInt(
                            subb.getAttribute("prodid")
                          );

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
                                    ).innerHTML = final.totalprice.toFixed(2);

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
                                      const container = document.getElementById(
                                        "cart-items-container"
                                      );

                                      setTimeout(function () {
                                        let boxheight = box.offsetHeight + 20;

                                        let initial = container.offsetHeight;

                                        container.style.height = initial + "px";

                                        box.style.transform =
                                          "translateX(150%)";

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
                                        document.getElementById(
                                          "count-tot-items"
                                        ).innerHTML = carttot;
                                        setTimeout(function () {
                                          setTimeout(function () {
                                            box.parentNode.removeChild(box);

                                            const fcontainer =
                                              document.getElementById(
                                                "cart-items-container"
                                              );

                                            let final =
                                              container.offsetHeight -
                                              boxheight;

                                            fcontainer.style.height =
                                              final + "px";

                                            setTimeout(function () {
                                              fcontainer.style.removeProperty(
                                                "height"
                                              );
                                            }, 500);
                                          }, 30);
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

                  setTimeout(function () {
                    cartCont.style.transform = "translateX(0%)";
                  }, 25);
                }
              } else {
                const decode = JSON.parse(resp);
                $.ajax({
                  url: "getstocks.php",
                  data: {
                    id: parseInt(
                      document.getElementById("addcart").getAttribute("prodid")
                    ),
                  },
                  method: "POST",
                  success: function (sharraine) {
                    if (parseInt(sharraine) > 0) {
                      let add =
                        parseInt(document.getElementById("qty-field").value) +
                        parseInt(decode.quantity);

                      if (add <= parseInt(sharraine)) {
                        $.ajax({
                          url: "updatecart.php",
                          data: {
                            newqty: parseInt(add),
                            cartid: parseInt(decode.cartid),
                            unitprice: parseFloat(
                              document
                                .getElementById("addcart")
                                .getAttribute("price")
                            ),
                          },
                          method: "POST",
                          success: function (uc) {
                            if (cartCont.classList.contains("d-block")) {
                              $("#cart-items-container").load(
                                "loadcart.php",
                                {
                                  cuid: response.user_id,
                                },
                                function () {
                                  setTimeout(function () {
                                    $.ajax({
                                      url: "gettotcart.php",
                                      method: "POST",
                                      data: {
                                        userid: response.user_id,
                                      },
                                      success: function (cartresponse) {
                                        if (cartresponse) {
                                          document.getElementById(
                                            "count-tot-items"
                                          ).innerHTML = cartresponse;
                                          setTimeout(function () {
                                            document
                                              .getElementById("count-tot-items")
                                              .classList.add("show-tot-items");

                                            if (
                                              document
                                                .getElementById(
                                                  "count-tot-items"
                                                )
                                                .classList.contains(
                                                  "show-tot-items"
                                                )
                                            ) {
                                              document
                                                .getElementById(
                                                  "count-tot-items"
                                                )
                                                .classList.remove(
                                                  "show-tot-items"
                                                );
                                              document
                                                .getElementById(
                                                  "count-tot-items"
                                                )
                                                .classList.add(
                                                  "show-tot-items"
                                                );
                                            } else {
                                              document
                                                .getElementById(
                                                  "count-tot-items"
                                                )
                                                .classList.add(
                                                  "show-tot-items"
                                                );
                                            }
                                          }, 300);
                                        }
                                      },
                                    });

                                    document
                                      .querySelectorAll(".quantity-field")
                                      .forEach((qf) => {
                                        let cart_id = parseInt(
                                          qf.getAttribute("fieldid")
                                        );
                                        let product_id = parseInt(
                                          qf.getAttribute("prodid")
                                        );

                                        qf.addEventListener(
                                          "input",
                                          function () {
                                            this.value = this.value.replace(
                                              /\D/g,
                                              ""
                                            );

                                            var number = parseInt(this.value);

                                            if (
                                              number < 1 ||
                                              this.value == ""
                                            ) {
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
                                                    'input[fieldid="' +
                                                      cart_id +
                                                      '"]'
                                                  ).value = number;
                                                  document.querySelector(
                                                    '[itprice="' +
                                                      cart_id +
                                                      '"]'
                                                  ).innerHTML =
                                                    final.totalprice.toFixed(2);

                                                  setTimeout(function () {
                                                    let subtotal = 0;

                                                    document
                                                      .querySelectorAll(
                                                        ".item-tots"
                                                      )
                                                      .forEach((price) => {
                                                        subtotal =
                                                          subtotal +
                                                          parseFloat(
                                                            price.textContent
                                                          );
                                                      });

                                                    document.getElementById(
                                                      "subtotal-price"
                                                    ).innerHTML =
                                                      subtotal.toFixed(2);
                                                  }, 50);
                                                } else {
                                                  console.error(
                                                    "Failed to update quantity."
                                                  );
                                                }
                                              },
                                            });

                                            console.log(this.value);
                                          }
                                        );
                                      });

                                    document
                                      .querySelectorAll(".add-q")
                                      .forEach((addb) => {
                                        let cart_id = parseInt(
                                          addb.getAttribute("cartid")
                                        );
                                        let product_id = parseInt(
                                          addb.getAttribute("prodid")
                                        );

                                        addb.addEventListener(
                                          "click",
                                          function () {
                                            let quantityField =
                                              document.querySelector(
                                                'input[fieldid="' +
                                                  cart_id +
                                                  '"]'
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
                                                  let final =
                                                    JSON.parse(qtyres);
                                                  if (
                                                    final.status == "success"
                                                  ) {
                                                    document.querySelector(
                                                      'input[fieldid="' +
                                                        cart_id +
                                                        '"]'
                                                    ).value = qty;
                                                    document.querySelector(
                                                      '[itprice="' +
                                                        cart_id +
                                                        '"]'
                                                    ).innerHTML =
                                                      final.totalprice.toFixed(
                                                        2
                                                      );

                                                    setTimeout(function () {
                                                      let subtotal = 0;

                                                      document
                                                        .querySelectorAll(
                                                          ".item-tots"
                                                        )
                                                        .forEach((price) => {
                                                          subtotal =
                                                            subtotal +
                                                            parseFloat(
                                                              price.textContent
                                                            );
                                                        });

                                                      document.getElementById(
                                                        "subtotal-price"
                                                      ).innerHTML =
                                                        subtotal.toFixed(2);
                                                    }, 50);
                                                  } else {
                                                    console.error(
                                                      "Failed to update quantity."
                                                    );
                                                  }
                                                },
                                              });
                                            }
                                          }
                                        );
                                      });

                                    document
                                      .querySelectorAll(".sub-q")
                                      .forEach((subb) => {
                                        let cart_id = parseInt(
                                          subb.getAttribute("cartid")
                                        );
                                        let product_id = parseInt(
                                          subb.getAttribute("prodid")
                                        );

                                        subb.addEventListener(
                                          "click",
                                          function () {
                                            let quantityField =
                                              document.querySelector(
                                                'input[fieldid="' +
                                                  cart_id +
                                                  '"]'
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
                                                  let final =
                                                    JSON.parse(qtyres);

                                                  if (
                                                    final.status == "success"
                                                  ) {
                                                    document.querySelector(
                                                      'input[fieldid="' +
                                                        cart_id +
                                                        '"]'
                                                    ).value = qty;
                                                    document.querySelector(
                                                      '[itprice="' +
                                                        cart_id +
                                                        '"]'
                                                    ).innerHTML =
                                                      final.totalprice.toFixed(
                                                        2
                                                      );

                                                    setTimeout(function () {
                                                      let subtotal = 0;

                                                      document
                                                        .querySelectorAll(
                                                          ".item-tots"
                                                        )
                                                        .forEach((price) => {
                                                          subtotal =
                                                            subtotal +
                                                            parseFloat(
                                                              price.textContent
                                                            );
                                                        });

                                                      document.getElementById(
                                                        "subtotal-price"
                                                      ).innerHTML =
                                                        subtotal.toFixed(2);
                                                    }, 50);
                                                  } else {
                                                    console.error(
                                                      "Failed to update quantity."
                                                    );
                                                  }
                                                },
                                              });
                                            }
                                          }
                                        );
                                      });

                                    document
                                      .querySelectorAll(".remove-cart-item")
                                      .forEach((trash) => {
                                        trash.addEventListener(
                                          "click",
                                          function () {
                                            $.ajax({
                                              url: "removeitem.php",
                                              method: "POST",
                                              data: {
                                                cartid:
                                                  trash.getAttribute("cartid"),
                                              },
                                              success: function (
                                                removeresponse
                                              ) {
                                                if (
                                                  removeresponse === "Deleted"
                                                ) {
                                                  let box =
                                                    document.querySelector(
                                                      '[boxid="' +
                                                        trash.getAttribute(
                                                          "cartid"
                                                        ) +
                                                        '"]'
                                                    );

                                                  if (box) {
                                                    const container =
                                                      document.getElementById(
                                                        "cart-items-container"
                                                      );

                                                    setTimeout(function () {
                                                      let boxheight =
                                                        box.offsetHeight + 20;

                                                      let initial =
                                                        container.offsetHeight;

                                                      container.style.height =
                                                        initial + "px";

                                                      box.style.transform =
                                                        "translateX(150%)";

                                                      let itemprice =
                                                        parseFloat(
                                                          document.querySelector(
                                                            '[itprice="' +
                                                              trash.getAttribute(
                                                                "cartid"
                                                              ) +
                                                              '"]'
                                                          ).textContent
                                                        );

                                                      let totalprice =
                                                        parseFloat(
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
                                                      document.getElementById(
                                                        "count-tot-items"
                                                      ).innerHTML = carttot;
                                                      setTimeout(function () {
                                                        setTimeout(function () {
                                                          box.parentNode.removeChild(
                                                            box
                                                          );

                                                          const fcontainer =
                                                            document.getElementById(
                                                              "cart-items-container"
                                                            );

                                                          let final =
                                                            container.offsetHeight -
                                                            boxheight;

                                                          fcontainer.style.height =
                                                            final + "px";

                                                          setTimeout(
                                                            function () {
                                                              fcontainer.style.removeProperty(
                                                                "height"
                                                              );
                                                            },
                                                            500
                                                          );
                                                        }, 30);
                                                      }, 400);
                                                    }, 100);
                                                  }
                                                }
                                              },
                                            });
                                          }
                                        );
                                      });
                                  }, 100);

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
                                }
                              );

                              setTimeout(function () {
                                cartCont.style.transform = "translateX(0%)";
                              }, 25);
                            } else {
                              document.getElementById("qty-field").value = 1;
                              document.getElementById("cart-button").click();
                            }
                          },
                        });
                      } else {
                        //ELSE
                        $.ajax({
                          url: "updatecart.php",
                          data: {
                            newqty: parseInt(sharraine),
                            cartid: parseInt(decode.cartid),
                            unitprice: parseFloat(
                              document
                                .getElementById("addcart")
                                .getAttribute("price")
                            ),
                          },
                          method: "POST",
                          success: function (uc) {
                            if (cartCont.classList.contains("d-block")) {
                              $("#cart-items-container").load(
                                "loadcart.php",
                                {
                                  cuid: response.user_id,
                                },
                                function () {
                                  setTimeout(function () {
                                    $.ajax({
                                      url: "gettotcart.php",
                                      method: "POST",
                                      data: {
                                        userid: response.user_id,
                                      },
                                      success: function (cartresponse) {
                                        if (cartresponse) {
                                          document.getElementById(
                                            "count-tot-items"
                                          ).innerHTML = cartresponse;
                                          setTimeout(function () {
                                            document
                                              .getElementById("count-tot-items")
                                              .classList.add("show-tot-items");

                                            if (
                                              document
                                                .getElementById(
                                                  "count-tot-items"
                                                )
                                                .classList.contains(
                                                  "show-tot-items"
                                                )
                                            ) {
                                              document
                                                .getElementById(
                                                  "count-tot-items"
                                                )
                                                .classList.remove(
                                                  "show-tot-items"
                                                );
                                              document
                                                .getElementById(
                                                  "count-tot-items"
                                                )
                                                .classList.add(
                                                  "show-tot-items"
                                                );
                                            } else {
                                              document
                                                .getElementById(
                                                  "count-tot-items"
                                                )
                                                .classList.add(
                                                  "show-tot-items"
                                                );
                                            }
                                          }, 300);
                                        }
                                      },
                                    });

                                    document
                                      .querySelectorAll(".quantity-field")
                                      .forEach((qf) => {
                                        let cart_id = parseInt(
                                          qf.getAttribute("fieldid")
                                        );
                                        let product_id = parseInt(
                                          qf.getAttribute("prodid")
                                        );

                                        qf.addEventListener(
                                          "input",
                                          function () {
                                            this.value = this.value.replace(
                                              /\D/g,
                                              ""
                                            );

                                            var number = parseInt(this.value);

                                            if (
                                              number < 1 ||
                                              this.value == ""
                                            ) {
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
                                                    'input[fieldid="' +
                                                      cart_id +
                                                      '"]'
                                                  ).value = number;
                                                  document.querySelector(
                                                    '[itprice="' +
                                                      cart_id +
                                                      '"]'
                                                  ).innerHTML =
                                                    final.totalprice.toFixed(2);

                                                  setTimeout(function () {
                                                    let subtotal = 0;

                                                    document
                                                      .querySelectorAll(
                                                        ".item-tots"
                                                      )
                                                      .forEach((price) => {
                                                        subtotal =
                                                          subtotal +
                                                          parseFloat(
                                                            price.textContent
                                                          );
                                                      });

                                                    document.getElementById(
                                                      "subtotal-price"
                                                    ).innerHTML =
                                                      subtotal.toFixed(2);
                                                  }, 50);
                                                } else {
                                                  console.error(
                                                    "Failed to update quantity."
                                                  );
                                                }
                                              },
                                            });

                                            console.log(this.value);
                                          }
                                        );
                                      });

                                    document
                                      .querySelectorAll(".add-q")
                                      .forEach((addb) => {
                                        let cart_id = parseInt(
                                          addb.getAttribute("cartid")
                                        );
                                        let product_id = parseInt(
                                          addb.getAttribute("prodid")
                                        );

                                        addb.addEventListener(
                                          "click",
                                          function () {
                                            let quantityField =
                                              document.querySelector(
                                                'input[fieldid="' +
                                                  cart_id +
                                                  '"]'
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
                                                  let final =
                                                    JSON.parse(qtyres);
                                                  if (
                                                    final.status == "success"
                                                  ) {
                                                    document.querySelector(
                                                      'input[fieldid="' +
                                                        cart_id +
                                                        '"]'
                                                    ).value = qty;
                                                    document.querySelector(
                                                      '[itprice="' +
                                                        cart_id +
                                                        '"]'
                                                    ).innerHTML =
                                                      final.totalprice.toFixed(
                                                        2
                                                      );

                                                    setTimeout(function () {
                                                      let subtotal = 0;

                                                      document
                                                        .querySelectorAll(
                                                          ".item-tots"
                                                        )
                                                        .forEach((price) => {
                                                          subtotal =
                                                            subtotal +
                                                            parseFloat(
                                                              price.textContent
                                                            );
                                                        });

                                                      document.getElementById(
                                                        "subtotal-price"
                                                      ).innerHTML =
                                                        subtotal.toFixed(2);
                                                    }, 50);
                                                  } else {
                                                    console.error(
                                                      "Failed to update quantity."
                                                    );
                                                  }
                                                },
                                              });
                                            }
                                          }
                                        );
                                      });

                                    document
                                      .querySelectorAll(".sub-q")
                                      .forEach((subb) => {
                                        let cart_id = parseInt(
                                          subb.getAttribute("cartid")
                                        );
                                        let product_id = parseInt(
                                          subb.getAttribute("prodid")
                                        );

                                        subb.addEventListener(
                                          "click",
                                          function () {
                                            let quantityField =
                                              document.querySelector(
                                                'input[fieldid="' +
                                                  cart_id +
                                                  '"]'
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
                                                  let final =
                                                    JSON.parse(qtyres);

                                                  if (
                                                    final.status == "success"
                                                  ) {
                                                    document.querySelector(
                                                      'input[fieldid="' +
                                                        cart_id +
                                                        '"]'
                                                    ).value = qty;
                                                    document.querySelector(
                                                      '[itprice="' +
                                                        cart_id +
                                                        '"]'
                                                    ).innerHTML =
                                                      final.totalprice.toFixed(
                                                        2
                                                      );

                                                    setTimeout(function () {
                                                      let subtotal = 0;

                                                      document
                                                        .querySelectorAll(
                                                          ".item-tots"
                                                        )
                                                        .forEach((price) => {
                                                          subtotal =
                                                            subtotal +
                                                            parseFloat(
                                                              price.textContent
                                                            );
                                                        });

                                                      document.getElementById(
                                                        "subtotal-price"
                                                      ).innerHTML =
                                                        subtotal.toFixed(2);
                                                    }, 50);
                                                  } else {
                                                    console.error(
                                                      "Failed to update quantity."
                                                    );
                                                  }
                                                },
                                              });
                                            }
                                          }
                                        );
                                      });

                                    document
                                      .querySelectorAll(".remove-cart-item")
                                      .forEach((trash) => {
                                        trash.addEventListener(
                                          "click",
                                          function () {
                                            $.ajax({
                                              url: "removeitem.php",
                                              method: "POST",
                                              data: {
                                                cartid:
                                                  trash.getAttribute("cartid"),
                                              },
                                              success: function (
                                                removeresponse
                                              ) {
                                                if (
                                                  removeresponse === "Deleted"
                                                ) {
                                                  let box =
                                                    document.querySelector(
                                                      '[boxid="' +
                                                        trash.getAttribute(
                                                          "cartid"
                                                        ) +
                                                        '"]'
                                                    );

                                                  if (box) {
                                                    const container =
                                                      document.getElementById(
                                                        "cart-items-container"
                                                      );

                                                    setTimeout(function () {
                                                      let boxheight =
                                                        box.offsetHeight + 20;

                                                      let initial =
                                                        container.offsetHeight;

                                                      container.style.height =
                                                        initial + "px";

                                                      box.style.transform =
                                                        "translateX(150%)";

                                                      let itemprice =
                                                        parseFloat(
                                                          document.querySelector(
                                                            '[itprice="' +
                                                              trash.getAttribute(
                                                                "cartid"
                                                              ) +
                                                              '"]'
                                                          ).textContent
                                                        );

                                                      let totalprice =
                                                        parseFloat(
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
                                                      document.getElementById(
                                                        "count-tot-items"
                                                      ).innerHTML = carttot;
                                                      setTimeout(function () {
                                                        setTimeout(function () {
                                                          box.parentNode.removeChild(
                                                            box
                                                          );

                                                          const fcontainer =
                                                            document.getElementById(
                                                              "cart-items-container"
                                                            );

                                                          let final =
                                                            container.offsetHeight -
                                                            boxheight;

                                                          fcontainer.style.height =
                                                            final + "px";

                                                          setTimeout(
                                                            function () {
                                                              fcontainer.style.removeProperty(
                                                                "height"
                                                              );
                                                            },
                                                            500
                                                          );
                                                        }, 30);
                                                      }, 400);
                                                    }, 100);
                                                  }
                                                }
                                              },
                                            });
                                          }
                                        );
                                      });
                                  }, 100);

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
                                }
                              );

                              setTimeout(function () {
                                cartCont.style.transform = "translateX(0%)";
                              }, 25);
                            } else {
                              document.getElementById("qty-field").value = 1;
                              document.getElementById("cart-button").click();
                            }
                          },
                        });
                      }
                    } else {
                      alert("Not exist: " + sharraine);
                    }
                  },
                });
              }
            },
          });
        }
      },
    });
  });

  document
    .getElementById("checkoutcart")
    .addEventListener("click", function () {
        $.ajax({
            url: "check_login.php",
            method: "GET",
            dataType: "json",
            success: function (response) {
              var isLoggedIn = response.isLoggedIn;
                
              var quantity = document.getElementById('qty-field').value;
              var prodid =   document.getElementById("checkoutcart").getAttribute('prodid');
              var prodprice = document.getElementById("checkoutcart").getAttribute('price');
                if (isLoggedIn) {
                    
                    $.ajax({
                        url: 'php-addons/checkoutfunction.php',
                        data: {
                            quantity: quantity,
                            prodid: prodid,
                            prodprice: prodprice
                        },
                        method: "POST",
                        success: function(response) {
                            console.log(response);
                            if (response) {
                        
                            } else {
                          
                            }
                        }
                    });

                }
            },
          });
    });

  document.getElementById("cart-button").addEventListener("click", function () {
    const cartCont = document.getElementById("cartContainer");
    if (cartCont.classList.contains("d-none")) {
      cartCont.style.transform = "translateX(150%)";
      cartCont.classList.remove("d-none");
      cartCont.classList.add("d-block");

      setTimeout(function () {
        cartCont.style.transform = "translateX(0%)";

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
                                ).innerHTML = final.totalprice.toFixed(2);

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
                                ).innerHTML = final.totalprice.toFixed(2);

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
                                ).innerHTML = final.totalprice.toFixed(2);

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
                                      document.getElementById("subtotal-price")
                                        .textContent
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
                                    document.getElementById(
                                      "count-tot-items"
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

                    document.querySelectorAll(".item-tots").forEach((price) => {
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

  document
    .getElementById("search-field")
    .addEventListener("keyup", function () {
      if (document.getElementById("search-field").value !== "") {
        console.log(document.getElementById("search-field").value);
        $.ajax({
          url: "loadsearcheditem.php",
          data: {
            search: document.getElementById("search-field").value,
          },
          success: function (items) {
            const parent = document.getElementById("prompt-cont");

            while (parent.firstChild) {
              parent.removeChild(parent.firstChild);
            }

            if (!parent.hasChildNodes()) {
              setTimeout(function () {
                const parsed = JSON.parse(items);

                for (let i = 0; i < items.length; i++) {
                  const name = parsed[i].name;
                  const id = parsed[i].product_id;

                  const parent = document.getElementById("prompt-cont");

                  const maindiv = document.createElement("div");
                  maindiv.classList.add("prompt-box");

                  const childdiv = document.createElement("div");
                  childdiv.classList.add("word-box", "px-3");

                  const span = document.createElement("span");

                  span.innerHTML =
                    '<i class="fa-solid fa-magnifying-glass mg-item"></i>' +
                    name;

                  childdiv.appendChild(span);

                  maindiv.appendChild(childdiv);

                  parent.appendChild(maindiv);

                  maindiv.addEventListener("click", function () {
                    window.location.href = "products?id=" + id;
                  });
                }
              }, 50);
            } else {
            }
          },
        });
      }
    });

  document
    .getElementById("search-icon-button")
    .addEventListener("click", function () {
      let scont = document.getElementById("search-container");

      if (scont.classList.contains("d-none")) {
        scont.style.opacity = "0";
        scont.classList.remove("d-none");

        setTimeout(function () {
          scont.style.opacity = "1";
        }, 30);
      }
    });

  document
    .getElementById("close-search")
    .addEventListener("click", function () {
      let scont = document.getElementById("search-container");

      if (!scont.classList.contains("d-none")) {
        scont.style.opacity = "0";

        setTimeout(function () {
          scont.classList.add("d-none");
        }, 100);
      }
    });

  document.getElementById("user-box").style.transform = "translateX(150%)";
});
