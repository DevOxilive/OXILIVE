<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
  include("./consulta.php");
} else {
  echo "Error en el sistema";
}

?>

<main id="main" class="main">
  <div class="row">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Pacientes Generales</h3>
        <hr>
        <div class="btn-box justify-content-first">
          <a class="btn btn-outline-primary" href="buscador.php" role="button">
            <i class="bi bi-person-fill-add"></i> Crear Hoja Complementaria
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table table-striped" id="myTable" >
            <thead class="customers">
              <tr class="table-active table-group-divider">
                <th scope="col">Num</th>
                <th scope="col">Nombre(s)</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Aseguradora</th>
                <th scope="col">Telefono</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pacientes as $pacien) { ?>
                <tr>
                  <th scope="row"><?php echo $pacien['id_pacientes']; ?></th>
                  <td><?php echo $pacien['nombres']; ?></td>
                  <td><?php echo $pacien['apellidos']; ?></td>
                  <td><?php echo $pacien['Nombre_banco']; ?></td>
                  <td><?php echo $pacien['telefono']; ?></td>
                  <td>
                    <a name="" id="" class="btn btn-outline-info" href="pacientes.php?txtID=<?php echo $pacien['id_pacientes']; ?>" role="button" style="font-size=10px;"><i class="bi bi-file-earmark-pdf"></i></a> |
                    <a name="" id="" class="btn btn-outline-warning" href="crear/editarPaciente.php?txtID=<?php echo $pacien['id_pacientes']; ?>" role="button"><i class="bi bi-pencil-square"></i></a>
                    <!-- <a name="" id="" class="btn btn-outline-danger"
                  onclick="eliminar(<?php echo $pacien['id_pacientes']; ?>)" role="button" style="font-size=10px;"><i
                    class="bi bi-trash-fill"></i></a> -->
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</main><!-- End #main -->
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
    parametros = {
      id: codigo
    };
    $.ajax({
      data: parametros,
      url: "model/eliminar.php",
      type: "POST",
      beforeSend: function() {},
      success: function() {
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
</script>
<script src="../../../js/tables.js"></script>
<?php
include("../../../templates/footer.php");
?>