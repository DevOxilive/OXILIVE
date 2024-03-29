<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  //inclucion de archivos requeridos
  include("../../../../templates/header.php");
  include("../../../../connection/conexion.php");
  // archivo encargado de traer los puestos.
  include("../../../../secciones/puestos/consulta.php");
  include("../../../../model/genero.php");
  include("../../../../model/estado.php");
} else {
  echo "Error en el sistema";
}
// obtencion del dato por medio get
$id_usuario = $_GET['idus'];

// busqueda del usuario para su vista previa de eleccion del usuario.
$stmt = $con->prepare("SELECT * FROM empleados WHERE id_empleado = $id_usuario;");
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $dato) {
?>
  <html>
  <main id="main" class="main">
    <section class="section dashboard">
      <div class="card card-form">
        <div class="card-header">
          <h4>Asignación de Usuario</h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
          <form action="../model/usuariosADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3">
            <div class="col-md-12">
              <br>
              <h2 class="form-title">Datos</h2>
            </div>
            <div class="contenido col-md-1">
              <label for="idus" class="form-label">ID:</label>
              <input type="text" class="form-control" name="idus" id="id" value="<?php echo $dato['id_empleado']; ?>" readonly>
            </div>
            <div class="contenido col-md-3">
              <label for="nombres" class="form-label">Nombres:</label>
              <input type="text" class="form-control" name="nombres" id="nombres" value="<?php echo $dato['nombres']; ?>" readonly>
            </div>
            <div class="contenido col-md-3">
              <label for="apellidos" class="form-label">Apellidos:</label>
              <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $dato['apellidos']; ?>" readonly>
            </div>
            <div class="contenido col-md-3">
              <label for="departamento" class="form-label">Departamento:</label>
              <select name="departamento" id="departamento" class="form-select">
                <?php

                // carga de opciones del sistema. 
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
            <div class="col-md-12">
              <hr>
              <h2 class="form-title">Acceso al Sistema</h2>
            </div>
            <div class="contenido col-md-3">
              <center>
                <label for="Foto_perfil" class="form-label">Foto de perfil:</label> <br>
                <div class="profile-picture">
                  <div class="picture-container">
                    <img src="../../../../img/usuario.png" alt="Foto de perfil" id="imagenActual" class="img-thumbnail">
                    <div class="overlay">
                      <button type="button" class="change-link" onclick="abrirSelectorArchivo(event)"><i class="fas fa-camera"></i></button>
                    </div>
                  </div>
                </div>
                <input type="file" class="form-control" name="Foto_perfil" id="Foto_perfil" onchange="cambiarImagen(event)" style="display: none;">
              </center>
            </div>
            <div class="contenido col-md-3">
              <label for="usuario" class="form-label">Usuario:</label>
              <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" maxlength="20" minlength="3">
            </div>
            <div class="contenido col-md-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="contraseña" class="" maxlength="16" minlength="8">
            </div>
            <div class="col-12">
              <hr>
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
          window.location.href = "<?php echo $url_base; ?>secciones/sistemas/usuarios/index.php";
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

    function mostrarImagen(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var imagenActual = document.getElementById("imagenActual");
          imagenActual.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function abrirSelectorArchivo(event) {
      event.preventDefault();
      var selectorArchivo = document.getElementById("Foto_perfil");
      selectorArchivo.click();
    }

    function cambiarImagen(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var imagenActual = document.getElementById("imagenActual");
          imagenActual.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function eliminarImagen(event) {
      event.preventDefault();
      var imagenActual = document.getElementById("imagenActual");
      imagenActual.src = "./img/error.png";
      var selectorArchivo = document.getElementById("Foto_perfil");
      selectorArchivo.value = null;
    }
  </script>

  </html>
<?php
}
include("../../../../templates/footer.php");

?>