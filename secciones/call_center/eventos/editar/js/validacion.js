var fechaServicio = document.getElementById("fechaServicio"),
horaEntrada = document.getElementById("horaEntrada"),
motivoConsulta = document.getElementById("motivoConsulta"),
nAutorizacion = document.getElementById("nAutorizacion"),
auEspecial = document.getElementById("auEspecial"),
asignarMedico = document.getElementById("asignarMedico"),
tipoServicio = document.getElementsByName("tipoServicio");
var elementosServicios = Array.from(tipoServicio.children);
var form = document.getElementById("formulario");


var formArray = [
fechaServicio,
horaEntrada,
motivoConsulta,
nAutorizacion,
auEspecial,
asignarMedico,
tipoServicio,
];

fechaServicio.addEventListener("input", function () {
    var inputDate = new Date(fechaServicio.value);
    var currentDate = new Date();
    // Compara la fecha ingresada con la fecha actual
    if (inputDate < currentDate) {
        // Si la fecha ingresada es anterior a la actual, establece la fecha actual en el campo
        var day = ("0" + currentDate.getDate()).slice(-2);
        var month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
        var year = currentDate.getFullYear();
        fechaServicio.value = year + "-" + month + "-" + day;
    }
});

form.addEventListener("submit", function (event) {
  var usuariosMostrados = document.getElementById("usuariosMostrados");
  var elementosPaciente = Array.from(usuariosMostrados.children);
  var ids_sv = document.getElementById('ids_sv');
  var elemnetosIdsv = Array.from(ids_sv.children);
  event.preventDefault();
    if (validar(formArray)) {
      var formData = {
        fechaServicio: fechaServicio.value,
        horaEntrada: horaEntrada.value,
        motivoConsulta: motivoConsulta.value,
        nAutorizacion: nAutorizacion.value,
        auEspecial: auEspecial.value,
        asignarMedico: asignarMedico.value,
        elementosServicios: tipoServicio.value,
        
        elementosPaciente: usuariosMostrados.value,
        elemnetosIdsv: ids_sv.value

      };
      
      if(ids_sv.value !== null && ids_sv.value !== undefined && usuariosMostrados.value !== null && usuariosMostrados.value !== undefined){
      fetch("../model/editarEvento.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      })
        .then((response) => response.json())
        .then((resultado) => {

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
}

});



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
