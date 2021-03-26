function openImage(src) {
  let imageOverlay = document.getElementsByClassName("image-overlay")[0];
  let overlayImage = document.getElementById("overlay-image");

  // add the image to the overlay
  // removing sm to show the large image
  overlayImage.src = src.replace("-sm", "");
  // show the overlay
  imageOverlay.style.display = "flex";
}

function hideGDPR() {
  let gdprSection = document.getElementById("gdpr");
  gdprSection.classList.add("hide");
}

function closeOverlay(imageOverlay) {
  imageOverlay.style.display = "none";
}
