<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../enfermeria/registroYcuidados/model/consultaDatos.php");


    $datosGuardados = isset($_SESSION['datos_guardados']) && $_SESSION['datos_guardados'] === true;
} else {
    echo "Error en el sistema";
}
?>

<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">



<main id="main" class="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4 style="text-align:center;
            color: #ffff;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                REGISTRO CLÍNICO Y CUIDADOS GENERALES
            </h4>
        </div>
        <?php foreach ($resultado as $asignacion) { ?>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form class="formLogin form-inline" id="formulario">
                <div class="row">
                    <div class="col-md-2 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="numeroAsignacion" class="formulario__label">N. asignacion:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="numeroAsignacion"
                                    id="numeroAsignacion" value="<?php echo $asignacion['id_asignacionHorarios']; ?>"
                                    readonly disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="paciente" class="formulario__label">Nombre
                                del paciente: </label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="paciente" id="paciente"
                                    value="<?php echo $asignacion['nombre del paciente'] ?>" readonly disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formulario__grupo">
                            <label for="servicio" class="formulario__label">Servicio</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="servicio" id="servicio"
                                    value="<?php echo $asignacion['nombreServicio']; ?>" readonly disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="responsable" class="formulario__label">Familiar responsable:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="responsable" id="responsable"
                                    value="<?php echo $asignacion['responsable']; ?>" readonly disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formulario__grupo">
                            <label for="edad" class="formulario__label">Edad del paciente:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="edad" id="edad"
                                    value="<?php echo $asignacion['edad']; ?>" readonly disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="medico" class="formulario__label">Nombre del Médico:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="medico" id="medico"
                                    value="<?php echo $asignacion['nombre del medico']; ?>" readonly disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="peso" class="formulario__label">Nombre del enfermero:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="enfermero" id="enfermero"
                                    value="<?php echo $asignacion['nombre del enfermero']; ?>" readonly disabled>
                            </div>
                        </div>
            </form>
        </div>
        <?php } ?>
    </div>
    <br>
    <!-- Tu botón en HTML -->
    <button id="btnSiguiente" class="btn btn-primary" type="submit" form="formulario">Iniciar Registro</button>
    <?php if ($datosGuardados) { ?>
    <button type="button" class="btn btn-outline-success" id="generar-pdf-btn" data-id="<?php echo $idReg; ?>">
        <span class="bi bi-file-earmark-pdf-fill"></span> Generar Registro
    </button>
    <?php } ?>
    </form>
    </div>
    </div>
</main>
</html>
<script type="text/javascript">
// Obtener el botón por su ID
var botonGenerarPDF = document.getElementById("generar-pdf-btn");
// Obtener el ID real del registro desde el atributo data
var datosGuardados = botonGenerarPDF.getAttribute("data-id");

// Agregar un manejador de eventos al botón
botonGenerarPDF.addEventListener("click", function() {
    // Realizar la redirección con el ID real del registro
    var xhr = new XMLHttpRequest();
    var url = "consulta.php?btnId=" + datosGuardados;
    xhr.open("GET", url, true);

    xhr.onload = function() {
        // Verificar que la solicitud AJAX se haya completado correctamente
        if (xhr.status === 200) {
            // Realizar la redirección después de que la solicitud AJAX esté completa
            window.location.href = "registro_pdf.php?btnId=" + datosGuardados;
        }
    };

    xhr.send();
});
</script>
<script src="js/valiform.js"></script>



<?php
include("../../../templates/footer.php");
?>