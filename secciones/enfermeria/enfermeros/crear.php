<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
    include("../../../model/genero.php");
    include("../../../model/banco.php");
    include("../../../secciones/puestos/consulta.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="../../../assets/css/foto_perfil.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">
<link rel="stylesheet" href="css/valid.css">
</head>

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h2 style=" color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Nuevo Enfermero</h2>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="empleadosADD.php" method="POST" enctype="multipart/form-data" class="row g-3" id="formulario" novalidate>
                    <div class="contenido col-md-4" id="departamentoBox"><br>
                        <label for="departamento" class="form-label">Puesto: <span class="text-danger">*</span></label>
                       <?php
                        $puesto_11 = "";
                        foreach ($lista_puestos as $puesto) {
                        if ($puesto['id_puestos'] == 11) {
                            $puesto_11 = $puesto['Nombre_puestos'];
                            break;
                        }
                    }
                    ?>
                    <input type="text" value="<?php echo $puesto_11; ?>"  disabled>
                    </div>
                    <div class="contenido col-md-4" id="contratoBox"> <br>
                        <label for="contrato" class="form-label">Cuenta con contrato <span class="text-danger">*</span></label>
                        <select name="contrato" id="contrato" class="form-select" required>
                            <option value="">Seleccione contrato</option>
                            <option value="SI">Si contratado</option>
                            <option value="NO">No contratado</option>
                        </select>
                    </div>

                    <!-- Apartado de Datos Generales -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 class="form-title">Datos Generales</h2>
                    </div>

                    <div class="contenido col-md-5" id="nombresBox">
                        <label for="nombres" class="form-label">Nombre(s): <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-letters" name="nombres" id="nombres" placeholder="Ingrese el nombre" maxlength="40" required>
                    </div>
                    <div class="contenido col-md-5" id="apellidosBox">
                        <label for="apellidos" class="form-label">Apellidos: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-letters" name="apellidos" id="apellidos" placeholder="Apellidos" maxlength="40" required>
                    </div>
                    <div class="contenido col-md-3" id="generoBox">
                        <label for="genero" class="form-label">Género: <span class="text-danger">*</span></label>
                        <select id="genero" name="genero" class="form-select" required>
                            <option value="">Selecciona el género</option>
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>">
                                    <?php echo $genero['genero']; ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="contenido col-md-4" id="curpBox">
                        <label for="curp" class="form-label">CURP: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control letters-and-numbers" name="curp" id="curp" placeholder="Ingresa el CURP" minlength="18" maxlength="18" required>
                    </div>
                    <div class="contenido col-md-3" id="rfcBox">
                        <label for="rfc" class="form-label">RFC: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control letters-and-numbers" name="rfc" id="rfc" maxlength="13" placeholder="x1x1x1x1x1x1x1x" required>
                    </div>
                    <div class="contenido col-md-4" id="telefonoBox">
                        <label for="telefono" class="form-label">Teléfono: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-numbers" name="telefono" id="telefono" placeholder="Telefono de 10 digitos" minlength="10" maxlength="10" required>
                    </div>
                    <div class="contenido col-md-1 d-flex align-items-center cursor-pointer" style="display: flex; padding: 35px; padding-left: 15px;"
                         id="add">
                        <span class=" badge bg-primary fs-4 " id="addBoton">+</span>
                    </div>
                    <div class="contenido col-md-4" style="display: none;" id="tel">
                        <label for="telDos" class="form-label">Teléfono 2:</label>
                        <div class="input-group" >
                            <input type="text" maxlength="10" class="form-control" name="telDos" id="telDos"
                                placeholder="Télefono de 10 digitos">
                            <div class="input-group-append">
                                <a href="#" class="btn btn-info remove-lnk d-flex align-items-center" id="delBoton"
                                    style="border-radius: 4px; height: 100%;">
                                    <i class="fas fa-trash-alt justify-content-center"></i>
                                </a>
                            </div>
                        </div>
                        <p id="errTelDos" style="color: red; font-weight: bold;"></p>
                    </div>
                    <div class="contenido col-md-7">
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese el correo" maxlength="40">
                    </div>

                    <div class="contenido col-md-4" id="cuentaInputBox">
                        <label for="cuentaInput" class="form-label">Cuenta Bancaria: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-numbers" name="cuentaInput" id="cuentaInput" oninput="validarCuenta()" minlength="10" maxlength="20" placeholder="12345432" required>
                        <div id="mensajeError" class="error-message"></div>
                    </div>
                    <div class="contenido col-md-3" id="nssBox">
                        <label for="nss" class="form-label">NSS:</label>
                        <input type="text" class="form-control only-numbers" name="nss" id="nss" placeholder="Ingrese el correo" maxlength="11">
                    </div>
                    <div class="contenido col-md-3" id="nivelEducativoBox">
                        <label for="nivelEducativo" class="form-label">Nivel Estudios: <span class="text-danger">*</span></label>
                        <select name="nivelEducativo" id="nivelEducativo" class="form-select" required>
                            <option value="">Seleccione Grado</option>
                            <option value="Cédula">Cédula</option>
                            <option value="Bachillerato">Bachillerato</option>
                            <option value="Secundaria">Secundaria</option>
                        </select>
                    </div>

                    <!-- Apartado de Domicilio Actual -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 class="form-title">Domicilio Actual </h2>
                    </div>
                    <!--Aquí voy a meter el codigo postal-->
                    <div class="contenido col-md-7" id="calleBox">
                        <label for="calle" class="form-label">Calle: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control without-special" name="calle" id="calle" maxlength="100" placeholder="Rocita Elvires" required>
                    </div>
                    <div class="contenido col-md-2" id="numExtBox">
                        <label for="numExt" class="form-label">N° Ext.: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control with-point" name="numExt" id="numExt" maxlength="15" placeholder="Lt2" required>
                    </div>
                    <div class="contenido col-md-2" id="numIntBox">
                        <label for="numInt" class="form-label">N° Int.:</label>
                        <input type="text" class="form-control with-point" name="numInt" id="numInt" maxlength="15" placeholder="12">
                    </div>

                    <div class="contenido col-md-2" id="cpBox">
                        <label for="cp" class="form-label">Código Postal: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cp" placeholder="Ejem: 92734" required>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="colonia" class="form-label">Colonia: <span class="text-danger">*</span></label>
                        <select name="colonia" id="colonia" class="form-select" required>
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="delMun" class="form-label">Delegación/Municipio: </label>
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
                    <!--Aquí lo voy a cerrar el codigo postal-->
                    <div class="contenido col-md-5" id="calleUnoBox">
                        <label for="calleUno" class="form-label">Entre Calle: </label>
                        <input type="text" class="form-control without-special" name="calleUno" id="calleUno" placeholder="Laureles" maxlength="40">
                    </div>

                    <div class="contenido col-md-6" id="calleDosBox">
                        <label for="referencias" class="form-label">Y Calle:</label>
                        <input type="text" class="form-control without-special" name="calleDos" id="calleDos" placeholder="Rojo Gomez" maxlength="40">
                    </div>
                    <div class="contenido col-md-11" id="referenciasBox">
                        <label for="referencias" class="form-label">Referencias:</label>
                        <input type="text" class="form-control without-special" name="referencias" id="referencias" placeholder="Ejem. Frente a tiendita" maxlength="150">
                    </div>

                    <!-- Sección de Documentación -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 class="form-title">Documentación</h2>
                    </div>

                    <!-- INE -->
                    <div class="contenido col-md-5" id="ineAnverso">
                        <label for="ineAnverso" class="form-label">Credencial de Elector<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" aria-label="file example" name="ineAnverso" id="ineAnverso" required>
                    </div>
                    
                    <!-- Comprobante de domicilio -->
                    <div class="contenido col-md-5">
                        <label for="comprobanteDomicilio" class="form-label">Comprobante De Domicilio: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" aria-label="file example" required name="comprobanteDomicilio" id="comprobanteDomicilio">
                    </div>

                    <div class="contenido col-md-4">
                        <label for="certificadoEstudios" class="form-label">Último Certificado / Cédula: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" aria-label="file example" required name="certificadoEstudios" id="certificadoEstudios">
                        <div class="">Seleccione archivo pdf.</div>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="cuenta" class="form-label">Estado de Cuenta: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" aria-label="file example" required name="cuenta" id="cuenta">
                        <div class="">Seleccione archivo pdf.</div>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="curpDoc" class="form-label">CURP</label>
                        <input type="file" class="form-control" aria-label="file example" required name="curpDoc" id="curpDoc">
                    </div>

                    <div class="contenido col-md-4">
                        <label for="rfcDoc" class="form-label">RFC</label>
                        <input type="file" class="form-control" aria-label="file example" required name="rfcDoc" id="rfcDoc">
                    </div>
                    <!--Estos tambien hay que insertarlos-->
                    <div class="contenido col-md-4">
                        <label for="referenciaLabUno" class="form-label">Referencia Laboral</label>
                        <input type="file" class="form-control" aria-label="file example" name="referenciaLabUno" id="referenciaLabUno" required>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="referenciaLabDos" class="form-label">Referencia Personal</label>
                        <input type="file" class="form-control" aria-label="file example" name="referenciaLabDos" id="referenciaLabDos">
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>


            </div>
        </div>
</main>
<script src="../../../js/validacionRegex.js"></script>
<script src="../../../js/validacionEnvio.js"></script>
<script src="js/documentos.js"></script>
<script src="./js/validaciones.js"></script>
<!--<script src="../../../Js/domicilio.js"></script>-->
<script src="js/domicilio.js"></script>
<script src="../../../Js/botonAdd.js"></script>
<?php
include("../../../templates/footer.php");
?>