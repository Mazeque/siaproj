document.addEventListener("DOMContentLoaded", function () {
    var menu = document.querySelectorAll(".menu-item");
  
    menu.forEach((itemmenu) => {
      //  let categorylarge = itemmenu.getAttribute('category');
  
      itemmenu.addEventListener("mouseover", function () {
        itemmenu.style.backgroundColor = "gray";
      });
  
      itemmenu.addEventListener("mouseleave", function () {
        itemmenu.style.backgroundColor = "white";
      });
  
      itemmenu.addEventListener("click", function () {
        itemmenu.classList.add("menu-item-active");
  
        let categorylarge = itemmenu.getAttribute("category");
  
        if (!categorylarge.includes("-sm")) {
          let itemsmall = document.querySelector(
            '[category="' + categorylarge + '-sm"]'
          );
          itemsmall.classList.add("menu-item-active");
  
          menu.forEach((e) => {
            if (
              e.getAttribute("category") !== categorylarge &&
              e.getAttribute("category") !== itemsmall.getAttribute("category")
            ) {
              if (e.classList.contains("menu-item-active")) {
                e.classList.remove("menu-item-active");
              } else {
              }
            }
          });
  
          if (
            itemmenu.getAttribute("category") === "users" ||
            itemmenu.getAttribute("category") === "users-sm"
          ) {
            const dynamicArray = [];
            $("#content-panel").load(
              "php-addons/load-panel.php",
              {
                panel: "users",
              },
              function () {
                $.getScript("JS/locationsF1.js");
                $.getScript(
                  "https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                );
                $.getScript("https://www.google.com/recaptcha/api.js");
                $.getScript("JS/usersF3.js");
              }
            );
          } else if (
            itemmenu.getAttribute("category") === "dashboard" ||
            itemmenu.getAttribute("category") === "dashboard-sm"
          ) {
            $("#content-panel").load("php-addons/load-panel.php", {
              panel: "dashboard",
            });
          } else if (
            itemmenu.getAttribute("category") === "products" ||
            itemmenu.getAttribute("category") === "products-sm"
          ) {
            $("#content-panel").load(
              "php-addons/load-panel.php",
              {
                panel: "products",
              },
              function () {
                $.getScript("JS/productsF1.js");
              }
            );
          } else if (
            itemmenu.getAttribute("category") === "orders" ||
            itemmenu.getAttribute("category") === "orders-sm"
          ) {
            $("#content-panel").load(
              "php-addons/load-panel.php",
              {
                panel: "orders",
              },
              function () {
                $.getScript("JS/orders.js");
    
              }
            );
          } else if (
            itemmenu.getAttribute("category") === "vouchers" ||
            itemmenu.getAttribute("category") === "vouchers-sm"
          ) {
            $("#content-panel").load(
              "php-addons/load-panel.php",
              {
                panel: "vouchers",
              },
              function () {
                $.getScript("JS/vouchers.js");
    
              }
            );
          }
        } else {
          let itembig = document.querySelector(
            '[category="' + categorylarge.replace(/-sm$/, "") + '"]'
          );
          itembig.classList.add("menu-item-active");
  
          menu.forEach((e) => {
            if (
              e.getAttribute("category") !== categorylarge &&
              e.getAttribute("category") !== itembig.getAttribute("category")
            ) {
              if (e.classList.contains("menu-item-active")) {
                e.classList.remove("menu-item-active");
              } else {
              }
            }
          });
  
          if (
            itemmenu.getAttribute("category") === "users" ||
            itemmenu.getAttribute("category") === "users-sm"
          ) {
            const dynamicArray = [];
            $("#content-panel").load(
              "php-addons/load-panel.php",
              {
                panel: "users",
              },
              function () {
                $.getScript("JS/locationsF1.js");
                $.getScript(
                  "https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                );
                $.getScript("https://www.google.com/recaptcha/api.js");
                $.getScript("JS/usersF3.js");
              }
            );
          } else if (
            itemmenu.getAttribute("category") === "dashboard" ||
            itemmenu.getAttribute("category") === "dashboard-sm"
          ) {
            $("#content-panel").load("php-addons/load-panel.php", {
              panel: "dashboard",
            });
          } else if (
            itemmenu.getAttribute("category") === "products" ||
            itemmenu.getAttribute("category") === "products-sm"
          ) {
            $("#content-panel").load(
              "php-addons/load-panel.php",
              {
                panel: "products",
              },
              function () {
                $.getScript("JS/productsF1.js");
              }
            );
          }else if (
            itemmenu.getAttribute("category") === "orders" ||
            itemmenu.getAttribute("category") === "orders-sm"
          ) {
            $("#content-panel").load(
              "php-addons/load-panel.php",
              {
                panel: "orders",
              },
              function () {

                $.getScript("JS/orders.js");
              }
            );
          } else if (
            itemmenu.getAttribute("category") === "vouchers" ||
            itemmenu.getAttribute("category") === "vouchers-sm"
          ) {
            $("#content-panel").load(
              "php-addons/load-panel.php",
              {
                panel: "vouchers",
              },
              function () {
                $.getScript("JS/vouchers.js");
    
              }
            );
          }
        }
      });
    });
  
    const urlString = window.location.href;
  
    const queryString = urlString.split("?")[1];
  
    const urlParams = new URLSearchParams(queryString);
  
    const productsValue = urlParams.get("sec");
  
    if (productsValue === "products") {
      document.getElementById(productsValue).click();
  
      setTimeout(function () {
         const param2Value = urlParams.get("cat");
  
          if (document.querySelector('.category-container[categoryid="' + param2Value + '"]')) {
              document.querySelector('.category-container[categoryid="' + param2Value + '"]').click();
          } else {
              console.log("Null");
          }
  
      }, 300);
    } else {
      document.getElementById("dashboard").click();
    }
  });
  