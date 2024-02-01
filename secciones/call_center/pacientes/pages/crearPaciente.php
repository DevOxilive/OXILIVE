<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../../../../model/genero.php");
    include("../../../../model/administradora.php");
    include("../../../../model/tipoPaciente.php");
    include("../../../../model/banco.php"); //Listo ya quedo..:3
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../../assets/css/edit.css">
    <link rel="stylesheet" href="../css/btn.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Registro de Nuevo Paciente</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF">
                <form method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario" novalidate>
                    <!-- Apartado del registro para datos generales -->
                    <div class="contenido col-md-12">
                        <br>
                        <h2 class="form-title">Datos Generales</h2>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="nombre" class="form-label">Nombre(s):</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el/los nombre(s)" maxlength="50">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Ingresa los apellidos" maxlength="50">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="genero" class="form-label">Género:</label>
                        <select name="genero" id="genero" class="form-select">
                            <option value="" selected>Selecciona el género</option>
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="text" maxlength="3" class="form-control" name="edad" id="edad" placeholder="Ingresa la edad">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="tipoPaciente" class="form-label">Tipo de Paciente:</label>
                        <select name="tipoPaciente" id="tipoPaciente" class="form-select">
                            <option value="">Seleccione tipo de paciente</option>
                            <?php foreach ($lista_tiposPac as $tipos) { ?>
                                <option value="<?php echo $tipos['id_tipoPaciente']; ?>">
                                    <?php echo $tipos['tipoPaciente']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="telUno" class="form-label">Teléfono:</label>
                        <input type="text" maxlength="10" class="form-control" name="telUno" id="telUno" placeholder="Ingresa un número de teléfono">
                        <p id="errTelUno" style="color:red; font-weight:bold;"></p>
                    </div>
                    <div class="contenido col-md-1" style="display: flex;" id="add">
                        <span class="badge bg-primary fs-4" id="addBoton">+</span>
                    </div>
                    <div class="contenido col-md-3" style="display: none;" id="tel">
                        <div class="d-flex flex-column align-items-center">
                            <label for="telDos" class="form-label">Teléfono 2:</label>
                            <input type="text" maxlength="10" class="form-control" name="telDos" id="telDos" placeholder="Ingresa un número de teléfono">
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="badge bg-danger border border-light rounded-circle mt-2" id="delBoton">X</span>
                            </div>
                            <p id="errTelDos" class="mt-2" style="color:red; font-weight:bold;"></p>
                        </div>
                    </div>

                    <!-- Apartado de Domicilio -->
                    <?php include("../../../../templates/apartadoDom.php");?>
                    
                    <!-- Datos de la aseguradora -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 class="form-title">Datos de la administradora</h2>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="banco" class="form-label">Banco:</label>
                        <select name="banco" id="banco" class="form-select">
                            <option value="" selected>Selecciona el banco</option>
                            <?php foreach ($lista_bancos as $bancos) { ?>
                                <option value="<?php echo $bancos['id_bancos']; ?>"><?php echo $bancos['Nombre_banco']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="administradora" class="form-label">Administradora</label>
                        <input disabled type="text" id="administradora" name="administradora" class="form-control" placeholder="Eliga el banco" readonly>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="expediente" class="form-label">N° de Expediente:</label>
                        <input type="text" class="form-control" name="expediente" id="expediente" placeholder="Ingresa el N° de expediente">
                    </div>

                    <!-- Botones para el formulario -->
                    <div class="col-12">
                        <br>
                        <a role="button" href="#" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-outline-primary">Registrar</button>
                    </div>
                    <input type="hidden" id="idPac" value="0">
                </form>

            </div>
        </div>
    </section>
</main>
<script>
    const banco = document.querySelector('#banco');
    const administradoraInput = document.querySelector('#administradora');
    banco.addEventListener('change', () => {
        const selectedOption = banco.options[banco.selectedIndex];
        const bancoId = selectedOption.value;
        const op = new XMLHttpRequest();
        op.open('GET', `../model/consultaAdmi.php?banco_id=${bancoId}`, true);
        //Mi prueba de manejo de respuesta
        op.onload = () => {
            if (op.status === 200) {
                const data = JSON.parse(op.responseText);
                administradoraInput.value = data.Nombre_administradora;
            } else {
                console.error('Error al obtener la administradora..:( ', op.statusText);
            }
        };
        //Errores de conexion
        op.onerror = () => {
            console.error('Error de conexion al servidor..:(');
        }
        op.send();
    });
</script>
<script src="../../../../js/validacionEnvio.js"></script>
<script src="../js/botonTel.js"></script>
<script src="../js/validacion.js"></script>
<script src="../js/formButtons.js"></script>
<script src="../../../../js/domicilio.js"></script>
<!-- <script src="../js/tableClick.js"></script> -->

</html>
<?php
include("../../../../templates/footer.php");
?>