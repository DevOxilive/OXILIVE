<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../../login.php');
} elseif (isset($_SESSION['us'])){
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../../../../module/genero.php");
    include("../../../../module/estado.php");
    
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">

            <!-- Encabezado del formulario de nueva asistencia-->
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center;
                        color: #fff;
                        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Registro de asistencia
                </h4>
            </div>

            <!-- Cuerpo del formulario de registro de asistencia -->
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="<?php echo $url_base ?>secciones/enfermeria/asistencia/asisADD.php" method="POST"
                    enctype="multipart/form-data" class="formLogin row g-3">
                    <center>
                    
                    <!-- Etiqueta oculta para mandar el id del usuario de la sesión que va a dar su check -->
                    <input type="hidden" id="idUser" name="idUser" value="<?php echo $_SESSION['idus']; ?>">
                    
                    <input type="hidden" id="ubicacion" name="ubicacion" value="">

                    <div class="contenido col-md-5">
                        <br>
                        <label for="fotoEnfermero" class="form-label">Fotografía</label>
                        <input type="file">
                    </div>

                    <!-- Combo box para elegir paciente -->
                    <div class="contenido col-md-4">
                        <br>
                        <label for="paciente" class="form-label">Paciente</label>
                        <select id="paciente" name="paciente" class="form-select">
                            <?php foreach ($lista_pacientes as $pacientes) { ?>
                            <option value="0">Elige un paciente</option>
                            <option value="<?php echo $pacientes['id_pacienteEnfermeria']; ?>">
                                <?php echo $pacientes['nombre']." ".$pacientes['apellidos']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    
                    <!-- Botones -->
                    <div class="col-12">
                        <br>
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                    </div>
                    </center>
                </form>
            </div>
        </div>
    </section>
</main>

</html>
<script>
//Script fecha para evitar registros previos a la fecha actual

// Obtener fecha actual
let fecha = new Date();
// Obtener cadena en formato yyyy-mm-dd, eliminando zona y hora
let fechaMin = fecha.toISOString().split('T')[0];
// Asignar valor mínimo
document.querySelector('#fechaGuardia').min = fechaMin;

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
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/guardias/index.php";
        }
    });
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.formLogin').addEventListener('submit', function(event) {
        // Evita el envío del formulario por defecto
        event.preventDefault();
        // Verifica si los campos obligatorios están vacíos
        var nombres = document.getElementById('nombres').value;
        var apellidos = document.getElementById('apellidos').value;
        var rfc = document.getElementById('rfc').value;
        var usuario = document.getElementById('usuario').value;
        var password = document.getElementById('password').value;
        var email = document.getElementById('email').value;
        if (!nombres || !apellidos || !rfc || !usuario || !password || !email) {
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
include("../../../../templates/footer.php");
?>