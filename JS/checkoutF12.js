var vouchers = [];
var currentvoucher;
var currentvid = 0;
var currentelement;
var totalprice = 0;
var selectedpm;
var selectedpmid;

document.addEventListener("DOMContentLoaded", function () {
  totalprice = document.getElementById("total").textContent;

  document
    .getElementById("select-voucher")
    .addEventListener("click", function () {
      document.getElementById("use-button").disabled = true;
      $("#item-voucher-box").load(
        "php-addons/loaditemvoucher.php?totprice=" +
          totalprice +
          "&vid=" +
          currentvid,
        function () {
          $.getScript("JS/voucherscriptF2.js");
        }
      );
    });

  document
    .getElementById("billing-address-drag")
    .addEventListener("click", function () {
      if (!this.classList.contains("rotate")) {
        this.style.animation = "rotateAnimationforward 0.3s linear";
        this.style.transform = "rotate(90deg)";
      } else {
        this.style.animation = "rotateAnimationbackward .2s linear";
        this.style.transform = "rotate(0deg)";
      }

      document
        .getElementById("billing-address-details")
        .classList.toggle("expanded");
      this.classList.toggle("rotate");
    });

  document
    .getElementById("payment-drag")
    .addEventListener("click", function () {
      if (!this.classList.contains("rotate")) {
        this.style.animation = "rotateAnimationforward 0.3s linear";
        this.style.transform = "rotate(90deg)";
      } else {
        this.style.animation = "rotateAnimationbackward .2s linear";
        this.style.transform = "rotate(0deg)";
      }

      document.getElementById("payment-details").classList.toggle("expanded");
      this.classList.toggle("rotate");
    });

  document.getElementById("payment-drag").click();

  document.querySelectorAll(".payment-method-box").forEach((element) => {
    element.addEventListener("click", function () {
      document.querySelectorAll(".payment-method-box").forEach((sub) => {
        if (sub.classList.contains("selected-pm")) {
          sub.classList.remove("selected-pm");
        }
      });

      element.classList.add("selected-pm");

      selectedpm = element.getAttribute("paymentmethod");
      if (selectedpm != "Wallet" && selectedpm != "Cash On Delivery") {
        selectedpmid = element.getAttribute("paymentid");
      }

      document.querySelectorAll(".checked-pm").forEach((cpm) => {
        if (!cpm.classList.contains("d-none")) {
          cpm.classList.add("d-none");
        }
      });

      var checkedPmBox = element.querySelector(".checked-pm-box");
      var icon = checkedPmBox.querySelector(".checked-pm");

      if (icon.classList.contains("d-none")) {
        icon.classList.remove("d-none");
      }
    });
  });

  document
    .getElementById("proceeddelivery")
    .addEventListener("click", function () {
      let allow = true;

      let firstname = document.getElementById("firstname");
      let lastname = document.getElementById("lastname");
      let address = document.getElementById("address");
      let regionstate = document.getElementById("regionstate");
      let country = document.getElementById("country");
      let postcode = document.getElementById("postcode");
      let contactnumber = document.getElementById("contactnumber");
      let note = document.getElementById("note");

      if (firstname.value === "") {
        allow = false;
      }

      if (lastname.value === "") {
        allow = false;
      }

      if (address.value === "") {
        allow = false;
      }

      if (regionstate.value === "") {
        allow = false;
      }

      if (country.value === "") {
        allow = false;
      }

      if (postcode.value === "") {
        allow = false;
      }

      if (contactnumber.value === "") {
        allow = false;
      }

      if (selectedpm == null || selectedpm == "") {
        allow = false;
      }

      // OTHER CART INFO

      let allcartid = [];

      document.querySelectorAll(".fetched-item").forEach((item) => {
        allcartid.push(item.getAttribute("cartid"));
      });

      if (allow) {
        if (!(selectedpm == "Wallet") && !(selectedpm == "Cash On Delivery")) {
          $.ajax({
            url: "php-addons/insertcheckout.php",
            data: {
              firstname: firstname.value,
              lastname: lastname.value,
              address: address.value,
              regionstate: regionstate.value,
              country: country.value,
              postcode: postcode.value,
              contactnumber: contactnumber.value,
              note: note.value,
              selectedpm: selectedpm,
              selectetpmid: selectedpmid,
              mode: 1,
              deliveryfee: document.getElementById("d-fee").textContent,
              cartid: JSON.stringify(allcartid),
            },
            method: "POST",
            success: function (response) {
                if (response) {
                  window.location.href = "menu?cat=orders"
                } else if (response == "Stocks not enough") {

                }
              },
            error: function (xhr, status, error) {},
          });
        } else {
          $.ajax({
            url: "php-addons/insertcheckout.php",
            data: {
              firstname: firstname.value,
              lastname: lastname.value,
              address: address.value,
              regionstate: regionstate.value,
              country: country.value,
              postcode: postcode.value,
              contactnumber: contactnumber.value,
              note: note.value,
              selectedpm: selectedpm,
              mode: 2,
              deliveryfee: document.getElementById("d-fee").textContent,
              cartid: JSON.stringify(allcartid),
            },
            method: "POST",
            success: function (response) {
              if (response) {
                window.location.href = "menu?cat=orders"
              } else if (response == "Stocks not enough") {
                    
              }

              console.log(response);
            },
            error: function (xhr, status, error) {},
          });
        }
      } else {
        alert("Please fill in all the required fields.");
      }
    });


});
