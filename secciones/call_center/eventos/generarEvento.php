<?php
session_start();

if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include_once '../../../connection/conexion.php';
    include("./buscarServicio.php");
} else {
    echo "Error en el sistema";
}

$pacienteData = $_GET['pacienteData'];
?>


<html>
<link rel="stylesheet" href="../../../assets/css/edit.css">
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Asignacion de evento</h4>
            </div>
            <input type="hidden" id="idPac" value="<?php echo $pacienteData;?>">
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="guardarevento.php" method="POST" class="formLogin row g-3" id="formulario">
                    <div class="contenido col-md-1">
                        <label for="idPaciente" class="formulario__label">No</label>
                        <input id="idPaciente" name="idPaciente" type="text" class="form-control" value="" readonly>
                    </div>
                    <div class="contenido col-md-5">
                        <label for="nomPaciente" class="formulario__label">Paciente:</label>
                        <input id="nomPaciente" name="nomPaciente" type="text" class="form-control" value="" readonly>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="nomSolicitante" class="formulario-label">Solicitado por:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="nomSolicitante" id="nomSolicitante"
                                placeholder="Nombre del Solicitante" value="CALL CENTER" ;>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="fechaGuardia" class="form-label">Fecha:</label>
                        <input type="date" id="fechaServicio" onkeydown="return false" name="fechaServicio"
                            class="form-select">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="horarioEntrada" class="form-label">Hora:</label>
                        <input type="time" id="horaEntrada">
                    </div>
                    <div class="contenido col-md-12">
                        <label for="motivoConsulta" class="formulario-label">Motivo de consulta:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="motivoConsulta" id="motivoConsulta"
                                placeholder="eje: caida con fractura cervical" ;>
                            <i class=" formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="nAutorizacion" class="formulario-label">No. Autorizacion:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="nAutorizacion" id="nAutorizacion"
                                placeholder="Eje: 452k01" ;>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="auEspecial" class="formulario-label">No. Autorizacion especial:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="auEspecial" id="auEspecial"
                                placeholder="Eje: MDF12421" ;>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="asignarMedico" class="formulario-label">Asignar medico</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="asignarMedico" id="asignarMedico"
                                placeholder="Eje: MDF12421" ;>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                    <div class="contenido col-md-10" id="serviciosContainer">
                        <label for="tipoServicio" class="form-label">Servicio</label>
                        <div class="input-group mb-3">
                            <select class="form-select" name="tipoServicio[]" required>
                                <option value="" selected>Selecciona un servicio</option>
                                <?php foreach ($datos_servicios as $servicio) {
                $idServicio = $servicio['idServicio'];
                $nombreServicio = $servicio['nombreServicio'];
                $descripcionServicio = $servicio['descripcionServicio'];
                echo "<option value='".$idServicio."'>".$nombreServicio." - ".$descripcionServicio."</option>";
            }
            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="code" class="text-left"></label>
                            <div class="formulario__grupo-input">
                                <button class="btn add-btn btn-info">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="newData"></div>

                    <div class="card-footer text-muted">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)"
                                role="button">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</main>

<script type="text/javascript">
$(document).ready(function() {
    var maxDivs = 10; // Cambiar el límite a 10

    $('.add-btn').click(function(e) {
        e.preventDefault();

        // Verifica si se ha alcanzado el límite
        if ($('.newData .form-row').length < maxDivs) {
            var i = $('.newData .form-row').length + 1;
            var opcionesServicios = '';
            <?php foreach ($datos_servicios as $servicio) { ?>
                opcionesServicios += '<option value="<?= $servicio["idServicio"] ?>"><?= $servicio["nombreServicio"] ?> - <?= $servicio["descripcionServicio"] ?></option>';
            <?php } ?>
            var newDiv = $("<div class='form-row' id='tipoServicio" + i + "'>" +
                "<div class='contenido col-md-10' id='serviciosContainer'>" +
                "<label for='tipoServicio' class='form-label'>Servicio</label>" +
                "<div class='input-group mb-3'>" +
                "<select class='form-select' name='tipoServicio[]' required>" +
                "<option value='' disabled selected>Selecciona un servicio</option>" +
                opcionesServicios +
               "</select>"+ 
                '</div>' +
                '</div>' +
                '<div class="input-group-append">' +
                '<a href="#" class="btn btn-info remove-lnk"  data-id="' + i +
                '"><i class="bi bi-trash-fill"></i></a>' +
                '</div>' +
                '</div>');


            $('.newData').append(newDiv);
        } else {
            alert("No se pueden agregar mas");
        }
    });

    $(document).on('click', '.remove-lnk', function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        $('#tipoServicio' + id).remove();
    });
});
</script>


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
            window.location.href = "<?php echo $url_base; ?>secciones/oxigeno/equipo/index.php";
        }
    });
}
var idPac = document.getElementById("idPac").value;
var idPaciente = document.getElementById("idPaciente");
var nomPaciente = document.getElementById("nomPaciente");

function setDatos() {
    fetch("datosPaciente.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                idPac: idPac
            })
        })
        .then(response => response.json())
        .then(datos => {
            datos.forEach((dato) => {
                console.log(dato);
                idPaciente.value = dato.id_pacientes;
                nomPaciente.value = dato.Nombres + " " + dato.Apellidos;
            });
        })
}
setDatos();
</script>



<script>
//Script fecha para evitar registros previos a la fecha actual

// Obtener fecha actual
let fecha = new Date();
// Obtener cadena en formato yyyy-mm-dd, eliminando zona y hora
let fechaMin = fecha.toISOString().split('T')[0];
// Asignar valor mínimo
document.querySelector('#fechaServicio').min = fechaMin;
</script>




<?php
include("../../../templates/footer.php");
?>