//Traemos los input del formulario
const nomServ = document.getElementById("nombreServicio"),
  sueldo = document.getElementById("sueldo");
nomServ.addEventListener("input", function () {
    const regex = /^[a-zA-Z0-9\s]+$/;
    var string = nomServ.value;
    if (!regex.test(string)) {
        nomServ.value = string.slice(0, -1);
      }
})
sueldo.addEventListener("input", function () {
    const regex = /^\d+$/;
    var string = sueldo.value;
    if (!regex.test(string)) {
        sueldo.value = string.slice(0, -1);
      }
})
$(document).ready(function () {
  $("form").submit(function (event) {
    const nomServ = document.getElementById("nombreServicio"),
      horas = document.getElementById("horasServicio"),
      sueldo = document.getElementById("sueldo");
    var form = [nomServ, horas, sueldo];
    //Prevenimos el envío del formulario como tiene predeterminado el botón
    event.preventDefault();
    if (validarForm(form)) {
      //Se valida si es crear o editar con la etiqueta escondida "id", ya que sólo existe en el editar
      if (document.getElementById("id")) {
        //Función para editar servicio existente
        actualizar();
      } else {
        validarUnique();
      }
    } else {
      error(form);
      setInterval(() => {
        error(form);
      }, 1500);
      console.log(validarForm(form));
      Swal.fire({
        title: "Faltan datos",
        text: "Hacen falta datos en el formulario. Revisa que tenga todos los datos necesarios.",
        icon: "warning",
        showConfirmButton: false,
        timer: 2500,
      });
    }
  });
});
function actualizar() {
  const nomServ = document.getElementById("nombreServicio"),
    horas = document.getElementById("horasServicio"),
    sueldo = document.getElementById("sueldo"),
    id = document.getElementById("id");
  var formData = {
    nomServ: nomServ.value,
    horasServ: horas.value,
    sueldo: sueldo.value,
    id: id.value,
  };
  $.ajax({
    type: "POST",
    url: "model/actualizarTServicio.php",
    data: formData,
    success: function () {
      Swal.fire({
        title: "Actualizado",
        text: "Registro actualizado correctamente",
        icon: "success",
        showConfirmButton: false,
        timer: 1500,
      }).then(function () {
        window.location.replace("index.php");
      });
    },
  });
}
function crear() {
  const nomServ = document.getElementById("nombreServicio"),
    horas = document.getElementById("horasServicio"),
    sueldo = document.getElementById("sueldo");
  //Datos para encriptar en JSON
  var formData = {
    nomServ: nomServ.value,
    horasServ: horas.value,
    sueldo: sueldo.value,
  };
  $.ajax({
    type: "POST",
    url: "model/nuevoTServicio.php",
    data: formData,
    success: function () {
      Swal.fire({
        title: "Registrado",
        text: "Registro realizado correctamente",
        icon: "success",
        showConfirmButton: false,
        timer: 1500,
      }).then(function () {
        window.location.replace("index.php");
      });
    },
  });
}
function validarUnique() {
  const nomServ = document.getElementById("nombreServicio");
  fetch("model/unique.php", {
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ nomServ: nomServ.value }),
    method: "POST",
  })
    .then((response) => response.json())
    .then((dato) => {
      if (dato[0].cont == 0) {
        crear();
      } else {
        Swal.fire({
          title: "Error",
          text: "Servicio ya existente. Revisa el nombre del servicio.",
          icon: "warning",
          showConfirmButton: false,
          timer: 2500,
        });
      }
    });
}
function validarForm(form) {
  for (var i = 0; i < form.length; i++) {
    if (
      form[i].value === undefined ||
      form[i].value === null ||
      form[i].value === ""
    ) {
      return false; // Si encuentra un elemento sin datos, retorna falso
    }
  }
  return true;
}
function error(form) {
  var etiqueta;
  const span = document.getElementById("spanSueldo");
  form.forEach((dato) => {
    etiqueta = dato.labels[0];
    if (dato.value === "" || dato.value === undefined || dato.value === null) {
      dato.style.borderColor = "red";
      dato.style.borderWidth = "2px";
      etiqueta.style.color = "red";
      span.style.backgroundColor = "#F59184";
      span.style.borderColor = "red";
    } else {
      dato.style.borderColor = "";
      dato.style.borderWidth = "";
      etiqueta.style.color = "";
      span.style.backgroundColor = "";
      span.style.borderColor = "";
    }
  });
}
