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
    include("../../../../module/banco.php"); //Ya quedo..:3
    $idPac = $_GET['idPac'];
    $sentenciaEdit = $con->prepare('
    SELECT p.*, c.codigo_postal, ad.Nombre_administradora
    FROM pacientes_call_center p, colonias c, administradora ad, bancos b
         WHERE id_pacientes=:idPac
         AND c.id=p.colonia
           AND p.bancosAdmi = b.id_bancos
           AND b.admi = ad.id_administradora;
    ');
    $sentenciaEdit->bindParam(':idPac', $idPac);
    $sentenciaEdit->execute();
    $datosPaciente = $sentenciaEdit->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../../assets/css/edit.css">
    <link rel="stylesheet" href="../css/btn2.css">
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
                    <?php foreach ($datosPaciente as $pac) { ?>
                        <!-- Apartado del registro para datos generales -->
                        <div class="contenido col-md-12">
                            <br>
                            <h2>Datos Generales</h2>
                        </div>
                        <div class="contenido col-md-4">
                            <label for="nombre" class="form-label">Nombre(s):</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el/los nombre(s)" value="<?php echo $pac['nombres']; ?>">
                        </div>
                        <div class="contenido col-md-4">
                            <label for="apellidos" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Ingresa los apellidos" value="<?php echo $pac['apellidos']; ?>">
                        </div>
                        <div class="contenido col-md-3">
                            <label for="genero" class="form-label">Género:</label>
                            <select name="genero" id="genero" class="form-select">
                                <option value="" selected>Selecciona el género</option>
                                <?php foreach ($lista_genero as $genero) { ?>
                                    <option value="<?php echo $genero['id_genero']; ?>" <?php echo ($pac['genero'] == $genero['id_genero'] ? 'selected' : ''); ?>><?php echo $genero['genero']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="contenido col-md-2">
                            <label for="edad" class="form-label">Edad:</label>
                            <input type="text" maxlength="3" class="form-control" name="edad" id="edad" placeholder="Ingresa la edad" value="<?php echo $pac['edad']; ?>">
                        </div>
                        <div class="contenido col-md-3">
                            <label for="tipoPaciente" class="form-label">Tipo de Paciente:</label>
                            <select name="tipoPaciente" id="tipoPaciente" class="form-select">
                                <option value="">Seleccione tipo de paciente</option>
                                <?php foreach ($lista_tiposPac as $tipos) { ?>
                                    <option value="<?php echo $tipos['id_tipoPaciente']; ?>" <?php echo ($tipos['id_tipoPaciente'] == $pac['tipoPaciente'] ? 'selected' : ''); ?>><?php echo $tipos['tipoPaciente']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="contenido col-md-3">
                            <label for="telUno" class="form-label">Teléfono:</label>
                            <input type="text" maxlength="10" class="form-control" name="telUno" id="telUno" placeholder="Ingresa un número de teléfono" value="<?php echo $pac['telefono']; ?>">
                            <p id="errTelUno" style="color:red; font-weight:bold;"></p>
                        </div>

                        <div class="contenido col-md-1" <?php echo ($pac['telefonoDos'] != '' ? 'style="display: none;"' : 'style="display: flex;"'); ?> id="add">
                            <span class="badge bg-primary fs-4" id="addBoton">+</span>
                        </div>

                        <div class="contenido col-md-3" <?php echo ($pac['telefonoDos'] != '' ? 'style="display: block;"' : 'style="display: none;"'); ?> id="tel">
                            <label for="telDos" class="form-label">Teléfono 2:</label>
                            <input type="text" maxlength="10" class="form-control" name="telDos" id="telDos" placeholder="Ingresa un número de teléfono" value="<?php echo $pac['telefonoDos']; ?>">    
                            <span class="badge bg-danger border border-light rounded-circle" id="delBoton">X</span>
                            <p id="errTelDos" style="color:red; font-weight:bold;"></p>
                        </div>
                        <!-- Apartado del registro para domicilio -->
                        <div class="contenido col-md-12">
                            <hr>
                            <h2>Domicilio</h2>
                        </div>
                        <div class="contenido col-md-6">
                            <label for="calle" class="form-label">Calle:</label>
                            <input type="text" class="form-control" name="calle" id="calle" placeholder="Ingresa la calle" value="<?php echo $pac['calle']; ?>">
                        </div>
                        <div class="contenido col-md-2">
                            <label for="numExt" class="form-label">N° Ext.:</label>
                            <input type="text" maxlength="15" class="form-control" name="numExt" id="numExt" placeholder="123" value="<?php echo $pac['num_ext']; ?>">
                        </div>
                        <div class="contenido col-md-2">
                            <label for="numInt" class="form-label">N° Int.:</label>
                            <input type="text" maxlength="15" class="form-control" name="numInt" id="numInt" placeholder="456" value="<?php echo $pac['num_int']; ?>">
                        </div>
                        <div class="contenido col-md-3">
                            <label for="cp" class="form-label">Código Postal:</label>
                            <input type="text" maxlength="5" class="form-control" id="cp" placeholder="Ingresa un Código Postal" value="<?php echo $pac['codigo_postal']; ?>">
                        </div>
                        <input type="hidden" id="col" value="<?php echo $pac['colonia']; ?>">
                        <div class="contenido col-md-4">
                            <label for="colonia" class="form-label">Colonia:</label>
                            <select name="colonia" id="colonia" class="form-select">
                                <option value="">Selecciona un Código Postal</option>
                            </select>
                        </div>
                        <div class="contenido col-md-4">
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
                        <div class="contenido col-md-4">
                            <label for="calleUno" class="form-label">Entre la calle:</label>
                            <input type="text" class="form-control" name="calleUno" id="calleUno" placeholder="Ingresa la primera calle" value="<?php echo $pac['calleUno']; ?>">
                        </div>
                        <div class="contenido col-md-4">
                            <label for="calleDos" class="form-label">Y la calle:</label>
                            <input type="text" class="form-control" name="calleDos" id="calleDos" placeholder="Ingresa la segunda calle" value="<?php echo $pac['calleDos']; ?>">
                        </div>
                        <div class="contenido col-md-11">
                            <label for="referencias" class="form-label">Referencias:</label>
                            <input type="text" class="form-control" name="referencias" id="referencias" placeholder="Ingresa mayores referencias del domicilio" value="<?php echo $pac['referencias']; ?>">
                        </div>

                        <!-- Datos de la aseguradora -->
                        <div class="contenido col-md-5">
                        <label for="banco" class="form-label">Banco:</label>
                        <select name="banco" id="banco" class="form-select">
                            <?php foreach ($lista_bancos as $registro) { ?>
                            <option <?php echo ($pac['bancosAdmi'] == $registro['id_bancos']) ? "selected" : ""; ?>
                                value="<?php echo $registro['id_bancos']; ?>">
                                <?php echo $registro['Nombre_banco']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="administradora" class="form-label">Administradora</label>
                        <input type="text" disabled value="<?php echo $pac['Nombre_administradora']?>" id="administradora" name="administradora" class="form-control" 				placeholder="Eliga el banco" readonly>
                    </div>
                        <div class="contenido col-md-3">
                            <label for="expediente" class="form-label">N° de Expediente:</label>
                            <input type="text" value="<?php echo $pac['no_expediente'] ?>" class="form-control" name="expediente" id="expediente"
                                placeholder="Ingresa el N° de expediente">
                        </div>

                        <div class="contenido col-md-4" style="display: none;">
                            <label for="autorizacionGen" class="form-label">N° de Autorización General:</label>
                            <input type="text" class="form-control" name="autorizacionGen" id="autorizacionGen" placeholder="Ingresa el N° de autorización">
                        </div>
                        <div class="contenido col-md-4" style="display: none;">
                            <label for="autorizacionEsp" class="form-label">N° de Autorización Especial:</label>
                            <input type="text" class="form-control" name="autorizacionEsp" id="autorizacionEsp" placeholder="Ingresa el N° de autorización">
                        </div>
                       
                        
                        <!-- Botones para el formulario -->
                        <div class="col-12">
                            <br>
                            <a role="button" href="#" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                        </div>
                        <input type="hidden" id="idPac" value="<?php echo $pac['id_pacientes']; ?>">
                    <?php } ?>
                </form>
            </div>
        </div>
    </section>
</main>
<script>
    var colonia = document.getElementById("colonia");
    var delMun = document.getElementById("delMun");
    var estadoDir = document.getElementById("estadoDir");
    var col = document.getElementById('col').value;
    domEdit(col);

    function domEdit(col) {
        fetch('../model/domColonia.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    col: col
                })
            })
            .then(response => response.json())
            .then(datos => {
                datos.forEach(dato => {
                    colonia.innerHTML +=
                        "<option value='" + dato.id + "' selected >" +
                        dato.nombre +
                        "</option>";
                    delMun.innerHTML =
                        "<option value=''>" +
                        dato.munName +
                        "</option>";
                    estadoDir.innerHTML =
                        "<option value=''>" +
                        dato.estName +
                        "</option>";
                });
            })
    }
</script>
<script>
const bancos = document.querySelector('#banco');
const administradoraInput = document.querySelector('#administradora');
bancos.addEventListener('change', () => {
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
<script src="../js/botonTel.js"></script>
<script src="../js/validacionEditar.js"></script>
<script src="../js/formButtons.js"></script>
<script src="../js/domicilio.js"></script>

</html>
<?php
include("../../../../templates/footer.php");
?>