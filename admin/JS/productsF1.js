// CATEGORY MODAL EVENTS

var productContainer = null;
var allproductsJson = null;
var currentcategory = null;

var editproductvariations = {
  // 'title1': [
  //   'item1',
  //   'item2'
  // ],
  // 'title2': [
  //   'item1',
  //   'item2'
  // ]
};

document
  .getElementById("category-add-button")
  .addEventListener("click", categorylistener);

function categorylistener() {
  if (document.getElementById("category-input").value !== "") {
    $.ajax({
      url: "php-addons/insertcategory.php",
      method: "POST",
      data: {
        category: document.getElementById("category-input").value,
      },
      success: function (response) {
        if (response) {
          document.getElementById("category-input").value = "";

          $("#content-panel").load(
            "php-addons/load-panel.php",
            {
              panel: "products",
            },
            function () {
              $.getScript("JS/productsF1.js");
            }
          );

          $("#categoryModal").modal("hide");
        } else {
          alert(false);
        }
      },
    });
  } else {
    alert("Empty");
  }
}

var temp = 0;

document.querySelectorAll(".category-container").forEach((category) => {
  let categoryname = category.getAttribute("category");
 

  category.addEventListener("click", function () {
    let categoryid = category.getAttribute("categoryid");
    document.querySelectorAll(".category-container").forEach((element) => {
      if (element.classList.contains("category-active")) {
        element.classList.remove("category-active");
      }
    });

    currentcategory = categoryid;

    category.classList.add("category-active");
    document.getElementById("sub-category-section").classList.remove("d-none");
    document.getElementById("sub-category-header-label").innerHTML =
      categoryname;

    if (!document.getElementById("products-section").classList.contains("d-none")
    ) {
      document.getElementById("products-section").classList.add("d-none");

      document.getElementById("products-header-label").innerHTML = "";
    } else {
      document.getElementById("products-header-label").innerHTML = "";
    }

    $("#category-content").load(
      "php-addons/loadprodcontent.php", {
        productsection: categoryid,
      },
      function () {
        setTimeout(function () {

          const prodModalContainer = document.createElement("div");
          prodModalContainer.classList.add("modal", "fade");
          prodModalContainer.id = "prodModal";
          prodModalContainer.setAttribute("tabindex", "-1");

          const prodModalDialog = document.createElement("div");
          prodModalDialog.classList.add("modal-dialog");

          const prodModalContent = document.createElement("div");
          prodModalContent.classList.add("modal-content");

          const prodModalHeader = document.createElement("div");
          prodModalHeader.classList.add("modal-header");

          const prodModalTitle = document.createElement("h5");
          prodModalTitle.classList.add("modal-title");
          prodModalTitle.textContent = "Modal Title";

          const prodCloseButton = document.createElement("button");
          prodCloseButton.type = "button";
          prodCloseButton.classList.add("btn-close");
          prodCloseButton.setAttribute("data-bs-dismiss", "modal");
          prodCloseButton.setAttribute("aria-label", "Close");

          prodModalHeader.appendChild(prodModalTitle);
          prodModalHeader.appendChild(prodCloseButton);

          const prodModalBody = document.createElement("div");
          prodModalBody.classList.add("modal-body");
          prodModalBody.innerHTML =
            "<p>This is the modal content.</p>";

          const prodModalFooter = document.createElement("div");
          prodModalFooter.classList.add("modal-footer");

          const prodCloseButtonFooter =
            document.createElement("button");
          prodCloseButtonFooter.type = "button";
          prodCloseButtonFooter.classList.add("btn", "btn-secondary");
          prodCloseButtonFooter.setAttribute(
            "data-bs-dismiss",
            "modal"
          );
          prodCloseButtonFooter.textContent = "Close";

          const prodSaveButton = document.createElement("button");
          prodSaveButton.type = "button";
          prodSaveButton.classList.add("btn", "btn-primary");
          prodSaveButton.textContent = "Save changes";

          prodModalFooter.appendChild(prodCloseButtonFooter);
          prodModalFooter.appendChild(prodSaveButton);

          prodModalContent.appendChild(prodModalHeader);
          prodModalContent.appendChild(prodModalBody);
          prodModalContent.appendChild(prodModalFooter);

          prodModalDialog.appendChild(prodModalContent);

          prodModalContainer.appendChild(prodModalDialog);

          document
            .querySelectorAll(".product-container")
            .forEach((element) => {

              element.addEventListener("click", function () {
                productContainer = element.getAttribute("productid");
       
                // alert(allproductsJson[
                //   parseInt(element.getAttribute("productid"))
                // ]["images"].length);

                document.getElementById("edit-field").value =
                  "#" + element.getAttribute("productid");
                document.getElementById("edit-product-name").value =
                  allproductsJson[
                    parseInt(element.getAttribute("productid"))
                  ]["name"];
                document.getElementById(
                  "edit-product-description"
                ).value =
                  allproductsJson[
                    parseInt(element.getAttribute("productid"))
                  ]["description"];

                document.getElementById("edit-product-price").value =
                  allproductsJson[
                    parseInt(element.getAttribute("productid"))
                  ]["price"];
                document.getElementById("edit-product-stocks").value =
                  allproductsJson[
                    parseInt(element.getAttribute("productid"))
                  ]["stocks"];
                //

                allproductsJson[
                  parseInt(element.getAttribute("productid"))
                ]["product_images"].forEach((image, index) => {
         
             
                  // Create the parent div element
                  var div = document.createElement("div");
                  div.className = "col-5 col-lg-3 mx-1 image-box";
                  div.setAttribute("image", index + 1);
                  div.style.backgroundImage = "url('php-addons/productimages/" + image + "')";
                  div.style.width = "150px";
                  div.style.height = "160px";
                  div.style.backgroundSize = "cover";
                  div.style.backgroundPosition = "center";
                  div.style.backgroundRepeat = "no-repeat";

                  // Append the parent div to the desired container
                  var container = document.getElementById(
                    "edit-image-container"
                  );
                  container.appendChild(div);
                });

              });
            });

          document
            .getElementById("prodModal")
            .addEventListener("shown.bs.modal", function () {
              const modalContent = document
                .getElementById("prodModal")
                .querySelector(".edit-modal-content");
              setTimeout(function() {
                document
                .getElementById("prodModal")
                .addEventListener("click", function (event) {
                  setTimeout(function () {
                    if (
                      event.target ===
                      document.getElementById("prodModal")
                    ) {
                      $("#prodModal").modal("hide");

                      setTimeout(function () {
                        // let allvariationcont =
                        //   document.getElementById("edit-variation");

                        // while (allvariationcont.firstChild) {
                        //   allvariationcont.removeChild(
                        //     allvariationcont.firstChild
                        //   );
                        // }
                      }, 200);
                    }
                  }, 500);
                });
              }, 200);
            });
        });
      }
    );
  });

  if (temp === 0) {
    category.click();
  }

  temp++;
});

