<?php
session_start();

if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include_once '../../../connection/conexion.php';
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
            <input type="hidden" id="idPac" value="<?php echo $pacienteData;?>">
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="guardarevento.php" method="POST" class="formLogin row g-3" id="formulario">
                    <div class="contenido col-md-2"><br>
                        <label for="idPaciente" class="formulario__label">Num. paciente</label>
                       
                        <input id="idPaciente" name="idPaciente" type="text" class="form-control" value="" readonly>
                    </div>
                    <div class="contenido col-md-6"><br>
                        <label for="nomPaciente" class="formulario__label">Nombre del paciente</label>
                        
                        <input id="nomPaciente" name="nomPaciente" type="text" class="form-control" value="" readonly>

                    </div>
                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__nomSolicitante">
                            <label for="nomSolicitante" class="formulario-label">Nombre del Solicitante</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="nomSolicitante" id="nomSolicitante" placeholder="Nombre del Solicitante" value="CALL CENTER" ;>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-footer text-muted">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)" role="button">Cancelar</a>

                        </div>
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
                window.location.href = "<?php echo $url_base; ?>secciones/oxigeno/equipo/index.php";
            }
        });
    }
    var idPac = document.getElementById("idPac").value;
    var idPaciente = document.getElementById("idPaciente");
    var nomPaciente = document.getElementById("nomPaciente");

    function setDatos(){
        fetch("datosPaciente.php", {
            method: "POST",
            headers: { "Content-Type" : "application/json" },
            body: JSON.stringify({idPac: idPac})
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




<?php
include("../../../templates/footer.php");
?>