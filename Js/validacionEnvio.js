document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("formulario");
  form.addEventListener("submit", function(event) {
    event.preventDefault();
    var requiredElements = form.querySelectorAll("[required]");
    validarEnvio(requiredElements);
    window.location.href = "#header";
    setInterval(() => {
        validarEnvio(requiredElements);
    }, 1500);
  });
});

function validarEnvio(elems){
elems.forEach(function (elemento) {
      if (elemento.checkValidity()) {
        elemento.classList.toggle("is-valid", true);
        elemento.classList.toggle("is-invalid", false);
      } else {
        elemento.classList.toggle("is-invalid", true);
        elemento.classList.toggle("is-valid", false);
        
      }
    });

}
