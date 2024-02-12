//Script fecha para evitar registros previos a la fecha actual

// Obtener fecha actual
let fecha = new Date();
// Obtener cadena en formato yyyy-mm-dd, eliminando zona y hora
let fechaMin = fecha.toISOString().split("T")[0];
// Asignar valor mínimo
document.querySelector("#fechaServicio").min = fechaMin;

function validar(form) {
  for (var i = 0; i < form.length; i++) {
    if (
      form[i].value === "" ||
      form[i].value === "00:00:00" ||
      form[i].value === "0000-00-00"
    ) {
      return false;
    }
  }
  return true;
}

function error(form) {
  var etiqueta;
  form.forEach((arrow) => {
    etiqueta = arrow.labels[0];
    if (
      arrow.value == "" ||
      arrow.value == "00:00:00" ||
      arrow.value == "0000-00-00"
    ) {
      arrow.style.borderColor = "red";
      arrow.style.borderWidth = "2px";
      etiqueta.style.color = "red";
    } else {
      arrow.style.borderColor = "";
      arrow.style.borderWidth = "";
      etiqueta.style.color = "";
    }
  });
}
