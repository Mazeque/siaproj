

const data = new FormData();

var modal = document.createElement("div");
modal.classList.add("modal", "fade");
modal.id = "modal";
modal.tabIndex = "-1";
modal.role = "dialog";
modal.setAttribute("aria-labelledby", "modalLabel");
modal.setAttribute("aria-hidden", "true");

var modalDialog = document.createElement("div");
modalDialog.classList.add("modal-dialog", "modal-lg");
modalDialog.role = "document";

var modalContent = document.createElement("div");
modalContent.classList.add("modal-content");

var modalHeader = document.createElement("div");
modalHeader.classList.add("modal-header");

var modalTitle = document.createElement("h5");
modalTitle.classList.add("modal-title");
modalTitle.id = "modalLabel";
modalTitle.textContent = "Crop image";

var closeButton = document.createElement("button");
closeButton.type = "button";
closeButton.classList.add("close");
closeButton.setAttribute("data-dismiss", "modal");
closeButton.setAttribute("aria-label", "Close");
closeButton.innerHTML = '<span aria-hidden="true">×</span>';

modalHeader.appendChild(modalTitle);
modalHeader.appendChild(closeButton);

var modalBody = document.createElement("div");
modalBody.classList.add("modal-body");

var imgContainer = document.createElement("div");
imgContainer.classList.add("img-container");
imgContainer.style.maxHeight = "70vh";

var imgRow = document.createElement("div");
imgRow.classList.add("row");

var imgColumn = document.createElement("div");
imgColumn.classList.add("col-md-8", "imgcolumn");

var image = document.createElement("img");
image.id = "image";

imgColumn.appendChild(image);
imgColumn.style.display = "none";

var previewColumn = document.createElement("div");
previewColumn.classList.add("col-md-4");

var preview = document.createElement("div");
preview.classList.add("preview");

previewColumn.appendChild(preview);

imgRow.appendChild(imgColumn);
imgRow.appendChild(previewColumn);

imgContainer.appendChild(imgRow);

modalBody.appendChild(imgContainer);

var modalFooter = document.createElement("div");
modalFooter.classList.add("modal-footer");

var cancelButton = document.createElement("button");
cancelButton.type = "button";
cancelButton.classList.add("btn", "btn-secondary");
cancelButton.setAttribute("data-bs-dismiss", "modal");
cancelButton.textContent = "Cancels";

var cropButton = document.createElement("button");
cropButton.type = "button";
cropButton.classList.add("btn", "btn-primary");
cropButton.id = "crop";
cropButton.textContent = "Crop";

modalFooter.appendChild(cancelButton);
modalFooter.appendChild(cropButton);

modalContent.appendChild(modalHeader);
modalContent.appendChild(modalBody);
modalContent.appendChild(modalFooter);

modalDialog.appendChild(modalContent);

modal.appendChild(modalDialog);

document.body.appendChild(modal);

var maxImageSize = 500; // Set the maximum size dimension in pixels

var activeimg = null;
var canvas = null;
var bs_modal = $("#modal");
var reader, file;
var cropper;
var currentselected = null;
var allimages = {};



