<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  //inclucion de archivos requeridos
  include("../../templates/header.php");
  include("../../connection/conexion.php");
  // archivo encargado de traer los puestos.
  include("../../secciones/puestos/consulta.php");
  include("../../model/genero.php");
  include("../../model/estado.php");
} else {
  echo "Error en el sistema";
}

$id_usuario = $_GET['idus'];

$stmt = $con->prepare("SELECT * FROM empleados WHERE id_empleado = $id_usuario;");
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $dato) {
?>
  <!DOCTYPE html>
  <link rel="stylesheet" href="../../assets/css/foto_perfil.css">
  <link rel="stylesheet" href="../../assets/css/edit.css">
  </head>

  </html>
  <main id="main" class="main">
    <section class="section dashboard">
      <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
          <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            asignacion de Usuario</H4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
          <form action="./usuariosADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3">
            <h1>Datos</h1>
            <hr>
            <div class="contenido col-md-1">
              <label for="idus" class="form-label">NUM</label>
              <input type="text" class="form-control" name="idus" id="id" value="<?php echo $dato['id_empleado']; ?>" readonly>
            </div>
            <div class="contenido col-md-3">
              <label for="nombres" class="form-label">Nombres</label>
              <input type="text" class="form-control" name="nombres" id="nombres" value="<?php echo $dato['nombres']; ?>" readonly>
            </div>
            <div class="contenido col-md-3">
              <label for="apellidos" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $dato['apellidos']; ?>" readonly>
            </div>
            <div class="contenido col-md-3">
              <label for="departamento" class="form-label">Departamento</label>
              <select name="departamento" id="departamento">
                <?php

                foreach ($lista_puestos as $key => $value) {
                  if ($value['id_puestos'] === $dato['departamento']) {
                    echo ' <option value="' . $dato['departamento'] . '">' . $value['Nombre_puestos'] . '</option> ';
                  }
                }
                foreach ($lista_puestos as $key => $value) {
                  if ($value['id_puestos'] != $dato['departamento']) {
                    echo ' <option value="' . $value['id_puestos'] . '">' . $value['Nombre_puestos'] . '</option> ';
                  }
                }
                ?>
              </select>
            </div>
            <h1>Acceso al sistema</h1>
            <hr>
            <div class="contenido col-md-2">
              <label for="usuario" class="form-label">Usuario</label>
              <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
            </div>
            <div class="contenido col-md-2">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="contraseña" class="">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-outline-primary">Guardar</button>
              <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
            </div>
          </form>
        </div>
      </div>
  </main>
  <script>
    function confirmCancel(event) {
      event.preventDefault();
      Swal.fire({
        title: '¿Estás seguro?',
        text: "Si cancelas, se perderán los datos ingresados.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar'
      }).then((result) => {
        if (result.isConfirmed) {
          // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
          window.location.href = "<?php echo $url_base; ?>secciones/usuarios/index.php";
        }
      });
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.querySelector('.formLogin').addEventListener('submit', function(event) {
        // Evita el envío del formulario por defecto
        event.preventDefault();
        var usuario = document.getElementById('usuario').value;
        var password = document.getElementById('password').value;


        if (!usuario || !password) {
          Swal.fire({
            icon: 'error',
            title: 'Campos vacíos',
            text: 'Por favor, completa todos los campos obligatorios.',
          });
        } else {
          this.submit();
        }
      });
    });
  </script>
<?php
}
include("../../templates/footer.php");

?>