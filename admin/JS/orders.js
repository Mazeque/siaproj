function countorders() {
  $.ajax({
    url: "php-addons/getitemcounter.php",
    success: function (resp) {
      const result = JSON.parse(resp);

      document.getElementById("all-counter").innerHTML = result.all;
      document.getElementById("active-counter").innerHTML = result.active;
      document.getElementById("successful-counter").innerHTML =
        result.successful;
      document.getElementById("cancelled-counter").innerHTML = result.cancelled;
    },
  });
}

countorders();

document.querySelectorAll(".section-nav").forEach((element, index) => {
  element.addEventListener("click", function () {
    document.querySelectorAll(".section-nav").forEach((sec) => {
      if (sec.classList.contains("active")) {
        sec.classList.remove("active");
      }
    });

    element.classList.toggle("active");

    if (parseInt(element.id) == 1) {
      $("#order-content").load("php-addons/loadallorders.php", function () {
      });
    } else if (parseInt(element.id) == 2) {
      $("#order-content").load("php-addons/loadactiveorders.php", function () {
        $.getScript('JS/loadprocessbutton.js');
      });
    } else if (parseInt(element.id) == 3) {
      $("#order-content").load("php-addons/loadsuccessfulorders.php", function () {
      });
    } else if (parseInt(element.id) == 4) {
      $("#order-content").load("php-addons/loadcancelledorders.php", function () {
      });
    }
  });

  if (index === 0) {
    element.click();
  }
});