// ADD IMAGE CLICK
document.getElementById("add-image").addEventListener("click", function () {
  let parent = document.getElementById("image-container");

  let currentimage = null;

  const getAllAddImage = document.querySelectorAll(".image-box");

  let imagearray = [];

  getAllAddImage.forEach((element) => {
    let imageValue = parseInt(element.getAttribute("image"));
    if (imageValue > currentimage) {
      currentimage = imageValue;
    }

    imagearray.push(imageValue);
  });

  for (let i = 1; i <= imagearray.length + 1; i++) {
    if (!imagearray.includes(i)) {
      currentimage = i;

      break;
    }
  }

  const imagebox = document.createElement("div");
  imagebox.classList.add("col-5", "col-lg-3", "mx-1", "image-box");
  imagebox.setAttribute("image", currentimage);

  const div1 = document.createElement("div");
  div1.classList.add(
    "container-fluid",
    "d-flex",
    "justify-content-end",
    "pb-3",
    "pt-0"
  );
  div1.setAttribute("img-close-div", currentimage);

  const iconclose = document.createElement("i");
  iconclose.classList.add("fa-solid", "fa-xmark");

  div1.appendChild(iconclose);

  const div2 = document.createElement("div");
  div2.classList.add("col-12", "d-flex", "justify-content-center", "py-1");
  div2.setAttribute("imgdiv", currentimage);

  const span = document.createElement("label");
  span.classList.add("attach-text", "text-center");
  span.setAttribute("for", "img-file-" + currentimage);
  span.setAttribute("imglabel", currentimage);

  span.innerHTML =
    '<i class="fa-solid fa-image image-add-icon pb-2"></i><br>Attach Image';

  const input = document.createElement("input");
  input.setAttribute("type", "file");
  input.classList.add("d-none");
  input.setAttribute("imgfield", currentimage);
  input.id = "img-file-" + currentimage;

  div2.appendChild(span);
  div2.appendChild(input);

  imagebox.appendChild(div1);
  imagebox.appendChild(div2);

  input.addEventListener("change", function (e) {
    activeimg = imagebox.getAttribute("image");

    var files = e.target.files;
    var done = function (url) {
      image.src = null;
      image.src = url;
      bs_modal.modal("show");
    };
    if (files && files.length > 0) {
      var file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        var reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
    bs_modal
      .on("shown.bs.modal", function () {
        var imageWidth = image.naturalWidth;
        var imageHeight = image.naturalHeight;

        if (imageWidth > imageHeight) {
        //  alert("ImageHeight is less than the ImageWidth");

          if (imageWidth > maxImageSize) {
           // alert("ImageWidth is greater than the MaxImageSize");
            imageWidth = maxImageSize;
            imageHeight =
              (imageWidth / image.naturalWidth) * image.naturalHeight;
          } else {
          }
        } else {
         // alert("ImageWidth is less than the ImageHeight");

          if (imageHeight > maxImageSize) {
           // alert("ImageHeight is greater than the MaxImageSize");
            imageHeight = maxImageSize;
            imageWidth =
              (imageHeight / image.naturalHeight) * image.naturalWidth;
          } else {
          //  alert(imageHeight + " - " + imageWidth);
          }
        }
        image.width = imageWidth;
        image.height = imageHeight;

        image.style.maxWidth = imageWidth + "px";
        image.style.maxHeight = imageHeight + "px";
        image.style.display = "block";

        imgColumn.style.display = "block";
        cropper = new Cropper(image, {
          preview: '.preview',
          viewMode: 2,
          modal: true,
          cropBoxResizable: true,
          ready: function () {
              cropper.setCropBoxData({
                  width: image.width,
                  height: image.height,
              });          
          }
        });
        
      })
      .on("hidden.bs.modal", function () {
        image.src = null;
        image.width = 0;
        image.height = 0;
        cropper.destroy();

        bs_modal.unbind("shown.bs.modal");
        bs_modal.unbind("hidden.bs.modal");

        var elements = document.getElementsByClassName("cropper-container");

        var elementsArray = Array.from(elements);

        elementsArray.forEach(function (element) {
          element.remove();
        });
      });
  });

  iconclose.addEventListener("click", function () {
    parent.removeChild(imagebox);
  });

  parent.appendChild(imagebox);
});

setTimeout(function () {
  $("#crop").click(function () {
    const getAllImages = document.querySelectorAll(".image-box");

    getAllImages.forEach((element) => {
      if (activeimg === element.getAttribute("image")) {
        let imgcanv = cropper.getCroppedCanvas({
          width: cropper.getImageData().naturalWidth,
          height: cropper.getImageData().naturalHeight,
        });

        const imageElement = imgcanv.toDataURL();
        if (imageElement) {
          const existingImageElement = document.querySelector(
            '[imgdiv="' + activeimg + '"]'
          );
          if (existingImageElement) {
            existingImageElement.parentNode.removeChild(existingImageElement);
          }

          const imgCloseDiv = document.querySelector(
            '[img-close-div="' + activeimg + '"]'
          );
          if (imgCloseDiv) {
            imgCloseDiv.classList.replace("pb-3", "pb-5");
            imgCloseDiv.classList.add("mb-5");
          }

          let displayWidth;
          let displayHeight;

          if (
            image.width ===
            image.height
          ) {
            displayWidth = 160;
            displayHeight = 160;
          } else {
            displayWidth = 140;
            displayHeight = 160;
          }

          element.style.backgroundImage = 'url("' + imageElement + '")';
          element.style.backgroundSize = `${displayWidth}px ${displayHeight}px`;
          element.style.backgroundPosition = "center";
          element.style.backgroundRepeat = "no-repeat";

          const hiddenInput = document.createElement("input");
          hiddenInput.type = "file";
          hiddenInput.classList.add("cropped-img", "d-none");
          hiddenInput.name = "prodImg" + activeimg;
          hiddenInput.setAttribute("img-for", activeimg);

          const blob = dataURLtoBlob(imageElement);

          const file = new File([blob], hiddenInput.name + ".png", {
            type: "image/png",
          });

          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(file);

          hiddenInput.files = dataTransfer.files;

          data.append("files[]", hiddenInput.files[0]);

          element.appendChild(hiddenInput);

          bs_modal.modal("hide");

          if (hiddenInput.files.length > 0) {
            console.log("File transferred successfully.");
          } else {
            console.log("File transfer failed.");

            alert("File transfer failed.");
          }

          setTimeout(function () {
            cropper.destroy();

            bs_modal.unbind("shown.bs.modal");
            bs_modal.unbind("hidden.bs.modal");

            imgColumn.style.display = "none";
          }, 500);

          return;
        } else {
          alert("Canvas does not contain an image.");
        }
      }
    });
  });
}, 400);

function dataURLtoBlob(dataURL) {
  const parts = dataURL.split(",");
  const mimeType = parts[0].match(/:(.*?);/)[1];
  const b64Data = atob(parts[1]);
  const arrayBuffer = new ArrayBuffer(b64Data.length);
  const uint8Array = new Uint8Array(arrayBuffer);

  for (let i = 0; i < b64Data.length; i++) {
    uint8Array[i] = b64Data.charCodeAt(i);
  }

  return new Blob([arrayBuffer], { type: mimeType });
}

// SAVE / UPLOAD TO SERVER
$("#create-product").click(function () {
  const formData = new FormData();

  formData.append("productname", $("#product-name").val());
  formData.append("productdescription", $("#product-description").val());
  formData.append("productprice", parseFloat($("#product-price").val()).toFixed(2));
  formData.append("productstocks", $("#product-stocks").val());
  formData.append("productcategory", currentcategory);

  const imageInputs = document.querySelectorAll(".cropped-img");
  imageInputs.forEach(function (input) {
    const files = input.files;
    if (files.length > 0) {
      formData.append("productimages[]", files[0]);
    }
  });

  $.ajax({
    url: "php-addons/createproductfunctions.php",
    method: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);

      $("#product-name").val("");
      $("#product-description").val("");
      $("#product-price").val("");
      $("#product-stocks").val("");

      $(".success").removeClass("d-none");
      $(".success").addClass("show");
      $(".success").removeClass("hide");
      $(".success").addClass("showSuccess");

      window.location.href = "home?sec=products&cat="+currentcategory;



      setTimeout(function () {
        $(".success").removeClass("show");
        $(".success").addClass("hide");
      }, 2000);
      setTimeout(function () {
        $(".success").addClass("d-none");
      }, 3000);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error(textStatus, errorThrown);
    },
  });
});
