var nombre = document.getElementById("nombre"),
  apellidos = document.getElementById("apellidos"),
  edad = document.getElementById("edad"),
  genero = document.getElementById("genero"),
  tipoPac = document.getElementById("tipoPaciente"),
  telUno = document.getElementById("telUno"),
  telDos = document.getElementById("telDos"),
  cp = document.getElementById("cp"),
  colonia = document.getElementById("colonia"),
  calle = document.getElementById("calle"),
  numExt = document.getElementById("numExt"),
  numInt = document.getElementById("numInt"),
  calleUno = document.getElementById("calleUno"),
  calleDos = document.getElementById("calleDos"),
  ref = document.getElementById("referencias"),
  exp = document.getElementById("expediente"),
  autGen = document.getElementById("autorizacionGen"),
  autEsp = document.getElementById("autorizacionEsp");
var errTelUno = document.getElementById("errTelUno"),
  errTelDos = document.getElementById("errTelDos");
var form = document.getElementById("formulario");
var add = document.getElementById("add");
var formArray = [
  nombre,
  apellidos,
  edad,
  genero,
  tipoPac,
  telUno,
  calle,
  numExt,
];

nombre.addEventListener("input", function () {
  var regex = /^[a-zA-Z\s]+$/;
  var string = nombre.value;
  if (!regex.test(string)) {
    nombre.value = string.slice(0, -1);
  }
});
apellidos.addEventListener("input", function () {
  var regex = /^[a-zA-Z\s]+$/;
  var string = apellidos.value;
  if (!regex.test(string)) {
    apellidos.value = string.slice(0, -1);
  }
});
edad.addEventListener("input", function () {
  var regex = /^\d{1,3}$/;
  var numero = edad.value;
  if (!regex.test(numero)) {
    edad.value = numero.slice(0, -1);
  }
});
telUno.addEventListener("input", function () {
  var regex = /^\d{1,10}$/;
  var numero = telUno.value;
  if (!regex.test(numero)) {
    telUno.value = numero.slice(0, -1);
  }
  valNum(telUno);
});
telDos.addEventListener("input", function () {
  var regex = /^\d{1,10}$/;
  var numero = telDos.value;
  if (!regex.test(numero)) {
    telDos.value = numero.slice(0, -1);
  }
  valNum(telDos);
});
calle.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\s]+$/;
  var string = calle.value;
  if (!regex.test(string)) {
    calle.value = string.slice(0, -1);
  }
});
numExt.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\s]+$/;
  var string = numExt.value;
  if (!regex.test(string)) {
    numExt.value = string.slice(0, -1);
  }
});
numInt.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\s]+$/;
  var string = numInt.value;
  if (!regex.test(string)) {
    numInt.value = string.slice(0, -1);
  }
});
calleUno.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\s]+$/;
  var string = calleUno.value;
  if (!regex.test(string)) {
    calleUno.value = string.slice(0, -1);
  }
});
calleDos.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\s]+$/;
  var string = calleDos.value;
  if (!regex.test(string)) {
    calleDos.value = string.slice(0, -1);
  }
});
exp.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\s]+$/;
  var string = exp.value;
  if (!regex.test(string)) {
    exp.value = string.slice(0, -1);
  }
});
autGen.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\s]+$/;
  var string = autGen.value;
  if (!regex.test(string)) {
    autGen.value = string.slice(0, -1);
  }
});
autEsp.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\s]+$/;
  var string = autEsp.value;
  if (!regex.test(string)) {
    autEsp.value = string.slice(0, -1);
  }
});

form.addEventListener("submit", function (event) {
  var idPac = document.getElementById("idPac");
  event.preventDefault();
  if (valNum(telUno) & valNum(telDos)) {
    if (validar(formArray)) {
      var formData = {
        nombres: nombre.value,
        apellidos: apellidos.value,
        genero: genero.value,
        edad: edad.value,
        tipo: tipoPac.value,
        telUno: telUno.value,
        telDos: telDos.value,

        colonia: colonia.value,
        calle: calle.value,
        numExt: numExt.value,
        numInt: numInt.value,
        calleUno: calleUno.value,
        calleDos: calleDos.value,
        referencias: ref.value,

        idPac: idPac.value,
      };
      
      if(idPac.value == 0){
      fetch("../model/nuevoPaciente.php", {
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
              window.location.replace("../index.php");
            });
          }
        });
      } else {
        fetch("../model/editarPaciente.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(formData),
        })
          .then((response) => response.json())
          .then((resultado) => {
  
            if (resultado == true) {
              Swal.fire({
                title: "Actualizado",
                text: "Paciente actualizado correctamente",
                icon: "success",
                showConfirmButton: false,
                timer: 1500,
              }).then(function () {
                window.location.replace("../index.php");
              });
            }
          });
      }
    } else {
      Swal.fire({
        title: "Faltan datos",
        text: "Revisa que todos los datos obligatorios estén ingresados",
        icon: "warning",
        showConfirmButton: false,
        timer: 2500,
      });
    }
  } else {
    window.location.href="#nombre";
  }
  reload();
  setInterval(reload, 1000);
});

function valNum(pointer) {
  var val = pointer.value;
  var id = pointer.getAttribute("id");
  if (val.length < 10 && val.length > 0) {
    if (id == "telUno") {
      errTelUno.textContent = "Debe de contener 10 dígitos";
      add.style.paddingTop = "";
    } else if (id == "telDos") {
      errTelDos.textContent = "Debe de contener 10 dígitos";
    }
    pointer.style.borderColor = "red";
    pointer.style.borderWidth = "2px";
    pointer.labels[0].style.color = "red";
    return false;
  } else if (val.length == 0 || val.length == 10) {
    if (id == "telUno") {
      errTelUno.textContent = "";
    } else if (id == "telDos") {
      errTelDos.textContent = "";
    }
    pointer.style.borderColor = "";
    pointer.style.borderWidth = "";
    pointer.labels[0].style.color = "";
    return true;
  }
}
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
  if (colonia.value == "") {
    colonia.style.borderColor = "red";
    cp.style.borderColor = "red";
    colonia.style.borderWidth = "2px";
    cp.style.borderWidth = "2px";
    colonia.labels[0].style.color = "red";
    cp.labels[0].style.color = "red";
  } else {
    colonia.style.borderColor = "";
    cp.style.borderColor = "";
    colonia.style.borderWidth = "";
    cp.style.borderWidth = "";
    colonia.labels[0].style.color = "";
    cp.labels[0].style.color = "";
  }
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
