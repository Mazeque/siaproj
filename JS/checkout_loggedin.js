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
});
