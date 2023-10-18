// Selecciona el elemento de entrada y el elemento para mostrar mensajes de error
var numeroInput = document.getElementById("cp");

// Agrega un evento de entrada al campo de entrada
numeroInput.addEventListener("input", function () {
  // Expresión regular para validar números enteros de hasta 5 dígitos
  var regex = /^\d{1,5}$/;
  var numero = numeroInput.value;
  var colonia = document.getElementById("colonia");
  var delMun = document.getElementById("delMun");
  var estadoDir = document.getElementById("estadoDir");

  if (regex.test(numero)) {
    if (numero.length == 5) {
      var invalido = '<option value="">Código Postal inválido</option>';
      colonia.innerHTML = "";
      delMun.innerHTML = "";
      estadoDir.innerHTML = "";
      var data = { codigo_postal: numero };
      fetch("../model/domicilio.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      })
        .then((data) => data.json())
        .then((data) => {
          console.log(data);
          if (data != "") {
            data.forEach((dato) => {
              console.log(dato);
              colonia.innerHTML +=
                "<option value='" + dato.id + "'>" +
                dato.nombre +
                "</option>";
              delMun.innerHTML =
                "<option value=''>" +
                dato.municipioName +
                "</option>";
              estadoDir.innerHTML =
                "<option value=''>" +
                dato.estadoName +
                "</option>";
            });
          } else {
            colonia.innerHTML = invalido;
            delMun.innerHTML = invalido;
            estadoDir.innerHTML = invalido;
          }
        })
        .catch((error) => console.error("Error: " + error));
    } else {
      var reset = '<option value="">Selecciona un Código Postal</option>';
      colonia.innerHTML = reset;
      delMun.innerHTML = reset;
      estadoDir.innerHTML = reset;
    }
  } else {
    // La entrada no es un número válido o excede los 5 dígitos
    numeroInput.value = numero.slice(0, -1);
  }
});
