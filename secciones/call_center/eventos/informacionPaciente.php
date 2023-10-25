<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../eventos/consultaPacientes.php");
   
} else {
    echo "Error en el sistema";
}
$idUrl = $_GET['idPac'];
?>

<!-- Contenido HTML para mostrar los datos del paciente -->
<main class="main" id="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #dcdede; background: #005880;">
            <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                Datos del paciente</h4>
            <div class="card">
                <?php foreach ($datos_paciente as $paciente) { ?>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">ID PACIENTE: <?php echo $paciente['id_pacientes']; ?>
                                </h5>
                                <h5 class="card-title">Nombre completo:
                                    <?php echo $paciente['nombres'] . ' ' . $paciente['apellidos']; ?></h5>
                                <h5 class="card-title">Género: <?php echo $paciente['genero']; ?></h5>
                                <h5 class="card-title">Edad: <?php echo $paciente['edad']; ?></h5>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <br>
                                <br>
                            <h5 class="card-title">Domicilio:
                                    <?php echo $paciente['calle'] . ' ' . $paciente['num_int'] . ' ' . $paciente['num_ext'] . ' ' . $paciente['nombre_colonia'] . ' ' . $paciente['codigo_postal'] . ' ' . $paciente['nombre_municipio'] . ' ' . $paciente['nombre_estado'] . ' ' . $paciente['nombre_municipio']; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a role="button" href="generarEvento.php?pacienteData=<?php echo urlencode($pacienteDataJSON); ?>" id="generarServicioBtn" class="btn btn-outline-primary">
                                Generar servicio
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

</main>

<script>
    document.getElementById("generarServicioBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace

        Swal.fire({
            title: '¿Estás seguro de continuar?',
            text: '-_- ya revisaste los datos del paciente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href =
                    '<?php echo $url_base; ?>secciones/call_center/eventos/generarEvento.php?pacienteData=<?php echo $idUrl; ?>';
            } else {
                // Si el usuario cancela, permanece en la página actual
                // No es necesario hacer nada aquí, ya que el comportamiento predeterminado es quedarse en la página actual
            }
        });
    });
</script>





<?php
include("../../../templates/footer.php");
?>