// var temp = {
//   10: {
//     id: 10,
//     name: "Fuck",
//     description: "Shet",
//     features: "Test",
//     stocks: 23,
//     price: "23",
//     variation: '"{\\"Color\\":[\\"Red\\",\\"Blue\\"]}"',
//     location: "Marikina",
//     sold: 0,
//     ratings: "",
//     category: "Guitar / Electric",
//     images: "[]",
//   },
// };

// SUB CATEGORY MODAL EVENTS

document
  .getElementById("sub-category-add-button")
  .addEventListener("click", subcategorylistener);

function subcategorylistener() {
  let tempmaincategory = null;

  document.querySelectorAll(".category-container").forEach((element) => {
    if (element.classList.contains("category-active")) {
      tempmaincategory = element.getAttribute("category");

      if (document.getElementById("sub-category-input").value !== "") {
        $.ajax({
          url: "php-addons/insertsubcategory.php",
          method: "POST",
          data: {
            maincategory: tempmaincategory,
            subcategory: document.getElementById("sub-category-input").value,
          },
          success: function (response) {
            if (response) {
              document.getElementById("sub-category-input").value = "";

              $("#content-panel").load(
                "php-addons/load-panel.php",
                {
                  panel: "products",
                },
                function () {
                  $.getScript("JS/productsF1.js");
                }
              );

              $("#sub-categoryModal").modal("hide");
            } else {
              alert(false);
            }
          },
        });
      } else {
        alert("Empty");
      }
    }
  });
}

// ADD PRODUCT BUTTON
document
  .getElementById("add-product-button")
  .addEventListener("click", function () {
    $("#products-section").load(
      "php-addons/createproduct.php",
      {},
      function () {
        document.getElementById("products-section").classList.remove('d-none');
        setTimeout(function () {
          document.getElementById('product-title-category').innerHTML = document.getElementById('sub-category-header-label').textContent;
          $(".add-product-content").addClass("added");
 


          $.getScript("JS/createproductF1.js");
        }, 50);
      }
    );
  });

//        document.querySelectorAll('.product-container').forEach(element => {
//     element.addEventListener('click', function() {
//         alert('Clicked Product #' + element.getAttribute('productid'));
//     });
//   });
