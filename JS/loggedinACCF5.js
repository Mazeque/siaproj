document.addEventListener('DOMContentLoaded', function() {

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

    document.getElementById('checkout').addEventListener('click', function() {
      alert('1');
    });
  

    

  });