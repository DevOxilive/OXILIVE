var drescripcionCuracion = document.getElementById("drescripcionCuracion"),
notaEnfermeria = document.getElementById("notaEnfermeria"),
descripComidas = document.getElementById("descripComidas"),
horarioComidas = document.getElementById("horarioComidas");
var form = document.getElementById("formulario");

form.addEventListener("submit", function (event) {
  event.preventDefault();
      var formData = {
        drescripcionCuracion: drescripcionCuracion.value,
        notaEnfermeria: notaEnfermeria.value,
        descripComidas: descripComidas.value,
        horarioComidas: horarioComidas.value,
    
      };
      fetch("procesarf3.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      })
        .then((response) => response.text())
        .then((resultado) => {
            console.log(resultado);
          if (resultado == true) {
            Swal.fire({
              title: "Registrado",
              text: "Registro realizado correctamente",
              icon: "success",
              showConfirmButton: false,
              timer: 1500,
            }).then(function () {
              window.location.replace("form4.php");
            });
          }
        });
});



