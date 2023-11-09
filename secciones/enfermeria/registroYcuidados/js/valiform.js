var numeroAsignacion = document.getElementById("numeroAsignacion"),
  paciente = document.getElementById("paciente"),
  servicio = document.getElementById("servicio"),
  responsable = document.getElementById("responsable"),
  edad = document.getElementById("edad"),
  medico = document.getElementById("medico"),
  enfermero = document.getElementById("enfermero");

var form = document.getElementById("formulario");





form.addEventListener("submit", function (event) {
  event.preventDefault();
  
      var formData = {
        numeroAsignacion: numeroAsignacion.value,
        paciente: paciente.value,
        servicio: servicio.value,
        responsable: responsable.value,
        edad: edad.value,
        medico: medico.value,
        enfermero: enfermero.value,
      };
      fetch("procesarf.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      })
        .then((response) => response.text())
        .then((resultado) => {
            console.log(resultado);
          if (resultado == true) {
            Swal.fire({
              icon: "success",
              title: "Registro Iniciado",
              showConfirmButton: false,
              timer: 1500
            }).then(function () {
              window.location.replace("form1.php");
            });
          }
        });

});



