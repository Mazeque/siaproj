document.addEventListener("DOMContentLoaded", function () {
  var cookiecontainer = this.getElementById("cookie-container");
  var rejectcookies = this.getElementById("reject-cookies");
  var acceptcookies = this.getElementById("accept-cookies");

  setTimeout(function () {
    cookiecontainer.style.transform = "translateX(0%)";

    setTimeout(function () {
      cookiecontainer.style.opacity = "1";
    }, 300);
  }, 750);

  rejectcookies.addEventListener("click", function () {
    cookiecontainer.style.opacity = "0";

    setTimeout(function () {
      cookiecontainer.style.transform = "translateX(-150%)";
    }, 300);
  });

  acceptcookies.addEventListener("click", function () {
    $.ajax({
        url: 'cookies.php',
        success: function() {
            $.ajax({
                url: "checkcookie.php",
                success: function(cookieresponse) {
                    if (cookieresponse) {
        
                        cookiecontainer.style.opacity = "0";
        
                        setTimeout(function () {
                          cookiecontainer.style.transform = "translateX(-150%)";
                        }, 300);
                    } else {
                        alert('Cant be sett : ' + cookieresponse);
                    }
                }
            });

        }
    });
  });
});
