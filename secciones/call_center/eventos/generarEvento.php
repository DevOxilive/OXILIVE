<?php
session_start();

if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include_once '../../../connection/conexion.php';
    include("./buscarServicio.php");
    include("./buscarMedicos.php");
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
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Asignacion de evento</h4>
            </div>
            <input type="hidden" id="idPac" value="<?php echo $pacienteData; ?>">
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="guardarevento.php" method="POST" class="formLogin row g-3" id="formulario">
                    <div class="contenido col-md-1">
                        <br>
                        <label for="idPaciente" class="form-label">No</label>
                        <input id="idPaciente" name="idPaciente" type="text" class="form-control" value="" readonly>
                    </div>
                    <div class="contenido col-md-5">
                        <br>
                        <label for="nomPaciente" class="form-label">Paciente:</label>
                        <input id="nomPaciente" name="nomPaciente" type="text" class="form-control" value="" readonly>
                    </div>
                    <div class="contenido col-md-3">
                        <br>
                        <label for="nomSolicitante" class="form-label">Solicitado por:</label>
                        <input type="text" class="form-control" name="nomSolicitante" id="nomSolicitante" placeholder="Nombre del Solicitante" value="CALL CENTER" ;>
                        <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="contenido col-md-3"></div>
                    <div class="contenido col-md-3">
                        <label for="fechaServicio" class="form-label">Fecha:</label>
                        <input type="date" id="fechaServicio" onkeydown="return false" name="fechaServicio" class="form-select" required>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="horaEntrada" class="form-label">Hora:</label>
                        <input type="time" id="horaEntrada" name="horaEntrada" required>
                    </div>
                    <div class="contenido col-md-11">
                        <label for="motivoConsulta" class="form-label">Motivo de consulta:</label>
                        <input type="text" class="form-control" name="motivoConsulta" id="motivoConsulta" placeholder="Ejemplo: caída con fractura cervical" required>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="nAutorizacion" class="form-label">No. Autorizacion:</label>
                        <input type="text" class="form-control" name="nAutorizacion" id="nAutorizacion" placeholder="Eje: 452k01" required>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="auEspecial" class="form-label">No. Autorizacion especial:</label>
                        <input type="text" class="formulario__input" name="auEspecial" id="auEspecial" placeholder="Eje: MDF12421" required>
                    </div>
                    <div class="contenido col-md-5">
                        <label for="asignarMedico" class="form-label">Asignar medico</label>
                        <select class="form-select" name="asignarMedico" id="asignarMedico">
                            <option value="" selected>Selecciona un medico</option>
                            <?php foreach ($datos_medicos as $medicos) {
                                $id_usuarios = $medicos['id_usuarios'];
                                $Nombres = $medicos['Nombres'];
                                $Apellidos = $medicos['Apellidos'];
                                echo "<option value='" . $id_usuarios . "'>" . $Nombres . "   " . $Apellidos . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="contenido col-md-10" id="serviciosContainer">
                        <label for="tipoServicio" class="form-label">Servicio</label>
                        <select id="tipoServicio" name="tipoServicio[]" class="form-select">
                            <option value="" selected>Selecciona un servicio</option>
                            <?php foreach ($datos_servicios as $servicio) {
                                $idServicio = $servicio['idServicio'];
                                $nombreServicio = $servicio['nombreServicio'];
                                $descripcionServicio = $servicio['descripcionServicio'];
                                echo "<option id='opciones' value='" . $idServicio . "'>" . $nombreServicio . " - " . $descripcionServicio . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 align-self-center" style="padding-top:1.8rem;">
                        <button class="btn btn-info" role="button" id="add-btn">
                            <i class="bi bi-plus-lg text-white"></i>
                        </button>
                    </div>
                    <div class="card-footer text-muted" id="btns-form">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)" role="button">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</main>

<script type="text/javascript">
    $(document).ready(function() {
        var maxDivs = 10;

        $('#add-btn').prop('disabled', true);
        // Deshabilita el botón de agregar al cargar la página

        var select = document.querySelector('#tipoServicio');
        select.addEventListener("change", function() {
            console.log(select.value);
            if (select.value !== "") {
                $('#add-btn').prop('disabled', false);
            } else {
                $('#add-btn').prop('disabled', true);
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
                btn.setAttribute("id", ("del"+i));
                btn.setAttribute("style", "padding-top:1.8rem;");

                //Se declaran variables de elementos que irán dentro de los divs
                var select = "<label for='tipoServicio' class='form-label'>Servicio " + i + "</label>" +
                    "<select class='form-select' name='tipoServicio' required>" +
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
                window.location.replace("<?php echo $url_base; ?>secciones/call_center/eventos/index.php");
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
                    nomPaciente.value = dato.nombres + " " + dato.apellidos;
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