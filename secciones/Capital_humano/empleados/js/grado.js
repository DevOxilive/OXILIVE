$(document).ready(function () {
  $("#grado").change(function () {
    var gradoSeleccionado = $(this).val();
    busquedaGrado(gradoSeleccionado);
  });
  function busquedaGrado(grado) {
    $.ajax({
      type: "POST",
      url: "./grado.php",
      data: {
        grado: grado,
      },
      success: function (responder) {
        if (responder != "") {
          $("#departamento").html(responder);
        }
      },
    });
  }
  var grado = $("#grado").val();
  busquedaGrado(grado);
});
