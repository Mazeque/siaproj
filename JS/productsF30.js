document.addEventListener("DOMContentLoaded", function () {
    var activefilter = 1;
    var defaultpage = 1;
    let isClicked = false;
  
    var currentcat;
    var curretname;
  
    var allprod = 0;
    var sections = 0;
  
    let cart = document.getElementById("cartContainer");
  
    document.getElementById("page-number").innerHTML = defaultpage;

    document.getElementById('search-field').addEventListener('keyup', function() {
        if (document.getElementById('search-field').value !== "") {
            console.log(document.getElementById('search-field').value);
            $.ajax({
                url: "loadsearcheditem.php",
                data: {
                    search: document.getElementById('search-field').value
                },
                success: function(items) {

                    const parent = document.getElementById('prompt-cont');

                    while (parent.firstChild) {
                        parent.removeChild(parent.firstChild);
                    }

                    if (!parent.hasChildNodes()) {
                        setTimeout(function() {
                            const parsed = JSON.parse(items);
                        
                        for (let i = 0; i < items.length; i++) {
                            const name = parsed[i].name;
                            const id = parsed[i].product_id;
    
                            const parent = document.getElementById('prompt-cont');
    
                            const maindiv = document.createElement('div');
                            maindiv.classList.add('prompt-box');
    
                            const childdiv = document.createElement('div');
                            childdiv.classList.add('word-box', 'px-3');
    
                            const span = document.createElement('span');
    
                            span.innerHTML = '<i class="fa-solid fa-magnifying-glass mg-item"></i>' + name;
    
                            childdiv.appendChild(span);
    
                            maindiv.appendChild(childdiv);
    
                            parent.appendChild(maindiv);

                            maindiv.addEventListener('click', function() {
                                window.location.href = "products?id=" + id;
                            });
    
                        }   
                        }, 50);
                    } else {
  
                    }


                }
                
            });
        }
    });

    document.getElementById('search-icon-button').addEventListener('click', function() {
        let scont = document.getElementById('search-container');

        if (scont.classList.contains('d-none')) {
            scont.style.opacity = "0";
            scont.classList.remove('d-none');

            setTimeout(function() {
                scont.style.opacity = "1";
            },30);
        }
    });

    document.getElementById('close-search').addEventListener('click', function() {
        let scont = document.getElementById('search-container');

        if (!scont.classList.contains('d-none')) {
            scont.style.opacity = "0";
            
            setTimeout(function() {
                scont.classList.add('d-none');
            },100);
        }
    });
  
    document
      .getElementById("previous-page")
      .addEventListener("click", function () {
        if (defaultpage > 1) {
  
          defaultpage--;
          document.getElementById("page-number").innerHTML = defaultpage;

          if (defaultpage === 1) {
            document.getElementById('previous-page').style.cursor = "default";
            document.getElementById('previous-page').style.opacity = "0";
        }
  
          $("#shop-content").load(
              "loadshop.php",
              {
                category: currentcat,
                name: curretname,
                sortby: activefilter,
                pagenum: defaultpage,
              },
              function () {
                  setTimeout(function () {
                      document.querySelectorAll(".view-item").forEach((button) => {
                        button.addEventListener("click", function () {
                          window.location.href =
                            "products?id=" + button.getAttribute("prodid");
                        });
                      });
                    }, 100);
            
                    setTimeout(function () {
                      document.querySelectorAll(".add-to-cart").forEach((button) => {
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
                                    productid: button.getAttribute("productid"),
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
                                                        .classList.contains(
                                                          "show-tot-items"
                                                        )
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
                                                let cart_id = parseInt(
                                                  qf.getAttribute("fieldid")
                                                );
                                                let product_id = parseInt(
                                                  qf.getAttribute("prodid")
                                                );
                                                let limit = parseInt(
                                                  qf.getAttribute("stocks")
                                                );
            
                                                qf.addEventListener("input", function () {
                                                  this.value = this.value.replace(
                                                    /\D/g,
                                                    ""
                                                  );
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
                                                            'input[fieldid="' +
                                                              cart_id +
                                                              '"]'
                                                          ).value = self.value;
                                                          document.querySelector(
                                                            '[itprice="' + cart_id + '"]'
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
                                                  }, 100);
                                                });
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
            
                                                addb.addEventListener("click", function () {
                                                  let quantityField =
                                                    document.querySelector(
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
                                                            'input[fieldid="' +
                                                              cart_id +
                                                              '"]'
                                                          ).value = qty;
                                                          document.querySelector(
                                                            '[itprice="' + cart_id + '"]'
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
                                                  }
                                                });
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
            
                                                subb.addEventListener("click", function () {
                                                  let quantityField =
                                                    document.querySelector(
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
                                                            'input[fieldid="' +
                                                              cart_id +
                                                              '"]'
                                                          ).value = qty;
                                                          document.querySelector(
                                                            '[itprice="' + cart_id + '"]'
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
                                                  }
                                                });
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
                                                      success: function (removeresponse) {
                                                        if (removeresponse === "Deleted") {
                                                          let box = document.querySelector(
                                                            '[boxid="' +
                                                              trash.getAttribute("cartid") +
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
            
                                                              let itemprice = parseFloat(
                                                                document.querySelector(
                                                                  '[itprice="' +
                                                                    trash.getAttribute(
                                                                      "cartid"
                                                                    ) +
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
                                                  subtotal + parseFloat(price.textContent);
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
                                                        .classList.contains(
                                                          "show-tot-items"
                                                        )
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
                                                let cart_id = parseInt(
                                                  qf.getAttribute("fieldid")
                                                );
                                                let product_id = parseInt(
                                                  qf.getAttribute("prodid")
                                                );
            
                                                qf.addEventListener("input", function () {
                                                  this.value = this.value.replace(
                                                    /\D/g,
                                                    ""
                                                  );
            
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
                                                        ).innerHTML =
                                                          final.totalprice.toFixed(2);
            
                                                        setTimeout(function () {
                                                          let subtotal = 0;
            
                                                          document
                                                            .querySelectorAll(".item-tots")
                                                            .forEach((price) => {
                                                              subtotal =
                                                                subtotal +
                                                                parseFloat(
                                                                  price.textContent
                                                                );
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
  
                                                });
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
            
                                                addb.addEventListener("click", function () {
                                                  let quantityField =
                                                    document.querySelector(
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
                                                            'input[fieldid="' +
                                                              cart_id +
                                                              '"]'
                                                          ).value = qty;
                                                          document.querySelector(
                                                            '[itprice="' + cart_id + '"]'
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
                                                  }
                                                });
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
            
                                                subb.addEventListener("click", function () {
                                                  let quantityField =
                                                    document.querySelector(
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
                                                            'input[fieldid="' +
                                                              cart_id +
                                                              '"]'
                                                          ).value = qty;
                                                          document.querySelector(
                                                            '[itprice="' + cart_id + '"]'
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
                                                  }
                                                });
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
                                                      success: function (removeresponse) {
                                                        if (removeresponse === "Deleted") {
                                                          let box = document.querySelector(
                                                            '[boxid="' +
                                                              trash.getAttribute("cartid") +
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
            
                                                              let itemprice = parseFloat(
                                                                document.querySelector(
                                                                  '[itprice="' +
                                                                    trash.getAttribute(
                                                                      "cartid"
                                                                    ) +
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
                                                  subtotal + parseFloat(price.textContent);
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
              }
            );
        }
      });
  
    document.getElementById("next-page").addEventListener("click", function () {
      if (defaultpage < sections) {
        defaultpage++;
        document.getElementById("page-number").innerHTML = defaultpage;

        document.getElementById('previous-page').style.opacity = "1";
        document.getElementById('previous-page').style.cursor = "pointer";
        
        $("#shop-content").load(
          "loadshop.php",
          {
            category: currentcat,
            name: curretname,
            sortby: activefilter,
            pagenum: defaultpage,
          },
          function () {
              setTimeout(function () {
                  document.querySelectorAll(".view-item").forEach((button) => {
                    button.addEventListener("click", function () {
                      window.location.href =
                        "products?id=" + button.getAttribute("prodid");
                    });
                  });
                }, 100);
        
                setTimeout(function () {
                  document.querySelectorAll(".add-to-cart").forEach((button) => {
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
                                productid: button.getAttribute("productid"),
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
                                                    .classList.contains(
                                                      "show-tot-items"
                                                    )
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
                                            let cart_id = parseInt(
                                              qf.getAttribute("fieldid")
                                            );
                                            let product_id = parseInt(
                                              qf.getAttribute("prodid")
                                            );
                                            let limit = parseInt(
                                              qf.getAttribute("stocks")
                                            );
        
                                            qf.addEventListener("input", function () {
                                              this.value = this.value.replace(
                                                /\D/g,
                                                ""
                                              );
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
                                                        'input[fieldid="' +
                                                          cart_id +
                                                          '"]'
                                                      ).value = self.value;
                                                      document.querySelector(
                                                        '[itprice="' + cart_id + '"]'
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
                                              }, 100);
                                            });
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
        
                                            addb.addEventListener("click", function () {
                                              let quantityField =
                                                document.querySelector(
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
                                                        'input[fieldid="' +
                                                          cart_id +
                                                          '"]'
                                                      ).value = qty;
                                                      document.querySelector(
                                                        '[itprice="' + cart_id + '"]'
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
                                              }
                                            });
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
        
                                            subb.addEventListener("click", function () {
                                              let quantityField =
                                                document.querySelector(
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
                                                        'input[fieldid="' +
                                                          cart_id +
                                                          '"]'
                                                      ).value = qty;
                                                      document.querySelector(
                                                        '[itprice="' + cart_id + '"]'
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
                                              }
                                            });
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
                                                  success: function (removeresponse) {
                                                    if (removeresponse === "Deleted") {
                                                      let box = document.querySelector(
                                                        '[boxid="' +
                                                          trash.getAttribute("cartid") +
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
        
                                                          let itemprice = parseFloat(
                                                            document.querySelector(
                                                              '[itprice="' +
                                                                trash.getAttribute(
                                                                  "cartid"
                                                                ) +
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
                                              subtotal + parseFloat(price.textContent);
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
                                                    .classList.contains(
                                                      "show-tot-items"
                                                    )
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
                                            let cart_id = parseInt(
                                              qf.getAttribute("fieldid")
                                            );
                                            let product_id = parseInt(
                                              qf.getAttribute("prodid")
                                            );
        
                                            qf.addEventListener("input", function () {
                                              this.value = this.value.replace(
                                                /\D/g,
                                                ""
                                              );
        
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
                                                    ).innerHTML =
                                                      final.totalprice.toFixed(2);
        
                                                    setTimeout(function () {
                                                      let subtotal = 0;
        
                                                      document
                                                        .querySelectorAll(".item-tots")
                                                        .forEach((price) => {
                                                          subtotal =
                                                            subtotal +
                                                            parseFloat(
                                                              price.textContent
                                                            );
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
  
                                            });
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
        
                                            addb.addEventListener("click", function () {
                                              let quantityField =
                                                document.querySelector(
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
                                                        'input[fieldid="' +
                                                          cart_id +
                                                          '"]'
                                                      ).value = qty;
                                                      document.querySelector(
                                                        '[itprice="' + cart_id + '"]'
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
                                              }
                                            });
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
        
                                            subb.addEventListener("click", function () {
                                              let quantityField =
                                                document.querySelector(
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
                                                        'input[fieldid="' +
                                                          cart_id +
                                                          '"]'
                                                      ).value = qty;
                                                      document.querySelector(
                                                        '[itprice="' + cart_id + '"]'
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
                                              }
                                            });
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
                                                  success: function (removeresponse) {
                                                    if (removeresponse === "Deleted") {
                                                      let box = document.querySelector(
                                                        '[boxid="' +
                                                          trash.getAttribute("cartid") +
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
        
                                                          let itemprice = parseFloat(
                                                            document.querySelector(
                                                              '[itprice="' +
                                                                trash.getAttribute(
                                                                  "cartid"
                                                                ) +
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
                                              subtotal + parseFloat(price.textContent);
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
          }
        );
      }
    });
  
    document.querySelectorAll(".category-title").forEach((element) => {
      element.addEventListener("click", function () {
        defaultpage = 1;
        document.getElementById("page-number").innerHTML = defaultpage;
  
        let category = element.getAttribute("category");
        let name = element.getAttribute("name");
  
        currentcat = category;
        curretname = name;

        if (defaultpage === 1) {
      
            document.getElementById('previous-page').style.cursor = "default";
            document.getElementById('previous-page').style.opacity = "0";
        }
  
        document.querySelectorAll(".category-title").forEach((sub) => {
          if (sub.classList.contains("active-title")) {
            sub.classList.remove("active-title");
          }
        });
  
        document.getElementById("title-cat-box").style.opacity = "0";
        document.getElementById("tot-title-cat").style.opacity = "0";
  
        setTimeout(function () {
          document.getElementById("title-cat-box").style.transform =
            "translateX(-10%)";
          document.getElementById("tot-title-cat").style.transform =
            "translateX(20%)";
  
          setTimeout(function () {
            document.getElementById("title-cat").innerHTML = element.textContent;
            document.getElementById("dropdown-toggle").innerHTML =
              element.textContent;
  
            document.getElementById("title-cat-box").style.transform =
              "translateX(0%)";
            document.getElementById("title-cat-box").style.opacity = "1";
  
            setTimeout(function () {
              document.getElementById("tot-title-cat").style.transform =
                "translateX(0%)";
              document.getElementById("tot-title-cat").style.opacity = "1";
  
              document.getElementById("tot-title-cat").innerHTML =
                element.textContent;
  
              $.ajax({
                url: "countcartcat.php",
                method: "POST",
                data: {
                  category_id: category,
                },
                success: function (countres) {
                  if (countres) {
                    document.getElementById("tot-title-cat").innerHTML =
                      countres + " product(s)";
  
                    allprod = parseInt(countres);
  
                    sections = Math.ceil(allprod / 16);
                  }
                },
              });
            }, 800);
          }, 200);
        }, 80);
  
        document
          .getElementById("shop-content")
          .classList.remove("shop-transition");
  
        setTimeout(function () {
          document
            .getElementById("shop-content")
            .classList.add("shop-transition");
  
          element.classList.add("active-title");
  
          $("#shop-content").load(
            "loadshop.php",
            {
              category: category,
              name: name,
              sortby: activefilter,
              pagenum: defaultpage,
            },
            function () {
              
            }
          );
  
          setTimeout(function () {
            document.querySelectorAll(".view-item").forEach((button) => {
              button.addEventListener("click", function () {
                window.location.href =
                  "products?id=" + button.getAttribute("prodid");
              });
            });
          }, 100);
  
          setTimeout(function () {
            document.querySelectorAll(".add-to-cart").forEach((button) => {
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
                          productid: button.getAttribute("productid"),
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
                                              .classList.contains(
                                                "show-tot-items"
                                              )
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
                                      let cart_id = parseInt(
                                        qf.getAttribute("fieldid")
                                      );
                                      let product_id = parseInt(
                                        qf.getAttribute("prodid")
                                      );
                                      let limit = parseInt(
                                        qf.getAttribute("stocks")
                                      );
  
                                      qf.addEventListener("input", function () {
                                        this.value = this.value.replace(
                                          /\D/g,
                                          ""
                                        );
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
                                                  'input[fieldid="' +
                                                    cart_id +
                                                    '"]'
                                                ).value = self.value;
                                                document.querySelector(
                                                  '[itprice="' + cart_id + '"]'
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
                                        }, 100);
                                      });
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
  
                                      addb.addEventListener("click", function () {
                                        let quantityField =
                                          document.querySelector(
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
                                                  'input[fieldid="' +
                                                    cart_id +
                                                    '"]'
                                                ).value = qty;
                                                document.querySelector(
                                                  '[itprice="' + cart_id + '"]'
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
                                        }
                                      });
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
  
                                      subb.addEventListener("click", function () {
                                        let quantityField =
                                          document.querySelector(
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
                                                  'input[fieldid="' +
                                                    cart_id +
                                                    '"]'
                                                ).value = qty;
                                                document.querySelector(
                                                  '[itprice="' + cart_id + '"]'
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
                                        }
                                      });
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
                                            success: function (removeresponse) {
                                              if (removeresponse === "Deleted") {
                                                let box = document.querySelector(
                                                  '[boxid="' +
                                                    trash.getAttribute("cartid") +
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
  
                                                    let itemprice = parseFloat(
                                                      document.querySelector(
                                                        '[itprice="' +
                                                          trash.getAttribute(
                                                            "cartid"
                                                          ) +
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
                                        subtotal + parseFloat(price.textContent);
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
                                              .classList.contains(
                                                "show-tot-items"
                                              )
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
                                      let cart_id = parseInt(
                                        qf.getAttribute("fieldid")
                                      );
                                      let product_id = parseInt(
                                        qf.getAttribute("prodid")
                                      );
  
                                      qf.addEventListener("input", function () {
                                        this.value = this.value.replace(
                                          /\D/g,
                                          ""
                                        );
  
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
                                              ).innerHTML =
                                                final.totalprice.toFixed(2);
  
                                              setTimeout(function () {
                                                let subtotal = 0;
  
                                                document
                                                  .querySelectorAll(".item-tots")
                                                  .forEach((price) => {
                                                    subtotal =
                                                      subtotal +
                                                      parseFloat(
                                                        price.textContent
                                                      );
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
  
  
                                      });
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
  
                                      addb.addEventListener("click", function () {
                                        let quantityField =
                                          document.querySelector(
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
                                                  'input[fieldid="' +
                                                    cart_id +
                                                    '"]'
                                                ).value = qty;
                                                document.querySelector(
                                                  '[itprice="' + cart_id + '"]'
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
                                        }
                                      });
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
  
                                      subb.addEventListener("click", function () {
                                        let quantityField =
                                          document.querySelector(
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
                                                  'input[fieldid="' +
                                                    cart_id +
                                                    '"]'
                                                ).value = qty;
                                                document.querySelector(
                                                  '[itprice="' + cart_id + '"]'
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
                                        }
                                      });
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
                                            success: function (removeresponse) {
                                              if (removeresponse === "Deleted") {
                                                let box = document.querySelector(
                                                  '[boxid="' +
                                                    trash.getAttribute("cartid") +
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
  
                                                    let itemprice = parseFloat(
                                                      document.querySelector(
                                                        '[itprice="' +
                                                          trash.getAttribute(
                                                            "cartid"
                                                          ) +
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
                                        subtotal + parseFloat(price.textContent);
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
        }, 100);
      });
  
      if (!isClicked) {
        element.click();
  
        isClicked = true;
      }
    });
  
    document.querySelectorAll(".dropdown-item").forEach((element) => {
      element.removeEventListener("click", handleClick);
      element.addEventListener("click", handleClick);
    });
  
    function handleClick() {
      let element = this;
      let elementID = element.getAttribute("category");
  
      document.querySelectorAll(".category-title").forEach((main) => {
        let mainID = main.getAttribute("category");
        if (elementID === mainID) {
          main.click();
  
          document.getElementById("dropdown-toggle").innerHTML =
            main.getAttribute("name");
          return;
        }
      });
    }
  

  
    // PREVIOUS BUTTON
    document
      .getElementById("previous-button")
      .addEventListener("click", function () {
        document.getElementById("previous-button").disabled = true;
        document.getElementById("next-button").disabled = true;
        const elements = document.querySelectorAll(".main-cont-sort");
        const elementsCount = elements.length;
  
        for (let i = 0; i < elementsCount; i++) {
          const element = elements[i];
  
          if (
            parseInt(element.getAttribute("filter")) === activefilter &&
            activefilter > 1
          ) {
            setTimeout(function () {
              activefilter--;
  
              element.classList.remove("display-filter");
  
              element.classList.remove("removenext");
  
              document
                .querySelector('[filter="' + activefilter + '"]')
                .classList.add("display-filter");
              document.querySelector(
                '[filter="' + activefilter + '"]'
              ).style.transform = "translateX(-50%)";
              document.querySelector(
                '[filter="' + activefilter + '"]'
              ).style.opacity = "0";
  
              setTimeout(function () {
                document
                  .querySelector('[filter="' + activefilter + '"]')
                  .classList.add("addnext");
  
                setTimeout(function () {
                  document
                    .querySelector('[filter="' + activefilter + '"]')
                    .style.removeProperty("transform");
                  document
                    .querySelector('[filter="' + activefilter + '"]')
                    .style.removeProperty("opacity");
  
                  document
                    .querySelector('[filter="' + activefilter + '"]')
                    .classList.remove("addnext");
                }, 5);
              }, 5);
  
              document.getElementById("previous-button").disabled = false;
              document.getElementById("next-button").disabled = false;
  
              document.getElementById("shop-content").style.opacity = "0";
  
              setTimeout(function () {
                $("#shop-content").load(
                  "loadshop.php",
                  {
                    category: document
                      .querySelector(".active-title")
                      .getAttribute("category"),
                    name: document
                      .querySelector(".active-title")
                      .getAttribute("name"),
                    sortby: activefilter,
                    pagenum: defaultpage,
                  },
                  function () {
                    document.getElementById("shop-content").style.opacity = "1";
                  }
                );
              }, 300);
  
              return;
            }, 100);
          } else if (
            parseInt(element.getAttribute("filter")) === activefilter &&
            activefilter == 1
          ) {
            element.classList.add("removenext");
  
            setTimeout(function () {
              element.classList.remove("display-filter");
  
              activefilter = 3;
  
              element.classList.remove("removenext");
  
              document
                .querySelector('[filter="' + activefilter + '"]')
                .classList.add("display-filter");
              document.querySelector(
                '[filter="' + activefilter + '"]'
              ).style.transform = "translateX(-50%)";
              document.querySelector(
                '[filter="' + activefilter + '"]'
              ).style.opacity = "0";
  
              setTimeout(function () {
                document
                  .querySelector('[filter="' + activefilter + '"]')
                  .classList.add("addnext");
  
                setTimeout(function () {
                  document
                    .querySelector('[filter="' + activefilter + '"]')
                    .style.removeProperty("transform");
                  document
                    .querySelector('[filter="' + activefilter + '"]')
                    .style.removeProperty("opacity");
  
                  document
                    .querySelector('[filter="' + activefilter + '"]')
                    .classList.remove("addnext");
                }, 5);
              }, 5);
  
              document.getElementById("previous-button").disabled = false;
              document.getElementById("next-button").disabled = false;
  
              document.getElementById("shop-content").style.opacity = "0";
  
              setTimeout(function () {
                $("#shop-content").load(
                  "loadshop.php",
                  {
                    category: document
                      .querySelector(".active-title")
                      .getAttribute("category"),
                    name: document
                      .querySelector(".active-title")
                      .getAttribute("name"),
                    sortby: activefilter,
                    pagenum: defaultpage,
                  },
                  function () {
                    document.getElementById("shop-content").style.opacity = "1";
                  }
                );
              }, 300);
              return;
            }, 10);
          }
        }
      });
  
    // NEXT BUTTON
    document.getElementById("next-button").addEventListener("click", function () {
      document.getElementById("previous-button").disabled = true;
      document.getElementById("next-button").disabled = true;
      const elements = document.querySelectorAll(".main-cont-sort");
      const elementsCount = elements.length;
  
      for (let i = 0; i < elementsCount; i++) {
        const element = elements[i];
  
        if (
          parseInt(element.getAttribute("filter")) === activefilter &&
          activefilter < 3
        ) {
          element.classList.add("removenext");
  
          setTimeout(function () {
            activefilter++;
  
            element.classList.remove("display-filter");
  
            element.classList.remove("removenext");
  
            document
              .querySelector('[filter="' + activefilter + '"]')
              .classList.add("display-filter");
            document.querySelector(
              '[filter="' + activefilter + '"]'
            ).style.transform = "translateX(50%)";
            document.querySelector(
              '[filter="' + activefilter + '"]'
            ).style.opacity = "0";
  
            setTimeout(function () {
              document
                .querySelector('[filter="' + activefilter + '"]')
                .classList.add("addnext");
  
              setTimeout(function () {
                document
                  .querySelector('[filter="' + activefilter + '"]')
                  .style.removeProperty("transform");
                document
                  .querySelector('[filter="' + activefilter + '"]')
                  .style.removeProperty("opacity");
  
                document
                  .querySelector('[filter="' + activefilter + '"]')
                  .classList.remove("addnext");
              }, 5);
            }, 5);
  
            document.getElementById("previous-button").disabled = false;
            document.getElementById("next-button").disabled = false;
  
            document.getElementById("shop-content").style.opacity = "0";
  
            setTimeout(function () {
              $("#shop-content").load(
                "loadshop.php",
                {
                  category: document
                    .querySelector(".active-title")
                    .getAttribute("category"),
                  name: document
                    .querySelector(".active-title")
                    .getAttribute("name"),
                  sortby: activefilter,
                  pagenum: defaultpage,
                },
                function () {
                  document.getElementById("shop-content").style.opacity = "1";
  
                  setTimeout(function () {
                    document.querySelectorAll(".view-item").forEach((button) => {
                      button.addEventListener("click", function () {
                        window.location.href =
                          "products?id=" + button.getAttribute("prodid");
                      });
                    });
                  }, 100);
  
                  setTimeout(function () {
                    document
                      .querySelectorAll(".add-to-cart")
                      .forEach((button) => {
                        button.addEventListener("click", function () {
                          $.ajax({
                            url: "check_login.php",
                            method: "GET",
                            dataType: "json",
                            success: function (response) {
                              var isLoggedIn = response.isLoggedIn;
  
                              if (isLoggedIn) {
                                // alert(response.user_id);
  
                                $.ajax({
                                  url: "addtocart.php",
                                  method: "POST",
                                  data: {
                                    userid: response.user_id,
                                    productid: button.getAttribute("productid"),
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
                                                  document.getElementById(
                                                    "count-tot-items"
                                                  ).innerHTML = cartresponse;
                                                  setTimeout(function () {
                                                    document
                                                      .getElementById(
                                                        "count-tot-items"
                                                      )
                                                      .classList.add(
                                                        "show-tot-items"
                                                      );
  
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
                                                                document.getElementById(
                                                                  "count-tot-items"
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
                                                  document.getElementById(
                                                    "count-tot-items"
                                                  ).innerHTML = cartresponse;
                                                  setTimeout(function () {
                                                    document
                                                      .getElementById(
                                                        "count-tot-items"
                                                      )
                                                      .classList.add(
                                                        "show-tot-items"
                                                      );
  
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
                                                                document.getElementById(
                                                                  "count-tot-items"
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
                }
              );
            }, 300);
            return;
          }, 100);
        } else if (
          parseInt(element.getAttribute("filter")) === activefilter &&
          activefilter == 3
        ) {
          element.classList.add("removenext");
  
          setTimeout(function () {
            element.classList.remove("display-filter");
  
            activefilter = 1;
  
            element.classList.remove("removenext");
  
            document
              .querySelector('[filter="' + activefilter + '"]')
              .classList.add("display-filter");
            document.querySelector(
              '[filter="' + activefilter + '"]'
            ).style.transform = "translateX(50%)";
            document.querySelector(
              '[filter="' + activefilter + '"]'
            ).style.opacity = "0";
  
            setTimeout(function () {
              document
                .querySelector('[filter="' + activefilter + '"]')
                .classList.add("addnext");
  
              setTimeout(function () {
                document
                  .querySelector('[filter="' + activefilter + '"]')
                  .style.removeProperty("transform");
                document
                  .querySelector('[filter="' + activefilter + '"]')
                  .style.removeProperty("opacity");
  
                document
                  .querySelector('[filter="' + activefilter + '"]')
                  .classList.remove("addnext");
              }, 5);
            }, 5);
  
            document.getElementById("previous-button").disabled = false;
            document.getElementById("next-button").disabled = false;
  
            document.getElementById("shop-content").style.opacity = "0";
  
            setTimeout(function () {
              $("#shop-content").load(
                "loadshop.php",
                {
                  category: document
                    .querySelector(".active-title")
                    .getAttribute("category"),
                  name: document
                    .querySelector(".active-title")
                    .getAttribute("name"),
                  sortby: activefilter,
                  pagenum: defaultpage,
                },
                function () {
                  document.getElementById("shop-content").style.opacity = "1";
                }
              );
            }, 300);
            return;
          }, 10);
        }
      }
    });
  
    function donebutton(event) {
      let button = document.getElementById("login-button");
      button.innerHTML = "<div class='loader'></div>";
    }


  });
  