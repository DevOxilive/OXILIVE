<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("consulta.php");
    $datosGuardados = isset($_SESSION['datos_guardados']) && $_SESSION['datos_guardados'] === true;

} else {
    echo "Error en el sistema";
}
?>

<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>

<main id="main" class="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4 style="text-align:center;
            color: #ffff;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                REGISTRO CLÍNICO Y CUDADOS GENERALES
            </h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form action="#" method="POST" class="formLogin" id="formulario">
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="paciente" class="formulario__label">Nombre
                                del paciente: </label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="paciente" id="paciente"
                                    value="hilda limon cubells" readonly disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formulario__grupo">
                            <label for="servicio" class="formulario__label">Servicio</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="servicio" id="servicio"
                                    value="24 hrs" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="responsable" class="formulario__label">Familiar responsable:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="responsable" id="responsable"
                                    value="jesus sanchez" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formulario__grupo">
                            <label for="edad" class="formulario__label">Edad:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="edad" id="edad" value="72" readonly
                                    disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="medico" class="formulario__label">Nombre del Médico:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="medico" id="medico"
                                    value="marco antonio ruiz" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="formulario__grupo">
                            <label for="diagnostico" class="formulario__label">Diagnóstico del Médico:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="diagnostico" id="diagnostico"
                                    value="EPOC-LX DE LUMBARES-TIROIDES-REFLUJO" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formulario__grupo">
                            <label for="peso" class="formulario__label">Peso:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="peso" id="peso" value="50 kg"
                                    readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="peso" class="formulario__label">Nombre del enfermero:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="enfermero" id="enferemro"
                                    value="vannesa perez diaz" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        <br>
        <!-- Tu botón en HTML -->
        <button id="btnSiguiente" class="btn btn-primary">Iniciar Registro</button>

         <?php if ($datosGuardados) { ?>
        <button type="button" class="btn btn-outline-success" id="generar-pdf-btn"  data-id="<?php echo $btnId; ?>">
            <span class="bi bi-file-earmark-pdf-fill"></span> Generar Registro
        </button>
        <?php } ?>
            
        
        
    </form>
    </div>
    </div>
</main>



<script>
var btnSiguiente = document.getElementById('btnSiguiente');
btnSiguiente.addEventListener('click', function() {
    window.location.href = 'form1.php';
});
</script>
<script type="text/javascript">
    // Obtener el botón por su ID
    var botonGenerarPDF = document.getElementById("generar-pdf-btn");
    // Obtener el ID real del registro desde el atributo data
    var btnId = botonGenerarPDF.getAttribute("data-id");

    // Agregar un manejador de eventos al botón
    botonGenerarPDF.addEventListener("click", function() {
        // Realizar la redirección con el ID real del registro
        var xhr = new XMLHttpRequest();
        var url = "consulta.php?btnId=" + btnId;
        xhr.open("GET", url, true);

        xhr.onload = function() {
            // Verificar que la solicitud AJAX se haya completado correctamente
            if (xhr.status === 200) {
                // Realizar la redirección después de que la solicitud AJAX esté completa
                window.location.href = "registro_pdf.php?btnId=" + btnId;
            }
        };

        xhr.send();
    });
</script>




<?php
include("../../../templates/footer.php");
?>