<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../templates/header.php");
  include("../../connection/conexion.php");
  include("./model/empleadosUsu.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
  <div class="row">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Empleados sin Usuario</h3>
        <hr>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table border-dark table-hover" id="myTable" style="border: 2px solid black">
            <thead class="table-dark">
              <tr class="table-active table-group-divider">
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($empleados as $registro) { ?>
                <tr>
                  <th><?php echo $registro['id_empleado']; ?></th>
                  <td><?php echo $registro['nombres']; ?></td>
                  <td><?php echo $registro['apellidos']; ?></td>
                  <td>
                    <a name="" id="" href="crear.php?idus=<?php echo $registro['id_empleado']; ?>" class="btn btn-success" role="button">
                      <i class="bi bi-plus-lg"></i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Usuarios Registrados</h3>
        <hr>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table border-dark table-hover" id="usuarios" style="border: 2px solid black">
            <thead class="table-dark">
              <tr class="table-active table-group-divider">
                <th scope="col">Username</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Departamento</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $colorSt;
              $colorDpto;
              foreach ($usuarios as $registro) {
                switch ($registro['estadoUsuarios']) {
                    //Activo
                  case 1:
                    $colorSt = "badge text-bg-success fs-6";
                    break;
                    //Suspendido
                  case 2:
                    $colorSt = "badge text-bg-warning fs-6";
                    break;
                    //Baja
                  case 3:
                    $colorSt = "badge text-bg-danger fs-6";
                    break;
                    //En ruta
                  case 4:
                    $colorSt = "badge text-bg-info fs-6";
                    break;
                    //En Servicio
                  case 5:
                    $colorSt = "badge text-bg-info fs-6";
                    break;
                }
                //Administrador general
                if ($registro['departamento'] == 1) {
                  $colorDpto = "badge text-bg-dark fs-6";
                }
                //Administrador de departamento
                else if ($registro['departamento'] == 3 || $registro['departamento'] == 4 || $registro['departamento'] == 5 || $registro['departamento'] == 6 || $registro['departamento'] == 7) {
                  $colorDpto = "badge text-bg-primary fs-6";
                }
                //Usuario
                else if ($registro['departamento'] == 9 || $registro['departamento'] == 11 || $registro['departamento'] == 12) {
                  $colorDpto = "badge text-bg-secondary fs-6";
                }
              ?>
                <tr>
                  <th><?php echo $registro['usuario']; ?></th>
                  <td><?php echo $registro['nombres']; ?></td>
                  <td><?php echo $registro['apellidos']; ?></td>
                  <td>
                    <span class="<?php echo $colorDpto; ?>"><?php echo $registro['depto']; ?></span>
                  </td>
                  <td>
                    <span class="<?php echo $colorSt; ?>"><?php echo $registro['estadoName']; ?></span>
                  </td>
                  <td>
                    <a name="" id="" href="#" class="btn btn-warning" role="button">
                      <i class="bi bi-pencil-square"></i>
                    </a> |
                    <a name="" id="" href="#" onclick="eliminar(<?php echo $registro['id_usuarios']; ?>)" class="btn btn-danger" role="button">
                      <i class="bi bi-trash-fill"></i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="../../js/tables.js"></script>
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
  }
</script>
<?php
include("../../templates/footer.php");
?>