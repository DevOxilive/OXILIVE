$(document).ready(function () {
  $("form").submit(function (event) {
    let nom = document.getElementById("nombres"),
      pac = document.getElementById("paciente"),
      serv = document.getElementById("servicio"),
      fechaServ = document.getElementById("fechaServicio"),
      horaIn = document.getElementById("horaEntrada"),
      horaOut = document.getElementById("horaSalida");

    var formSelector = [nom, pac, serv, fechaServ, horaIn, horaOut];
    event.preventDefault();
    if (validar(formSelector)) {
      if (document.getElementById("id")) {
        var formDataEdit = {
            nombres: $("#nombres").val(),
            paciente: $("#paciente").val(),
            servicio: $("#servicio").val(),
            fechaServicio: $("#fechaServicio").val(),
            horaEntrada: $("#horaEntrada").val(),
            horaSalida: $("#horaSalida").val(),
            idHor: $("#id").val(),
        };
        $.ajax({
            type: "POST",
            url: "../model/actualizarServicio.php",
            data: formDataEdit,
            success: function() {
                Swal.fire({
                    title: "Actualizado",
                    text: "Registro actualizado correctamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.replace('../index.php');
                });
            }
        });
      } else {
        var formData = {
            nombres: $("#nombres").val(),
            paciente: $("#paciente").val(),
            servicio: $("#servicio").val(),
            fechaServicio: $("#fechaServicio").val(),
            horaEntrada: $("#horaEntrada").val(),
            horaSalida: $("#horaSalida").val(),
          };
        $.ajax({
          type: "POST",
          url: "../model/nuevoHorario.php",
          data: formData,
          success: function () {
            Swal.fire({
              title: "Registrado",
              text: "Registro realizado correctamente",
              icon: "success",
              showConfirmButton: false,
              timer: 1500,
            }).then(function () {
              window.location.replace("../index.php");
            });
          },
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
      error(formSelector);
      setInterval(() => {
        error(formSelector);
      }, 1500);
    }
  });
});
