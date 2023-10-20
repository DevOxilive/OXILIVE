function confirmCancel(event) {
  event.preventDefault();
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Si cancelas, se perderán los datos ingresados.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, cancelar",
    cancelButtonText: "No, continuar",
  }).then((result) => {
    if (result.isConfirmed) {
      // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
      window.location.href = "../index.php";
    }
  });
}

/*$(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
      nombres: $("#nombre").val(),
      apellidos: $("#apellidos").val(),
      genero: $("#genero").val(),
      edad: $("#edad").val(),
      tipo: $("#tipoPaciente").val(),
      telUno: $("#telUno").val(),
      telDos: $("#telDos").val(),

      colonia: $("#colonia").val(),
      calle: $("#calle").val(),
      numExt: $("#numExt").val(),
      numInt: $("#numInt").val(),
      calleUno: $("#calleUno").val(),
      calleDos: $("#calleDos").val(),
      referencias: $("#referencias").val(),

      administradora: $("#administradora").val(),
            banco: $("#banco").val(),
            expediente: $("#expediente").val(),
            autorizacionGen: $("#autorizacionGen").val(),
            autorizacionEsp: $("#autorizacionEsp").val(),
            deducible: $("#deducible").val(),
    };
    fetch("../model/nuevoPaciente.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(formData),
    })
      .then((response) => response.json())
      .then((resultado) => {

        console.log(resultado);
        Swal.fire({
          title: "Registrado",
          text: "Registro realizado correctamente",
          icon: "success",
          showConfirmButton: false,
          timer: 1500,
        }).then(function () {
          window.location.replace("../index.php");
        });
      });
  });
});*/
