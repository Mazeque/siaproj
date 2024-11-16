var section = 1;
var cardType;
var noerrorfield1 = false;
var noerrorfield2 = false;
var noerrorfield3 = false;
var noerrorfield4 = false;

document.getElementById("proceedButton").addEventListener("click", function () {
  if (section == 1) {
    var cardRadio = document.getElementById("visa");
    var paypalRadio = document.getElementById("paypal");
    var gcashRadio = document.getElementById("gcash");

    if (cardRadio.checked) {
      proceedToLink("Card");
      section = 2;

      document.getElementById("proceedButton").disabled = true;
    } else if (paypalRadio.checked) {
      proceedToLink("Paypal");

      section = 2;
      document.getElementById("proceedButton").disabled = true;
    } else if (gcashRadio.checked) {
    } else {
      document.getElementById("warningMessage").style.display = "block";

      setTimeout(function () {
        document.getElementById("warningMessage").style.display = "none";
      }, 5000);
    }

    document.getElementById("proceedButton").innerHTML = "Link";
  } else {
    let field1 = document.getElementById("card-name-field").value;
    let field2 = document.getElementById("card-number-field").value;
    let field3 = document.getElementById("expiry-field").value;
    let field4 = document.getElementById("cvccvv-field").value;

    if (field1 != "") {
      noerrorfield1 = true;
    } else {
      noerrorfield1 = false;
    }

    if (field2.length === 19) {
      noerrorfield2 = true;
    } else {
      noerrorfield2 = false;
    }

    if (field3.length === 5) {
      noerrorfield3 = true;
    } else {
      noerrorfield3 = false;
    }

    if (field4.length > 2 && field4.length < 5) {
      noerrorfield4 = true;
    } else {
      noerrorfield4 = false;
    }

    if (noerrorfield1 && noerrorfield2 & noerrorfield3 & noerrorfield4) {
      $.ajax({
        url: "php-addons/uploadpayment.php",
        data: {
          type: cardType,
          cardname: field1,
          cardnumber: field2,
          cardexpiry: field3,
          cardcvv: field4,
        },
        method: "POST",
        success: function (response) {
          console.log(response);
          if (response == 1) {
            $("#addpmModal").modal("hide");

            location.reload();
          }
        },
      });
    }
  }
});

function proceedToLink(checked) {
  document.getElementById("containerpay").style.opacity = "0";
  setTimeout(function () {
    document.getElementById("containerpay").style.transform =
      "translateX(-150%)";
  }, 200);

  setTimeout(function () {
    $("#payment-box").load(
      "php-addons/loadpaymentlink.php?method=" + checked,
      function () {
        $.getScript("JS/cardscript.js");
      }
    );

    setTimeout(function () {
      document.getElementById("container-pm").style.transform =
        "translateX(0%)";

      setTimeout(function () {
        document.getElementById("container-pm").style.opacity = "1";
      }, 80);
    }, 80);
  }, 700);
}

function handleOutsideClick(event) {
  if (!document.getElementById("mod-content").contains(event.target)) {
    section = 1;
    $("#modal-section").load("php-addons/paymentmodal.php");
    $("#modal-section").empty();
  }
}

function closeModal() {}

document.getElementById("addpmButton").addEventListener("click", function () {
  document.getElementById("proceedButton").disabled = false;
  $("#payment-box").load("php-addons/loaddefaultlink.php");
  section = 1;
});

document.querySelectorAll(".del-button").forEach((del) => {
  del.addEventListener("click", function () {
    $.ajax({
      url: "php-addons/deletepaymentmethod.php",
      data: {
        paymentid: del.getAttribute("pid"),
      },
      method: "POST",
      success: function (resp) {
        if (resp) {
          location.reload();
        }
      },
    });
  });
});
