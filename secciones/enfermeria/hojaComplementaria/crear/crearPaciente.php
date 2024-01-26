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
    <link rel="stylesheet" href="../css/nomina.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo Paciente</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF">
                <form action="../model/nuevoPaciente.php" method="POST" enctype="multipart/form-data"
                    class="formLogin row g-3" id="formulario">
                    <!-- Apartado del registro para datos generales -->
                    <div class="contenido col-md-12">
                        <br>
                        <h2 style="text-align: center;">Información del Paciente</h2>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="nombre" class="form-label">Nombre(s):</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"
                            placeholder="Ingresa el/los nombre(s)" maxlength="50">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos"
                            placeholder="Ingresa los apellidos" maxlength="50">
                    </div>

                    <!--Implemente lo que es rfc-->
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__rfc">
                            <label for="rfc" class="form-label">RFC</label>
                            <div class="formulario__grupo-input">
                                <input type="text" maxlength="13" class="form-control" name="rfc" id="rfc"
                                    placeholder="Ejem: EJEM123456">
                            </div>
                        </div>
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
                        <input type="text" maxlength="3" class="form-control" name="edad" id="edad"
                            placeholder="Ingresa la edad">
                    </div>
                    <div class="contenido col-md-3 ">
                        <label for="telUno" class="form-label">Teléfono:</label>
                        <input type="text" maxlength="10" class="form-control" name="telUno" id="telUno"
                            placeholder="Ingresa un número de teléfono">
                        <p id="errTelUno" style="color:red; font-weight:bold;"></p>
                    </div>
                    <div class="contenido col-md-2 d-flex align-items-center cursor-pointer" style="display: flex;"
                        id="add">
                        <span class="badge bg-primary fs-4 cursor-pointer" id="addBoton">+</span>
                    </div>
                    <div class="contenido col-md-3" style="display: none;" id="tel">
                        <label for="telDos" class="form-label">Teléfono 2:</label>
                        <div class="input-group">
                            <input type="text" maxlength="10" class="form-control" name="telDos" id="telDos"
                                placeholder="Ingresa un número de teléfono">
                            <div class="input-group-append">
                                <a href="#" class="btn btn-info remove-lnk d-flex align-items-center" id="delBoton"
                                    style="border-radius: 1px; height: 100%;">
                                    <i class="fas fa-trash-alt justify-content-center"></i>
                                </a>
                            </div>
                        </div>
                        <p id="errTelDos" style="color: red; font-weight: bold;"></p>
                    </div>
                    <!--TIPO DE PACIENTE SE FUE-->
                    <!-- Apartado del registro para domicilio -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 style="text-align:center">Domicio Actual</h2>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="calle" class="form-label">Calle:</label>
                        <input type="text" maxlength="99" class="form-control" name="calle" id="calle" placeholder="Ingresa la calle">
                    </div>
                    <div class="contenido col-md-2">
                        <label for="numExt" class="form-label">Nún.Ext</label>
                        <input type="text" maxlength="6" class="form-control" name="numExt" id="numExt"
                            placeholder="123">
                    </div>
                    <div class="contenido col-md-2">
                        <label for="numInt" class="form-label">Núm.Int</label>
                        <input type="text" maxlength="6" class="form-control" name="numInt" id="numInt"
                            placeholder="456">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="cp" class="form-label">Código Postal:</label>
                        <input type="text" class="form-control" id="cp"
                            placeholder="Ingresa un Código Postal">
                    </div>
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
                    <div class="contenido col-md-4">
                        <label for="estadoDir" class="form-label">Estado:</label>
                        <select name="estadoDir" id="estadoDir" class="form-select" disabled>
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-11">
                        <label for="referencias" class="form-label">Referencias:</label>
                        <input type="text" class="form-control" name="referencias" id="referencias"
                            placeholder="Ingresa mayores referencias del domicilio" maxlength="249">
                    </div>
                    <!-- Datos de la aseguradora -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 style="text-align:center">Datos de la administradora</h2>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="banco" class="form-label">Banco:</label>
                        <select name="banco" id="banco" class="form-select">
                            <option  value="" selected>Selecciona el banco</option>
                            <?php foreach ($lista_bancos as $bancos) { ?>
                            <option  value="<?php echo $bancos['id_bancos']; ?> "><?php echo $bancos['Nombre_banco'];  ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="administradora" class="form-label">Administradora</label>
                        <input type="text" id="administradora" name="administradora" class="form-control"
                            placeholder="Eliga el banco" readonly disabled>
                    </div>


                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__No_nomina">
                            <label for="No_nomina" class="form-label">No. nomina</label>
                            <div class="formulario__grupo-input">
                                <input type="text"  class="form-control" name="No_nomina" id="No_nomina"
                                    placeholder="No_nomina" maxlength="7">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"><small
                                        class="formulario__input-error"> Nomina no valida.
                                    </small></i>
                            </div>
                        </div>
                    </div>
                   
                    <div class="contenido col-md-3">
                        <label for="responsable" class="form-label">Familiar Responsable</label>
                        <input type="text" maxlength="249" id="responsable" name="responsable" class="form-control"
                            placeholder="Ejem-Maria Gutierrez">
                    </div>
                    
                    <div class="contenido col-md-5">
                        <label for="comprobante" class="form-label">Comprobante de domicilio</label>
                        <input type="file" class="formulario__input-file" name="comprobante" id="comprobante" accept="application/pdf">
                    </div>
                    
                    <!--Credencial INE Frontal-->
                    <br><br><br><br><br>
                    <div class="row text-center">
                        <div class="col-md-5">
                            <label for="Credencial_front" class="form-label">Credencial INE Frontal</label>
                            <div class="profile-picture-cre">
                                <div class="picture-container-cre">
                                    <?php if (!empty($Credencial_front)) { ?>
                                    <img id="preview" src="<?php echo $Credencial_front; ?>">
                                    <?php } else { ?>
                                    <img id="preview" src="../../../../img/post.jpg"
                                        style="width: 350px ; height: 210px;">
                                    <?php } ?>
                                    <div class="overlay-cre">
                                        <?php if (empty($Credencial_front)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker(event)">
                                            <i class="fa-solid fa-image"></i>
                                        </a>

                                        <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto(event)">Eliminar
                                            foto</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <input type="file" class="form-control" name="Credencial_front" id="Credencial_front"
                                onchange="previewImage(this);" style="display: none;" accept="application/jpg">
                        </div>
                        <div class="col-md-4">
                            <label for="Credencial_post" class="form-label">Credencial INE Posterior</label>
                            <div class="profile-picture-cre">
                                <div class="picture-container-cre">
                                    <?php if (!empty($Credencial_post)) { ?>
                                    <img id="preview1" src="<?php echo $Credencial_post; ?>">
                                    <?php } else { ?>
                                    <img id="preview1" src="../../../../img/reverso.jpg"
                                        style="width: 350px ; height: 210px;">
                                    <?php } ?>
                                    <div class="overlay-cre">
                                        <?php if (empty($Credencial_post)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker1(event)">
                                            <i class="fa-solid fa-image"></i>
                                        </a>
                                        <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto1(event)">Eliminar
                                            foto</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <input type="file" class="form-control" name="Credencial_post" id="Credencial_post"
                                onchange="previewImage1(this);" style="display: none;" accept="application/jpg">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradora" class="form-label">Credencial Aseguradora
                            Frontal</label>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_aseguradora)) { ?>
                                <img id="preview2" src="<?php echo $Credencial_aseguradora; ?>">
                                <?php } else { ?>
                                <img id="preview2" src="../../../../img/post.jpg" style="width: 350px ; height: 210px;">
                                <?php } ?>
                                <div class="overlay-cre">
                                    <?php if (empty($Credencial_aseguradora)) { ?>
                                    <a href="#" class="change-link" onclick="openFilePicker2(event)">
                                        <i class="fa-solid fa-image"></i>
                                    </a>
                                    <?php } else { ?>
                                    <a href="#" class="delete-link" onclick="deletePhoto2(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradora"
                            id="Credencial_aseguradora" onchange="previewImage2(this);" style="display: none;"
                            accept="application/jpg">
                    </div>
                    <div class="contenido col-md-1">
                        <label></label>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradoras_post" class="form-label">Credencial Aseguradora
                            Posterior</label>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_aseguradoras_post)) { ?>
                                <img id="preview3" src="<?php echo $Credencial_aseguradoras_post; ?>">
                                <?php } else { ?>
                                <img id="preview3" src="../../../../img/reverso.jpg"
                                    style="width: 350px ; height: 210px;">
                                <?php } ?>
                                <div class="overlay-cre">
                                    <?php if (empty($Credencial_aseguradoras_post)) { ?>
                                    <a href="#" class="change-link" onclick="openFilePicker3(event)">
                                        <i class="fa-solid fa-image"></i>
                                    </a>
                                    <?php } else { ?>
                                    <a href="#" class="delete-link" onclick="deletePhoto3(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradoras_post"
                            id="Credencial_aseguradoras_post" onchange="previewImage3(this);" style="display: none;"
                            accept="application/jpg">
                    </div>
                    <div class="contenido col-md-9" style="text-align: center;">
                        <div class="formulario__mensaj" id="formulario__mensaj">
                            <p><i class="bi bi-stickies-fill"></i> <b>Nota:</b> Agrega las credenciales de
                                Aseguradora
                            </p>
                        </div>
                    </div>
                    <br>
                    <!-- Botones para el formulario -->

                    <div class="col-12">
                        <br>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-outline-primary">Registrar</button>
                        <a href="camara.php" target="_blank" class="btn btn-outline-success">
                            <i class="fa fa-camera"></i></a>
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

    //Configuro la colicitud
    op.open('GET', `consultaAdmi.php?banco_id=${bancoId}`, true);
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
<script src="../js/nomina.js"></script>
<script src="../js/botonAdd.js"></script>
<script src="../js/validacion.js"></script>
<script src="../js/formButtons.js"></script>
<script src="../js/domicilio.js"></script>
<script src="../js/paciente.js"></script>
</html>
<?php
include("../../../../templates/footer.php");
?>