const formContainer = document.querySelector("#form-container");
const overlay = document.querySelector("#overlay");
const popupBtn = document.querySelector("#popup-btn");

function showPopup() {
  overlay.hidden = false;
  formContainer.hidden = false;
}

function hidePopup() {
  overlay.hidden = true;
  formContainer.hidden = true;
}
