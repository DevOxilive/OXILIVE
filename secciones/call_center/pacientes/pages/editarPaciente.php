<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../../../../module/genero.php");
    include("../../../../module/administradora.php");
    include("../../../../module/tipoPaciente.php");
    include("../../../../module/banco.php"); //Por modificar por la base de datos
    $idPac = $_GET['idPac'];
    $sentenciaEdit = $con->prepare('
        SELECT p.*, c.codigo_postal
        FROM pacientes_call_center p, colonias c
        WHERE id_pacientes=:idPac
        AND c.id=p.colonia;
    ');
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../../assets/css/edit.css">
    <link rel="stylesheet" href="../css/botones.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo Paciente</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF">
                <form method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                    <!-- Apartado del registro para datos generales -->
                    <div class="contenido col-md-12">
                        <br>
                        <h2>Datos Generales</h2>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="nombre" class="form-label">Nombre(s):</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el/los nombre(s)">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Ingresa los apellidos">
                    </div>
                    <div class="contenido col-md-2">
                        <label for="genero" class="form-label">Género:</label>
                        <select name="genero" id="genero" class="form-select">
                            <option value="" selected>Selecciona el género</option>
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-2"></div>
                    <div class="contenido col-md-2">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="text" maxlength="3" class="form-control" name="edad" id="edad" placeholder="Ingresa la edad">
                    </div>
                    <div class="contenido col-md-2">
                        <label for="tipoPaciente" class="form-label">Tipo de Paciente:</label>
                        <select name="tipoPaciente" id="tipoPaciente" class="form-select">
                            <option value="">Seleccione tipo de paciente</option>
                            <?php foreach ($lista_tiposPac as $tipos) { ?>
                                <option value="<?php echo $tipos['id_tipoPaciente']; ?>"><?php echo $tipos['tipoPaciente']; ?></option>
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
                        <label for="telDos" class="form-label">Teléfono 2:</label>
                        <input type="text" maxlength="10" class="form-control" name="telDos" id="telDos" placeholder="Ingresa un número de teléfono">
                        <span class="badge bg-danger border border-light rounded-circle" id="delBoton">X</span>
                        <p id="errTelDos" style="color:red; font-weight:bold;"></p>
                    </div>

                    <!-- Apartado del registro para domicilio -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2>Domicilio</h2>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="cp" class="form-label">Código Postal:</label>
                        <input type="text" maxlength="5" class="form-control" id="cp" placeholder="Ingresa un Código Postal">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="colonia" class="form-label">Colonia:</label>
                        <select name="colonia" id="colonia" class="form-select">
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="delMun" class="form-label">Delegación/Municipio:</label>
                        <select name="delMun" id="delMun" class="form-select" disabled>
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="estadoDir" class="form-label">Estado:</label>
                        <select name="estadoDir" id="estadoDir" class="form-select" disabled>
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="calle" class="form-label">Calle:</label>
                        <input type="text" class="form-control" name="calle" id="calle" placeholder="Ingresa la calle">
                    </div>
                    <div class="contenido col-md-1">
                        <label for="numExt" class="form-label">N° Ext.:</label>
                        <input type="text" maxlength="15" class="form-control" name="numExt" id="numExt" placeholder="123">
                    </div>
                    <div class="contenido col-md-1">
                        <label for="numInt" class="form-label">N° Int.:</label>
                        <input type="text" maxlength="15" class="form-control" name="numInt" id="numInt" placeholder="456">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="calleUno" class="form-label">Entre la calle:</label>
                        <input type="text" class="form-control" name="calleUno" id="calleUno" placeholder="Ingresa la primera calle">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="calleDos" class="form-label">Y la calle:</label>
                        <input type="text" class="form-control" name="calleDos" id="calleDos" placeholder="Ingresa la segunda calle">
                    </div>
                    <div class="contenido col-md-11">
                        <label for="referencias" class="form-label">Referencias:</label>
                        <input type="text" class="form-control" name="referencias" id="referencias" placeholder="Ingresa mayores referencias del domicilio">
                    </div>
                    <!-- Datos de la aseguradora -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2>Datos de la aseguradora</h2>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="administradora" class="form-label">Administradora:</label>
                        <select name="administradora" id="administradora" class="form-select">
                            <option value="" selected>Selecciona la aseguradora</option>
                            <?php foreach ($lista_administradora as $admin) { ?>
                                <option value="<?php echo $admin['id_administradora']; ?>"><?php echo $admin['Nombre_administradora']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="banco" class="form-label">Banco:</label>
                        <select name="banco" id="banco" class="form-select">
                            <option value="" selected>Selecciona el banco</option>
                            <?php foreach ($lista_bancos as $bancos) { ?>
                                <option value="<?php echo $bancos['id_bancos']; ?>"><?php echo $bancos['Nombre_banco']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="expediente" class="form-label">N° de Expediente:</label>
                        <input type="text" class="form-control" name="expediente" id="expediente" placeholder="Ingresa el N° de expediente">
                    </div>
                    <div class="contenido col-md-3"></div>
                    <div class="contenido col-md-3">
                        <label for="autorizacionGen" class="form-label">N° de Autorización General:</label>
                        <input type="text" class="form-control" name="autorizacionGen" id="autorizacionGen" placeholder="Ingresa el N° de autorización">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="autorizacionEsp" class="form-label">N° de Autorización Especial:</label>
                        <input type="text" class="form-control" name="autorizacionEsp" id="autorizacionEsp" placeholder="Ingresa el N° de autorización">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="deducible" class="form-label">Deducible:</label>
                        <input type="text" class="form-control" name="deducible" id="deducible" placeholder="Ingresa el deducible">
                    </div>
                    <!-- Botones para el formulario -->
                    <div class="col-12">
                        <br>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</main>
<script src="../js/botonAdd.js"></script>
<script src="../js/validacion.js"></script>
<script src="../js/formButtons.js"></script>
<script src="../js/domicilio.js"></script>

</html>
<?php
include("../../../../templates/footer.php");
?>