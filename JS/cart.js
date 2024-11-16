const checkoutbox = document.getElementById("checkout-box");
const items = document.querySelectorAll(".check-item");

document
  .getElementById("select-all-button")
  .addEventListener("click", function () {
    let isAllClicked = true;

    for (let i = 0; i < items.length; i++) {
      if (!items[i].checked) {
        isAllClicked = false;
      }
    }

    if (isAllClicked) {
      document.querySelectorAll(".check-item").forEach((element) => {
        element.click();
      });
    } else {
      document.querySelectorAll(".check-item").forEach((element) => {
        if (!element.checked) {
          element.click();
        }
      });
    }
  });

document.querySelectorAll(".check-item").forEach((radiobutton) => {
  radiobutton.addEventListener("click", function () {
    let nochecked = true;
    let numberofselected = 0;

    for (let i = 0; i < items.length; i++) {
      if (items[i].checked) {
        numberofselected++;
        if (!checkoutbox.classList.contains("show")) {
          checkoutbox.classList.add("show");
        }

        nochecked = false;
      }
    }

    document.getElementById("item-counter").innerHTML = numberofselected;

    if (nochecked) {
      if (checkoutbox.classList.contains("show")) {
        checkoutbox.classList.remove("show");
      }
    }

    const itemchecked = radiobutton.value;
    let totalprice = 0;

    if (!radiobutton.checked) {
      if (document.getElementById("select-all-button").checked) {
        document.getElementById("select-all-button").checked = false;
      }

      const gettotprice = parseFloat(
        document.querySelector('span[totalpriceof="' + itemchecked + '"]')
          .textContent
      );
      document.getElementById("total-price").innerHTML = (
        parseFloat(document.getElementById("total-price").textContent) -
        gettotprice
      ).toFixed(2);
    } else {
      const gettotprice = parseFloat(
        document.querySelector('span[totalpriceof="' + itemchecked + '"]')
          .textContent
      );
      document.getElementById("total-price").innerHTML = (
        parseFloat(document.getElementById("total-price").textContent) +
        gettotprice
      ).toFixed(2);
    }

    let isAllChecked = true;

    for (let h = 0; h < items.length; h++) {
      if (!items[h].checked) {
        isAllChecked = false;

        break;
      }
    }

    if (isAllChecked) {
      document.getElementById("select-all-button").checked = true;
    }
  });
});

document.querySelectorAll(".add-btn").forEach((element) => {
  element.addEventListener("click", function () {
    let cart_id = parseInt(element.getAttribute("fieldid"));
    let inputfield = document.querySelector('input[fieldid="' + cart_id + '"]');
    let unitprice = parseFloat(
      document.querySelector('span[unitpriceof="' + cart_id + '"]').textContent
    );
    let totalpriceof = document.querySelector(
      'span[totalpriceof="' + cart_id + '"]'
    );

    let totalprice = 0;

    const stocksvalue = parseInt(
      document.querySelector('span[stocksid="' + cart_id + '"]').textContent
    );
    if (stocksvalue > inputfield.value) {
      inputfield.value = parseInt(inputfield.value) + 1;

      totalprice = inputfield.value * unitprice;

      $.ajax({
        url: "php-addons/updatecartqtyprice.php",
        data: {
          quantity: inputfield.value,
          unitprice: unitprice,
          cartid: cart_id,
        },
        method: "POST",
        success: function (response) {

          if (response) {
            totalpriceof.innerHTML = totalprice.toFixed(2);
          }
        },
      });

      const checkbox = document.querySelector('input[value="' + cart_id + '"');

      if (checkbox.checked) {

        let distinctprice = 0.0;

        document.querySelectorAll(".check-item").forEach((rb) => {
          if (rb.checked && rb.value != cart_id) {
            let cid = rb.value;

            const gettot = parseFloat(
              document.querySelector('span[totalpriceof="' + cid + '"]')
                .textContent
            );

            distinctprice += gettot;
          }
        });

        document.getElementById("total-price").innerHTML = (
          distinctprice + totalprice
        ).toFixed(2);
      } else {
        console.log("This is unchecked");
      }
    } else {
    }
  });
});

