document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("formulario");
  var requiredElements = form.querySelectorAll("[required]");
  errorFeedback(requiredElements);
  form.addEventListener("submit", function (event) {
    event.preventDefault();
    window.location.href = "#";
    requiredElements.forEach((elem) => {
      validarEnvio(elem);
      reloadFeedback(elem);
      elem.addEventListener("input", () => {
        validarEnvio(elem);
        reloadFeedback(elem);
      });
    });
  });
});

function validarEnvio(elem) {
  if (elem.checkValidity()) {
    elem.classList.toggle("is-valid", true);
    elem.classList.toggle("is-invalid", false);
  } else {
    elem.classList.toggle("is-invalid", true);
    elem.classList.toggle("is-valid", false);
  }
}

function errorFeedback(elems) {
  elems.forEach((elem) => {
    var id = elem.id;
    var box = document.getElementById(id + "Box");
    if (box !== null) {
      box.classList.add("position-relative");
      var feedback = document.createElement("div");
      feedback.classList.add("invalid-tooltip");
      feedback.id = id + "Feedback";
      feedback.textContent = elem.validationMessage;
      box.append(feedback);
    } else {
      console.log("Error: No existe el elemento " + id + "Box");
    }
  });
}

function reloadFeedback(elem) {
  var id = elem.id;
  var feedback = document.getElementById(id + "Feedback");
  feedback.textContent = "";
  feedback.textContent = elem.validationMessage;
}
