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

var bs_modal = $("#modal");
var image = document.getElementById("image");
var cropper, reader, file;

var maxImageSize = 500; // Set the maximum size dimension in pixels

$("body").on("change", "#input-profile-img", function (e) {
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
          imageHeight = (imageWidth / image.naturalWidth) * image.naturalHeight;
        } else {
        }
      } else {
        // alert("ImageWidth is less than the ImageHeight");

        if (imageHeight > maxImageSize) {
          // alert("ImageHeight is greater than the MaxImageSize");
          imageHeight = maxImageSize;
          imageWidth = (imageHeight / image.naturalHeight) * image.naturalWidth;
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
        preview: ".preview",
        viewMode: 1,
        modal: true,
        cropBoxResizable: true,
        background: false,
        aspectRatio: 1,
        ready: function () {
          cropper.setCropBoxData({
            width: image.width,
            height: image.height,
          });
        },
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

  // cropButton.addEventListener("click", function () {
  //   const profiledata = new FormData();

  //   var croppedCanvas = cropper.getCroppedCanvas();


  //   profiledata.append("profilepic", croppedImage);

  //   $.ajax({
  //     url: "uploadprofile.php",
  //     method: "POST",
  //     data: profiledata,
  //     processData: false,
  //     contentType: false,
  //     success: function (response) {
  //       if (response) {
  //         var profileImage = document.getElementById("profileImage");
  //         profileImage.src = croppedImage;

  //         console.log(response);
  //         bs_modal.modal("hide");
  //       }
  //     },
  //   });

  // });
  cropButton.addEventListener("click", function () {
    var profiledata = new FormData();

    var croppedCanvas = cropper.getCroppedCanvas();
    croppedCanvas.toBlob(function (blob) {
      profiledata.append("profilepic", blob, "profile.png"); 

      $.ajax({
        url: "uploadprofile.php",
        method: "POST",
        data: profiledata,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response) {
            var croppedImage = croppedCanvas.toDataURL("image/png");
            var profileImage = document.getElementById("profileImage");
            profileImage.src = croppedImage;

            bs_modal.modal("hide");
          }
        },
      });
    }, "image/png");
  });
});
