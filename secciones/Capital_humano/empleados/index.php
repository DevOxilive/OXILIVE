<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
  include_once("../../../module/empleados.php");
} else {
  echo "Error en el sistema";
}

?>
<main id="main" class="main">
<div class="card">
  <div class="card-header">
    <a name="" id="" class="btn btn-outline-primary" href="crear.php" role="button"><i class="bi bi-person-fill-up"></i>    Registrar Empleado</a>
  </div>
  <div class="card-body">
    <div class="table-responsive-sm">
      <table class="table   border-dark table-hover" id="myTable">
        <thead class="table-dark">
          <tr>
            <th scope="col">Num</th>
            <th scope="col">Nombre</th>
            <th scope="col">RFC</th>
            <th scope="col">Puesto</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($lista_empleados as $registro) { ?>

            <tr class="">
              <th scope="row">
                <?php echo $registro['id_empleados'] ?>
              </th>
              <td>
                <?php echo $registro['Nombres']." ".$registro['Apellidos']?>
              </td>
              <td>
                <?php echo $registro['rfc'] ?>
              </td>
              <td>
              <?php echo $registro['p'] ?>
              </td>
              <td>
                <a name="" id="" class="btn btn-outline-warning"
                href="editar.php?txtID=<?php echo $registro['id_empleados']; ?>" role="button"><i
                    class="bi bi-pencil-square"></i></a> |
                <a name="" id="" class="btn btn-outline-danger"
                  onclick="eliminar(<?php echo $registro['id_empleados']; ?>)" role="button" style="font-size=10px;"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
</main>
<script>
  function eliminar(codigo) {
    Swal.fire({
      title: '¿Estas seguro?',
      text: "No podrás recuperar los datos",
      cancelButtonText: 'Cancelar',
      icon: 'warning',
      buttons: true,
      showCancelButton: true,
      dangerMode: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        mandar(codigo)
      }
    })
  }

  function mandar(codigo) {
    parametros = { id: codigo };
    $.ajax({
      data: parametros,
      url: "./eliminar.php",
      type: "POST",
      beforeSend: function () { },
      success: function () {
        Swal.fire("Eliminado:", "Ha sido eliminado", "success").then((result) => {
          window.location.href = "index.php";


        });
      },

    });



    // Agrega la animación a los bordes de las filas
    const rows = document.querySelectorAll(".animated-border");
    rows.forEach(row => {
      row.addEventListener("mouseover", () => {
        row.classList.add("border-animation");
      });
      row.addEventListener("mouseout", () => {
        row.classList.remove("border-animation");
      });
    });



  }
  $(document).ready(function () {
    $.noConflict();

    $('#myTable').DataTable({
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      }
    });

  });


</script>
<?php
include("../../../templates/footer.php");
?>