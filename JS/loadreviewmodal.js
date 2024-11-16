var starreview = null;
var orderid = null;
var productid = null;

document.querySelectorAll(".submit_star").forEach((element) => {
  element.addEventListener("mouseover", function () {
    const datarating = element.getAttribute("data-rating");

    if (starreview == null || starreview < parseInt(datarating)) {
      const allstars = document.querySelectorAll(".submit_star");

      for (let i = 0; i < allstars.length; i++) {
        if (i < parseInt(datarating)) {
          allstars[i].classList.add("text-black");
        }
      }
    }
  });

  element.addEventListener("mouseout", function () {
    const datarating = element.getAttribute("data-rating");

    if (starreview == null) {
      const allstars = document.querySelectorAll(".submit_star");

      allstars.forEach((sub) => {
        if (sub.classList.contains("text-black")) {
          sub.classList.remove("text-black");
        }
      });
    } else if (starreview < parseInt(datarating)) {
      const allstars = document.querySelectorAll(".submit_star");

      allstars.forEach((sub) => {
        if (sub.classList.contains("text-black")) {
          sub.classList.remove("text-black");
        }
      });

      for (let i = 0; i < starreview; i++) {
        if (i < parseInt(datarating)) {
          allstars[i].classList.add("text-black");
        }
      }
    }
  });

  element.addEventListener("click", function () {
    const datarating = element.getAttribute("data-rating");
    const allstars = document.querySelectorAll(".submit_star");

    allstars.forEach((sub) => {
      if (sub.classList.contains("text-black")) {
        sub.classList.remove("text-black");
      }
    });

    for (let i = 0; i < allstars.length; i++) {
      if (i < parseInt(datarating)) {
        allstars[i].classList.add("text-black");
      }
    }

    starreview = datarating;
    document.getElementById('product-rated').innerHTML = starreview + '.0';
  });
});

document.getElementById('review_modal').addEventListener('hidden.bs.modal', function (event) {
    starreview = null;
    document.getElementById('product-rated').innerHTML = 0;
    document.getElementById('title').value = '';
    document.getElementById('user_review').value = '';
    productid = null;
    orderid = null;
    
    const allstars = document.querySelectorAll(".submit_star");

    allstars.forEach((sub) => {
      if (sub.classList.contains("text-black")) {
        sub.classList.remove("text-black");
      }
    });
  });

document.getElementById('save_review').addEventListener('click', function() {

    let allow = true;

    const title = document.getElementById('title');
    const review = document.getElementById('user_review');


    if (starreview == null) {
        allow = false;
    }

    if (title.value == null) {
        allow = false;
    }

    if (review.value == null) {
        allow = false;
    }

    if (allow) {
        $.ajax({
            url: 'php-addons/createreview.php',
            data: {
                orderid: orderid,
                productid: productid,
                rating: starreview,
                title: title.value,
                review: review.value,
            },
            method: "POST",
            success: function(resp) {
                if (resp) {
                    $('#review_modal').modal('hide');

                    location.reload();
                }
            }
        });
        
    }
});

document.querySelectorAll('.leave-a-review').forEach(element => {
    element.addEventListener('click', function() {
        orderid = parseInt(element.getAttribute('orderid'));
        productid = parseInt(element.getAttribute('productid'));
    });
});
