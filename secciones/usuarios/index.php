<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../templates/header.php");
  include("../../connection/conexion.php");
  include("../../secciones/usuarios/consulta.php");
} else {
  echo "Error en el sistema";
}

?>
<main id="main" class="main">
  <div class="row">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Usuarios</h3>
        <hr>
        <div class="btn-box justify-content-first">
          <a class="btn btn-outline-primary" href="crear.php" role="button">
            <i class="bi bi-person-fill"></i> Registrar Usuario
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table border-dark table-hover" id="myTable" style="border: 2px solid black">
            <thead class="table-dark">
              <tr class="table-active table-group-divider">
                <th scope="col">Num</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lista_usuarios as $registro) { ?>
                <tr>
                  <th scope="row"><?php echo $registro['id_usuarios']; ?></th>
                  <td><?php echo $registro['Nombres']; ?></td>
                  <td><?php echo $registro['Correo']; ?></td>
                  <td><?php echo $registro['Usuario']; ?></td>
                  <td><?php echo $registro['estado']; ?></td>
                  <td>
                    <a name="#" id="" class="btn btn-outline-info" role="button"><i class="bi bi-printer-fill"></i></a> |
                    <a name="" id="" class="btn btn-outline-warning" href="editar.php?txtID=<?php echo $registro['id_usuarios']; ?>" role="button"><i class="bi bi-pencil-square"></i></a> |
                    <a name="" id="" class="btn btn-outline-danger" onclick="eliminar(<?php echo $registro['id_usuarios']; ?>)" role="button"><i class="bi bi-trash-fill"></i></a>
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
      url: "./eliminar.php",
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
<script src="../../js/tables.js"></script>
<?php
include("../../templates/footer.php");
?>