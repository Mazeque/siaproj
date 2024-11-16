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


  setTimeout(function () {
    document
      .querySelectorAll(".add-cart")
      .forEach((button) => {
        button.addEventListener("click", function () {
          $.ajax({
            url: "check_login.php",
            method: "GET",
            dataType: "json",
            success: function (response) {
              var isLoggedIn = response.isLoggedIn;

              if (isLoggedIn) {
                $.ajax({
                  url: "addtocart.php",
                  method: "POST",
                  data: {
                    userid: response.user_id,
                    productid: button.getAttribute("prodid"),
                    unitprice: button.getAttribute("price"),
                  },
                  success: function () {
                    if (cart.classList.contains("d-none")) {
                      cart.style.transform = "translateX(150%)";
                      cart.classList.remove("d-none");
                      cart.classList.add("d-block");

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
                                let limit = parseInt(
                                  qf.getAttribute("stocks")
                                );

                                qf.addEventListener(
                                  "input",
                                  function () {
                                    this.value =
                                      this.value.replace(
                                        /\D/g,
                                        ""
                                      );
                                    var number = parseInt(
                                      this.value
                                    );

                                    if (
                                      isNaN(number) ||
                                      this.value === ""
                                    ) {
                                      qf.value = 1;
                                    } else {
                                      qf.value = number;
                                    }

                                    if (number > limit) {
                                      this.value =
                                        limit.toString();
                                    }

                                    var self = this;

                                    setTimeout(function () {
                                      $.ajax({
                                        url: "quantity.php",
                                        method: "POST",
                                        data: {
                                          quantity: parseInt(
                                            self.value
                                          ),
                                          product_id: product_id,
                                          cart_id: cart_id,
                                          method: "FIELD",
                                        },
                                        success: function (fres) {
                                          let final =
                                            JSON.parse(fres);
                                          if (
                                            final.status ==
                                            "success"
                                          ) {
                                            document.querySelector(
                                              'input[fieldid="' +
                                                cart_id +
                                                '"]'
                                            ).value = self.value;
                                            document.querySelector(
                                              '[itprice="' +
                                                cart_id +
                                                '"]'
                                            ).innerHTML =
                                              final.totalprice.toFixed(
                                                2
                                              );

                                            setTimeout(
                                              function () {
                                                let subtotal = 0;

                                                document
                                                  .querySelectorAll(
                                                    ".item-tots"
                                                  )
                                                  .forEach(
                                                    (price) => {
                                                      subtotal =
                                                        subtotal +
                                                        parseFloat(
                                                          price.textContent
                                                        );
                                                    }
                                                  );

                                                document.getElementById(
                                                  "subtotal-price"
                                                ).innerHTML =
                                                  subtotal.toFixed(
                                                    2
                                                  );
                                              },
                                              50
                                            );
                                          } else {
                                            console.error(
                                              "Failed to update quantity."
                                            );
                                          }
                                        },
                                      });
                                    }, 100);
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
                                      let qty =
                                        quantityField.value;

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
                                        success: function (
                                          qtyres
                                        ) {
                                          let final =
                                            JSON.parse(qtyres);
                                          if (
                                            final.status ==
                                            "success"
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

                                            setTimeout(
                                              function () {
                                                let subtotal = 0;

                                                document
                                                  .querySelectorAll(
                                                    ".item-tots"
                                                  )
                                                  .forEach(
                                                    (price) => {
                                                      subtotal =
                                                        subtotal +
                                                        parseFloat(
                                                          price.textContent
                                                        );
                                                    }
                                                  );

                                                document.getElementById(
                                                  "subtotal-price"
                                                ).innerHTML =
                                                  subtotal.toFixed(
                                                    2
                                                  );
                                              },
                                              50
                                            );
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
                                      let qty =
                                        quantityField.value;

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
                                        success: function (
                                          qtyres
                                        ) {
                                          let final =
                                            JSON.parse(qtyres);

                                          if (
                                            final.status ==
                                            "success"
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

                                            setTimeout(
                                              function () {
                                                let subtotal = 0;

                                                document
                                                  .querySelectorAll(
                                                    ".item-tots"
                                                  )
                                                  .forEach(
                                                    (price) => {
                                                      subtotal =
                                                        subtotal +
                                                        parseFloat(
                                                          price.textContent
                                                        );
                                                    }
                                                  );

                                                document.getElementById(
                                                  "subtotal-price"
                                                ).innerHTML =
                                                  subtotal.toFixed(
                                                    2
                                                  );
                                              },
                                              50
                                            );
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
                              .querySelectorAll(
                                ".remove-cart-item"
                              )
                              .forEach((trash) => {
                                trash.addEventListener(
                                  "click",
                                  function () {
                                    $.ajax({
                                      url: "removeitem.php",
                                      method: "POST",
                                      data: {
                                        cartid:
                                          trash.getAttribute(
                                            "cartid"
                                          ),
                                      },
                                      success: function (
                                        removeresponse
                                      ) {
                                        if (
                                          removeresponse ===
                                          "Deleted"
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

                                            setTimeout(
                                              function () {
                                                let boxheight =
                                                  box.offsetHeight +
                                                  20;

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
                                                  totalprice -
                                                  itemprice
                                                ).toFixed(2);

                                                let carttot =
                                                  parseInt(
                                                    document.getElementById(
                                                      "cart-total-items"
                                                    ).textContent
                                                  ) - 1;

                                                document.getElementById(
                                                  "cart-total-items"
                                                ).innerHTML =
                                                  carttot;
                                              
                                                setTimeout(
                                                  function () {
                                                    setTimeout(
                                                      function () {
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
                                                          final +
                                                          "px";

                                                        setTimeout(
                                                          function () {
                                                            fcontainer.style.removeProperty(
                                                              "height"
                                                            );
                                                          },
                                                          500
                                                        );
                                                      },
                                                      30
                                                    );
                                                  },
                                                  400
                                                );
                                              },
                                              100
                                            );
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
                        cart.style.transform = "translateX(0%)";
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
                                    this.value =
                                      this.value.replace(
                                        /\D/g,
                                        ""
                                      );

                                    var number = parseInt(
                                      this.value
                                    );

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
                                        let final =
                                          JSON.parse(fres);
                                        if (
                                          final.status ==
                                          "success"
                                        ) {
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
                                            final.totalprice.toFixed(
                                              2
                                            );

                                          setTimeout(function () {
                                            let subtotal = 0;

                                            document
                                              .querySelectorAll(
                                                ".item-tots"
                                              )
                                              .forEach(
                                                (price) => {
                                                  subtotal =
                                                    subtotal +
                                                    parseFloat(
                                                      price.textContent
                                                    );
                                                }
                                              );

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
                                      let qty =
                                        quantityField.value;

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
                                        success: function (
                                          qtyres
                                        ) {
                                          let final =
                                            JSON.parse(qtyres);
                                          if (
                                            final.status ==
                                            "success"
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

                                            setTimeout(
                                              function () {
                                                let subtotal = 0;

                                                document
                                                  .querySelectorAll(
                                                    ".item-tots"
                                                  )
                                                  .forEach(
                                                    (price) => {
                                                      subtotal =
                                                        subtotal +
                                                        parseFloat(
                                                          price.textContent
                                                        );
                                                    }
                                                  );

                                                document.getElementById(
                                                  "subtotal-price"
                                                ).innerHTML =
                                                  subtotal.toFixed(
                                                    2
                                                  );
                                              },
                                              50
                                            );
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
                                      let qty =
                                        quantityField.value;

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
                                        success: function (
                                          qtyres
                                        ) {
                                          let final =
                                            JSON.parse(qtyres);

                                          if (
                                            final.status ==
                                            "success"
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

                                            setTimeout(
                                              function () {
                                                let subtotal = 0;

                                                document
                                                  .querySelectorAll(
                                                    ".item-tots"
                                                  )
                                                  .forEach(
                                                    (price) => {
                                                      subtotal =
                                                        subtotal +
                                                        parseFloat(
                                                          price.textContent
                                                        );
                                                    }
                                                  );

                                                document.getElementById(
                                                  "subtotal-price"
                                                ).innerHTML =
                                                  subtotal.toFixed(
                                                    2
                                                  );
                                              },
                                              50
                                            );
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
                              .querySelectorAll(
                                ".remove-cart-item"
                              )
                              .forEach((trash) => {
                                trash.addEventListener(
                                  "click",
                                  function () {
                                    $.ajax({
                                      url: "removeitem.php",
                                      method: "POST",
                                      data: {
                                        cartid:
                                          trash.getAttribute(
                                            "cartid"
                                          ),
                                      },
                                      success: function (
                                        removeresponse
                                      ) {
                                        if (
                                          removeresponse ===
                                          "Deleted"
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

                                            setTimeout(
                                              function () {
                                                let boxheight =
                                                  box.offsetHeight +
                                                  20;

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
                                                  totalprice -
                                                  itemprice
                                                ).toFixed(2);

                                                let carttot =
                                                  parseInt(
                                                    document.getElementById(
                                                      "cart-total-items"
                                                    ).textContent
                                                  ) - 1;

                                                document.getElementById(
                                                  "cart-total-items"
                                                ).innerHTML =
                                                  carttot;
                                      
                                                setTimeout(
                                                  function () {
                                                    setTimeout(
                                                      function () {
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
                                                          final +
                                                          "px";

                                                        setTimeout(
                                                          function () {
                                                            fcontainer.style.removeProperty(
                                                              "height"
                                                            );
                                                          },
                                                          500
                                                        );
                                                      },
                                                      30
                                                    );
                                                  },
                                                  400
                                                );
                                              },
                                              100
                                            );
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
                        cart.style.transform = "translateX(0%)";
                      }, 25);
                    }
                  },
                });
              } else {
                console.log("Please log in to use this button.");
              }
            },
            error: function (xhr, status, error) {
              console.log("Error: " + error);
            },
          });
        });
      });
  }, 100);
});
