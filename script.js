document.querySelector("form").onsubmit = function (evt) {
  const width = Number(document.querySelector(".width-input").value);
  const height = Number(document.querySelector(".height-input").value);

  this.action += "?";

  const data = new FormData();
  if (width > 0) {
    this.action += "width=" + width;
  }
  if (height > 0) {
    this.action += "&height=" + height;
  }
  fetch(this.action);
};
