var 
fechaServicio = document.getElementById("fechaServicio"),
horaEntrada = document.getElementById("horaEntrada"),
motivoConsulta = document.getElementById("motivoConsulta"),
nAutorizacion = document.getElementById("nAutorizacion"),
auEspecial = document.getElementById("auEspecial"),
asignarMedico = document.getElementById("asignarMedico");
var tipoServicioElements = document.getElementsByName("tipoServicio");
var tipoServicioValues = [];
var form = document.getElementById("formulario");

for (var i = 0; i < tipoServicioElements.length; i++) {
  tipoServicioValues.push(tipoServicioElements[i].value);
}

var formArray = [
fechaServicio,
horaEntrada,
motivoConsulta,
nAutorizacion,
auEspecial,

];

form.addEventListener("submit", function (event) {
  var id_sv = document.getElementById("id_sv");
  event.preventDefault();
    if (validar(formArray)) {
      var formData = {
       

       fechaServicio: fechaServicio.value,
       horaEntrada: horaEntrada.value,
       motivoConsulta: motivoConsulta.value,
       nAutorizacion: nAutorizacion.value,
       auEspecial: auEspecial.value,
       asignarMedico: asignarMedico.value,
       tipoServicio: tipoServicioValues,

       id_sv: id_sv.value
      };

      fetch("model/guardarEvento.php", {
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
             window.location.replace("../../cancelar/cancelar.php");
            });
          }
        });
    } else {
      Swal.fire({
        title: "Faltan datos",
        text: "Revisa que todos los datos obligatorios estén ingresados",
        icon: "warning",
        showConfirmButton: false,
        timer: 2500,
      });
    }
  reload();
  setInterval(reload, 1000);
});

function reload() {
  var etiqueta;
  formArray.forEach((campo) => {
    etiqueta = campo.labels[0];
    if (campo.value == "") {
      campo.style.borderColor = "red";
      campo.style.borderWidth = "2px";
      etiqueta.style.color = "red";
    } else {
      campo.style.borderColor = "";
      campo.style.borderWidth = "";
      etiqueta.style.color = "";
    }
  });
  
}
function validar(arre) {
  for (var i = 0; i < arre.length; i++) {
    if (
      arre[i].value === undefined ||
      arre[i].value === null ||
      arre[i].value === ""
    ) {
      return false; // Si encuentra un elemento sin datos, retorna falso
    }
  }
  return true;
}

