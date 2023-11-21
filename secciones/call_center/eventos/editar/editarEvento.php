<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("./model/consultarServicio.php");
    include("./model/buscarmedico.php");
    include("./model/buscarServicios.php");

    

} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <link rel="stylesheet" href="../../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../../assets/css/edit.css">

</head>

<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos nuevo servicio</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF">
                <form method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                    <?php foreach ($datosServicio as $serv) { 
          ?>
                    <!-- Apartado del registro para datos generales -->
                    <div class="contenido col-md-12">
                        <br>
                        <h2>Datos del Servicio</h2>
                    </div>
                    <div class="contenido col-md-1">
                        <label for="num_paciente" class="form-label">No:</label>
                        <input type="text" class="form-control" name="num_paciente" id="num_paciente" placeholder=""
                            value="<?php echo $serv['num_paciente']; ?>" readonly>
                    </div>
                    <div class="contenido col-md-5">
                        <label for="nombreCompleto" class="form-label">Paciente:</label>
                        <input type="text" class="form-control" name="nombreCompleto" id="nombreCompleto" placeholder=""
                            value="<?php echo $serv['nombreCompleto']; ?>" readonly>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="nom_solicitante" class="form-label">Solicitado por:</label>
                        <input type="text" class="form-control" name="nom_solicitante" id="nom_solicitante"
                            placeholder="" value="<?php echo $serv['nom_solicitante']; ?>" readonly>
                    </div>
                    <div class="contenido col-md-3"></div>
                    <div class="contenido col-md-3">
                        <label for="fechaServicio" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" name="fechaServicio" id="fechaServicio"
                            onkeydown="return false" value="<?php echo $serv['fecha']; ?>">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="horaEntrada" class="form-label">Horario:</label>
                        <input type="time" class="form-control" name="horaEntrada" id="horaEntrada"
                            value="<?php echo $serv['hora']; ?>">
                    </div>
                    <div class="contenido col-md-11">
                        <label for="motivoConsulta" class="form-label">Motivo de consulta:</label>
                        <input type="text" class="form-control" name="motivoConsulta" id="motivoConsulta"
                            value="<?php echo $serv['moti_consulta']; ?>">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="nAutorizacion" class="form-label">No. Autorizacion:</label>
                        <input type="text" class="form-control" name="nAutorizacion" id="nAutorizacion"
                            value="<?php echo $serv['numAutorizacion']; ?>">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="auEspecial" class="form-label">No. Autorizacion especial:</label>
                        <input type="text" class="form-control" name="auEspecial" id="auEspecial"
                            value="<?php echo $serv['num_autorizacionEspecial']; ?>">
                    </div>
                    <div class="contenido col-md-5">
                        <label for="asignarMedico" class="form-label">Medicos:</label>
                        <select name="asignarMedico" id="asignarMedico" class="form-select">
                            <option value="" selected>Selecciona un medico</option>
                            <?php foreach ($datos_medicos as $medicos) { ?>
                            <option value="<?php echo $medicos['id_usuarios']; ?>"
                                <?php echo ($serv['num_medico'] == $medicos['id_usuarios'] ? 'selected' : ''); ?>>
                                <?php echo $medicos['Nombres']. " " .$medicos['Apellidos']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-10">
                        <label for="tipoServicio" class="form-label">Servicios:</label>
                        <select name="tipoServicio" id="tipoServicio[]" class="form-select">
                            <option value="" selected>Selecciona un servicio</option>
                            <?php foreach ($datos_servicios as $servicios) { ?>
                            <option value="<?php echo $servicios['idServicio']; ?>"
                                <?php echo ($serv['num_servicio'] == $servicios['idServicio'] ? 'selected' : ''); ?>>
                                <?php echo $servicios['nombreServicio']. " " .$servicios['descripcionServicio']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Botones para el formulario -->
                    <div class="col-md-2 align-self-center" style="padding-top:1.8rem;">
                        <button class="btn btn-info" role="button" id="add-btn">
                            <i class="bi bi-plus-lg text-white"></i>
                        </button>
                    </div>

                    <div class="col-12" id="btns-form">
                        <br>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                    </div>
                    <input type="hidden" id="id_sv" value="<?php echo $serv['id_sv']; ?>">
                    <?php 
                  } ?>
                </form>
            </div>
        </div>
    </section>

</main>

<script type="text/javascript">
$(document).ready(function() {
    var maxDivs = 10;
    //desabilita el boton de agregar al cargar la pagina
    $('#add-btn').prop('disabled', false);
    //Escucha el evento de cambio en el campo de seccion tipoServicio
    $('#tipoServicio').on('change', function() {
        //Obtiene el valor del primer elemento del arreglo tipoServicio
        var selectedValue = $('#tipoServicio').val()[0];


        // Verifica si se ha selecionado un valor valido
        if (selectedValue !== "") {
            //Habilita el boton agregar
            $('#add-btn').prop('disabled', true);

        } else {

            $('#add-btn').prop('disabled', false);
        }


    });
    var newData = 1;
    $('#add-btn').click(function(e) {
        e.preventDefault();

        // Verifica si se ha alcanzado el límite
        if (newData < maxDivs) {
            var i = newData + 1;
            var opcionesServicios = '';
            <?php foreach ($datos_servicios as $servicio) { ?>
            opcionesServicios +=
                '<option value="<?= $servicio["idServicio"] ?>"><?= $servicio["nombreServicio"] ?> - <?= $servicio["descripcionServicio"] ?></option>';
            <?php } ?>
            //Se definen los nuevos elementos que se aagregarán al DOM
            const newDiv = document.createElement("div");
            const btn = document.createElement("div");
            // Se asignan clases y atributos para los div de Servicio
            newDiv.classList.add("newData", "contenido", "col-md-10");
            newDiv.setAttribute("id", ("tipoServicio" + i));

            //Se asignan clases y atributos para los botones
            btn.classList.add("col-md-2", "align-self-center");
            btn.setAttribute("id", ("del" + i));
            btn.setAttribute("style", "padding-top:1.8rem;");

            //Se declaran variables de elementos que irán dentro de los divs
            var select = "<label for='tipoServicio' class='form-label'>Servicio " + i + "</label>" +
                "<select class='form-select' name='tipoServicio[]' required>" +
                "<option value='' selected>Selecciona un servicio</option>" +
                opcionesServicios +
                "</select>";
            var btnDel = '<a class="btn btn-info remove-lnk"' +
                ' role="button"><i class="bi bi-trash-fill text-white"></i></a>';

            //Se asignan cada conjunto de elementos al div corresponiente
            newDiv.innerHTML = select;
            btn.innerHTML = btnDel;

            //Se crean los apuntadores al DOM
            var form = document.getElementById("formulario");
            var btns = document.getElementById("btns-form");

            //Se insertan los divs indicando que van siempre antes del apuntador
            //btns-form y van dentro del apuntador formulario.
            form.insertBefore(newDiv, btns);
            form.insertBefore(btn, btns);

            // Habilita el botón de agregar después de agregar un nuevo campo
            $('.add-btn').prop('disabled', false);
            newData++;
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'No puedes agregar más servicios',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });

    $(document).on('click', '.remove-lnk', function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        $('#tipoServicio' + newData).remove();
        $("#del" + newData).remove();
        newData--;
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
            window.location.replace(
                "<?php echo $url_base; ?>secciones/call_center/eventos/cancelar/cancelar.php");
        }
    });
}
</script>
<script src="./js/validacion.js"></script>


</html>
<?php
include("../../../../templates/footer.php");
?>