document.querySelectorAll(".sub-btn").forEach((element) => {
  element.addEventListener("click", function () {
    let cart_id = parseInt(element.getAttribute("fieldid"));
    let inputfield = document.querySelector('input[fieldid="' + cart_id + '"]');
    let unitprice = parseFloat(
      document.querySelector('span[unitpriceof="' + cart_id + '"]').textContent
    );
    let totalpriceof = document.querySelector(
      'span[totalpriceof="' + cart_id + '"]'
    );

    let totalprice = 0;

    if (inputfield.value > 1) {
      inputfield.value = parseInt(inputfield.value) - 1;

      totalprice = inputfield.value * unitprice;
      
      $.ajax({
        url: "php-addons/updatecartqtyprice.php",
        data: {
          quantity: inputfield.value,
          unitprice: unitprice,
          cartid: cart_id,
        },
        method: "POST",
        success: function (response) {

          if (response) {
            totalpriceof.innerHTML = totalprice.toFixed(2);
          }
        },
      });

      const checkbox = document.querySelector('input[value="' + cart_id + '"');

      if (checkbox.checked) {

        let distinctprice = 0.0;

        document.querySelectorAll(".check-item").forEach((rb) => {
          if (rb.checked && rb.value != cart_id) {
            let cid = rb.value;

            const gettot = parseFloat(
              document.querySelector('span[totalpriceof="' + cid + '"]')
                .textContent
            );

            distinctprice += gettot;
          }
        });

        document.getElementById("total-price").innerHTML = (
          distinctprice + totalprice
        ).toFixed(2);
      } else {
        console.log("This is unchecked");
      }
    } else {
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const qtyfields = document.querySelectorAll(".quantity-field");

  qtyfields.forEach(function (field) {
    field.addEventListener("input", function () {
      this.value = this.value.replace(/[^0-9]/g, "1");
    });
  });

  for (let k = 0; k < qtyfields.length; k++) {
    let field = qtyfields[k];

    let cart_id = parseInt(field.getAttribute("fieldid"));

    const stocksvalue = parseInt(
      document.querySelector('span[stocksid="' + cart_id + '"]').textContent
    );

    let unitprice = parseFloat(
      document.querySelector('span[unitpriceof="' + cart_id + '"]').textContent
    );
    let totalpriceof = document.querySelector(
      'span[totalpriceof="' + cart_id + '"]'
    );

    field.addEventListener("keyup", function () {
      if (!(field.value <= stocksvalue)) {
        field.value = stocksvalue;
      }

      let totalprice = unitprice * parseInt(field.value);

      $.ajax({
        url: "php-addons/updatecartqtyprice.php",
        data: {
          quantity: field.value,
          unitprice: unitprice,
          cartid: cart_id,
        },
        method: "POST",
        success: function (response) {

          if (response) {
            totalpriceof.innerHTML = totalprice.toFixed(2);
          }
        },
      });

      const checkbox = document.querySelector('input[value="' + cart_id + '"');

      if (checkbox.checked) {

        let distinctprice = 0.0;

        document.querySelectorAll(".check-item").forEach((rb) => {
          if (rb.checked && rb.value != cart_id) {
            let cid = rb.value;

            const gettot = parseFloat(
              document.querySelector('span[totalpriceof="' + cid + '"]')
                .textContent
            );

            distinctprice += gettot;
          }
        });

        document.getElementById("total-price").innerHTML = (
          distinctprice + totalprice
        ).toFixed(2);
      } else {
        console.log("This is unchecked");
      }
    });
  }

  document.getElementById('checkout').addEventListener('click', function () {
  
    let items = [];

    document.querySelectorAll('.check-item').forEach(box => {
        if (box.checked) {
            items.push(box.value);   
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
  })

  alert(11);
});
