document.getElementById("done-button").addEventListener("click", function () {
  let allowed = true;

  let name;
  let description;
  let selectedtype = 0;
  let price;
  let totalallow;
  let minprice;
  let capprice;
  let expiration;

  if (document.getElementById("name-field").value == "") {
    allowed = false;
  } else {
    name = document.getElementById("name-field").value;
  }

  if (document.getElementById("description-field").value == "") {
    allowed = false;
  } else {
    description = document.getElementById("description-field").value;
  }

  document.querySelectorAll('input[name="vouchertype"]').forEach((element) => {
    if (element.checked) {
      selectedtype = element.value;
    }
  });

  if (document.getElementById("price-field").value == "") {
    allowed = false;
  } else {
    price = document.getElementById("price-field").value;
  }

  if (document.getElementById("total-allowable-field").value == "") {
    allowed = false;
  } else {
    totalallow = document.getElementById("total-allowable-field").value;
  }

  if (document.getElementById("minimum-price-field").value == "") {
    allowed = false;
  } else {
    minprice = document.getElementById("minimum-price-field").value;
  }

  if (document.getElementById("cap-field").value == "") {
    allowed = false;
  } else {
    capprice = document.getElementById("cap-field").value;
  }

  if (document.getElementById("expiration-field").value == "") {
    allowed = false;
  } else {
    expiration = document.getElementById("expiration-field").value;
  }

  if (allowed && selectedtype > 0) {
    $.ajax({
      url: "php-addons/createvoucher.php",
      method: "POST",
      data: {
        name: name,
        description: description,
        selectedtype: selectedtype,
        price: price,
        totalallow: totalallow,
        minprice: minprice,
        capprice: capprice,
        expiration: expiration,
      },
      success: function (response) {
        if (response) {
          document.getElementById("name-field").value = "";
          document.getElementById("description-field").value = "";
          document.getElementById("price-field").value = "";
          document.getElementById("total-allowable-field").value = "";
          document.getElementById("minimum-price-field").value = "";
          document.getElementById("cap-field").value = "";
          document.getElementById("expiration-field").value = "";

          $("#voucherModal").modal("hide");
        } else {
          alert("Not Success: " + response);
        }
      },
    });
  }
});

document.getElementById("price-field").addEventListener("input", (event) => {
  event.target.value = event.target.value.replace(/[^0-9.]/g, "");
});

document
  .getElementById("minimum-price-field")
  .addEventListener("input", (event) => {
    event.target.value = event.target.value.replace(/[^0-9.]/g, "");
  });

document.getElementById("cap-field").addEventListener("input", (event) => {
  event.target.value = event.target.value.replace(/[^0-9.]/g, "");
});

document
  .getElementById("total-allowable-field")
  .addEventListener("input", (event) => {
    event.target.value = event.target.value.replace(/[^0-9]/g, "");
  });

const currentDateTime = new Date().toISOString().slice(0, 16);
document.getElementById("expiration-field").min = currentDateTime;

document
  .getElementById("expiration-field")
  .addEventListener("input", function () {
    const selectedDateTime = new Date(this.value);

    if (selectedDateTime < new Date()) {
      this.value = currentDateTime;
    }
  });

  
