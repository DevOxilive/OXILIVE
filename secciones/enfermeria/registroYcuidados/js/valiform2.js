var solucion = document.getElementById("solucion"),
  fecha = document.getElementById("fecha"),
  cantidad = document.getElementById("cantidad"),
  goteo = document.getElementById("goteo"),
  frecuencia = document.getElementById("frecuencia"),
  inicia = document.getElementById("inicia"),
  termina = document.getElementById("termina");
var form = document.getElementById("formulario");

cantidad.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9.,\-\/\s]+$/;
  var string = cantidad.value;
  if (!regex.test(string)) {
    cantidad.value = string.slice(0, -1);
  }
});
goteo.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9.,\-\/\s]+$/;
  var string = goteo.value;
  if (!regex.test(string)) {
    goteo.value = string.slice(0, -1);
  }
});
frecuencia.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9.,\-\/\s]+$/;
  var string = frecuencia.value;
  if (!regex.test(string)) {
    frecuencia.value = string.slice(0, -1);
  }
});
inicia.addEventListener("input", function () {
  var inputTime = inicia.value; // Obtiene el valor ingresado en el campo de hora
  var currentTime = new Date(); // Obtiene la hora actual
  var enteredTime = new Date(currentTime.toDateString() + " " + inputTime); // Crea un objeto de fecha con la hora ingresada
  if (enteredTime < currentTime) {
    // Si la hora ingresada es anterior a la hora actual, restablece el valor del campo de hora
    inicia.value = "";
    alert("La hora no puede ser anterior a la hora actual.");
  }
});
termina.addEventListener("input", function () {
    var inputTime = termina.value; // Obtiene el valor ingresado en el campo de hora
    var currentTime = new Date(); // Obtiene la hora actual
    var enteredTime = new Date(currentTime.toDateString() + " " + inputTime); // Crea un objeto de fecha con la hora ingresada
    if (enteredTime < currentTime) {
      // Si la hora ingresada es anterior a la hora actual, restablece el valor del campo de hora
      termina.value = "";
      alert("La hora no puede ser anterior a la hora actual.");
    }
  });



form.addEventListener("submit", function (event) {
  event.preventDefault();
      var formData = {
        solucion: solucion.value,
        fecha: fecha.value,
        cantidad: cantidad.value,
        goteo: cantidad.value,
        frecuencia: frecuencia.value,
        inicia: inicia.value,
        termina: termina.value,

      };
      fetch("procesarf2.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      })
        .then((response) => response.text())
        .then((resultado) => {
            console.log(resultado);
          if (resultado == true) {
            Swal.fire({
              title: "Datos Registrados",
              text: "continúa en la siguiente pagina",
              icon: "success",
              showConfirmButton: false,
              timer: 1500,
            }).then(function () {
              window.location.replace("form3.php");
            });
          }
        });
  
});


