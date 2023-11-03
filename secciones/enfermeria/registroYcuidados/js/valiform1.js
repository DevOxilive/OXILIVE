var peso = document.getElementById("peso"),
  diagnosticoMedico = document.getElementById("diagnosticoMedico"),
  temperatura = document.getElementById("temperatura"),
  pulso = document.getElementById("pulso"),
  respiracion= document.getElementById("respiracion"),
  tensionArterial = document.getElementById("tensionArterial"),
  spo2 = document.getElementById("spo2"),
  glicemiaCapilar = document.getElementById("glicemiaCapilar");
  vomito = document.getElementById("vomito");
  evacuaciones = document.getElementById("evacuaciones");
  orina = document.getElementById("orina");
  ingestaLiquidos = document.getElementById("ingestaLiquidos");
  caidas = document.getElementById("caidas");
  drenajesVendajes = document.getElementById("drenajesVendajes");
  uppHh = document.getElementById("uppHh");
  descripcionUpp = document.getElementById("descripcionUpp");

var form = document.getElementById("formulario");

var formArray = [
peso,
diagnosticoMedico,
temperatura,
pulso,
respiracion,
tensionArterial,
];

peso.addEventListener("input", function () {
  var regex = /^\d+(\.\d{1,2})?$/;
  var numero = peso.value;
  if (!regex.test(numero)) {
    peso.value = numero.slice(0, -1);
  }
});
diagnosticoMedico.addEventListener("input", function () {
  var regex = /^[a-zA-Z0-9\-.,\s]+$/;
  var string = diagnosticoMedico.value;
  if (!regex.test(string)) {
    diagnosticoMedico.value = string.slice(0, -1);
  }
});
temperatura.addEventListener("input", function () {
  var regex = /^\d+(\.\d{1,2})?$/;
  var numero = temperatura.value;
  if (!regex.test(numero)) {
    temperatura.value = numero.slice(0, -1);
  }
});
pulso.addEventListener("input", function () {
  var regex = /^\d+(\.\d{1,2})?$/;
  var numero = pulso.value;
  if (!regex.test(numero)) {
    pulso.value = numero.slice(0, -1);
  }
});
respiracion.addEventListener("input", function () {
  var regex = /^\d+(\.\d{1,2})?$/;
  var numero = respiracion.value;
  if (!regex.test(numero)) {
    respiracion.value = numero.slice(0, -1);
  }
});
tensionArterial.addEventListener("input", function () {
    var regex = /^\d{1,3}\/\d{1,3}$/;
    var string = tensionArterial.value;
    if (!regex.test(string)) {
      // Eliminar cualquier caracter no permitido (excepto números y '/')
      tensionArterial.value = string.replace(/[^\d/]/g, '');
    }
  });
spo2.addEventListener("input", function () {
  var regex = /^\d+$/;
  var numero = spo2.value;
  if (!regex.test(numero)) {
    spo2.value = numero.slice(0, -1);
  }
});
glicemiaCapilar.addEventListener("input", function () {
  var regex = /^\d+(\.\d{1,2})?$/;
  var string = glicemiaCapilar.value;
  if (!regex.test(string)) {
    glicemiaCapilar.value = string.slice(0, -1);
  }
});


form.addEventListener("submit", function (event) {
  event.preventDefault();
    if (validar(formArray)) {
      var formData = {
        peso: peso.value,
        diagnosticoMedico: diagnosticoMedico.value,
        temperatura: temperatura.value,
        pulso: pulso.value,
        respiracion: respiracion.value,
        tensionArterial: tensionArterial.value,
        
        spo2: spo2.value,
        glicemiaCapilar: glicemiaCapilar.value,
        vomito: vomito.value,
        evacuaciones: evacuaciones.value,
        orina: orina.value,
        ingestaLiquidos: ingestaLiquidos.value,
        caidas: caidas.value,
        drenajesVendajes: drenajesVendajes.value,
        uppHh: uppHh.value,
        descripcionUpp: descripcionUpp.value,
      };
      fetch("procesarf1.php", {
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
              window.location.replace("form2.php");
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
