var medicamento_1 = document.getElementById("medicamento_1"),
  horario_1 = document.getElementById("horario_1"),
  medicamento_2 = document.getElementById("medicamento_2"),
  horario_2 = document.getElementById("horario_2"),
  medicamento_3= document.getElementById("medicamento_3"),
  horario_3 = document.getElementById("horario_3"),
  medicamento_4 = document.getElementById("medicamento_4"),
  horario_4 = document.getElementById("horario_4"),
  medicamento_5 = document.getElementById("medicamento_5"),
  horario_5 = document.getElementById("horario_5");

var form = document.getElementById("formulario");

var formArray = [
medicamento_1,
horario_1,

];


          


form.addEventListener("submit", function (event) {
  event.preventDefault();
    if (validar(formArray)) {
      var formData = {
     medicamento_1: medicamento_1.value,
     horario_1: horario_1.value,
     medicamento_2: medicamento_2.value,
     horario_2: horario_2.value,
     medicamento_3: medicamento_3.value,
     horario_3: horario_3.value,
     medicamento_4: medicamento_4.value,
     horario_4: horario_4.value,
     medicamento_5: medicamento_5.value,
     horario_5: horario_5.value,

      };
      fetch("guardar.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      })
        .then((response) => response.text())
        .then((resultado) => {
            console.log(resultado);
            Swal.fire({
              title: "Registrado",
              text: "Registro realizado correctamente",
              icon: "success",
              showConfirmButton: false,
              timer: 1500,
            }).then(function () {
              window.location.replace("index.php");
            });
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
