document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("formulario");
  var requiredElements = form.querySelectorAll("[required]");
  requiredElements.forEach((elem) => {
    elem.addEventListener("input", () => {
      validarEnvio(elem);
      reloadFeedback(elem);
    });
  });
  errorFeedback(requiredElements);
  form.addEventListener("submit", function (event) {
    event.preventDefault();
    requiredElements.forEach((elem) => {
      validarEnvio(elem);
      reloadFeedback(elem);
    });
    if (form.checkValidity()) {
      form.submit();
    } else {
      window.location.href = "#";
    }
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

//CANCELAR EL ENVIO DEL FORMULARIO
function confirmCancel(event) {
    event.preventDefault();
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Si cancelas, se perderán los datos ingresados.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "index.php";
        }
    });
}