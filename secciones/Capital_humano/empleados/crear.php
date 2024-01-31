<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
    include("../../../model/genero.php");
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
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Nuevo Empleado</h4>
            </div>

            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="empleadosADD.php" method="POST" enctype="multipart/form-data" class="row g-3" id="formulario" novalidate>

                    <!-- Apartado Libre -->
                    <div class="contenido col-md-4" id="departamentoBox"><br>
                        <label for="departamento" class="form-label">Puesto: <span class="text-danger">*</span></label>
                        <select id="departamento" name="departamento" class="form-select" required>
                            <option value="">Selecciona el departamento</option>
                            <?php foreach ($lista_puestos as $puesto) {
                                if (
                                    $puesto['id_puestos'] != "1" &&
                                    $puesto['id_puestos'] != "11"

                                ) { ?>
                                    <option value="<?php echo $puesto['id_puestos']; ?>">
                                        <?php echo $puesto['Nombre_puestos']; ?>
                                    </option>
                            <?php }
                            } ?>
                        </select>
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

                    <!-- Nombre Completo -->
                    <div class="contenido col-md-5" id="nombresBox">
                        <label for="nombres" class="form-label">Nombre(s): <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-letters" name="nombres" id="nombres" placeholder="Ingrese el/los nombre(s)" minlength="3" maxlength="40" required>
                    </div>
                    <div class="contenido col-md-5" id="apellidosBox">
                        <label for="apellidos" class="form-label">Apellidos: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-letters" name="apellidos" id="apellidos" placeholder="Ingrese los apellidos" minlength="3" maxlength="40" required>
                    </div>

                    <!-- Género -->
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

                    <!-- CURP y RFC -->
                    <div class="contenido col-md-4" id="curpBox">
                        <label for="curp" class="form-label">CURP: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control letters-and-numbers" name="curp" id="curp" placeholder="Ingresa el CURP" minlength="18" maxlength="18" required>
                    </div>
                    <div class="contenido col-md-3" id="rfcBox">
                        <label for="rfc" class="form-label">RFC: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control letters-and-numbers" name="rfc" id="rfc" placeholder="x1x1x1x1x1x1x1x" minlength="13" maxlength="13" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="contenido col-md-4" id="telefonoBox">
                        <label for="telefono" class="form-label">Teléfono: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-numbers" name="telefono" id="telefono" placeholder="Teléfono de 10 digitos" minlength="10" maxlength="10" required>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="contenido col-md-6">
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa el correo electrónico" minlength="15" maxlength="50">
                    </div>

                    <!-- Div de relleno -->
                    <div class="col-md-2"></div>

                    <!-- Número de cuenta bancaria -->
                    <div class="contenido col-md-4" id="cuentaInputBox">
                        <label for="cuentaInput" class="form-label">Cuenta Bancaria: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-numbers" name="cuentaInput" id="cuentaInput" placeholder="12345432" oninput="validarCuenta()" minlength="10" maxlength="20" required>
                        <div id="mensajeError" class="error-message"></div>
                    </div>

                    <!-- NSS -->
                    <div class="contenido col-md-3" id="nssBox">
                        <label for="nss" class="form-label">NSS: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-numbers" name="nss" id="nss" placeholder="Ingrese el correo" minlength="11" maxlength="11" required>
                    </div>

                    <!-- Nivel Educativo -->
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

                    <!-- Inicio de Libreria de domicilio -->
                    <div class="contenido col-md-7" id="calleBox">
                        <label for="calle" class="form-label">Calle: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control without-special" name="calle" id="calle" placeholder="Ingresa el nombre de la calle" maxlength="100" required>
                    </div>
                    <div class="contenido col-md-2" id="numExtBox">
                        <label for="numExt" class="form-label">N° Ext.: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control with-point" name="numExt" id="numExt" placeholder="MZ 2" maxlength="15" required>
                    </div>
                    <div class="contenido col-md-2" id="numIntBox">
                        <label for="numInt" class="form-label">N° Int.:</label>
                        <input type="text" class="form-control with-point" name="numInt" id="numInt" placeholder="LT 21" maxlength="15">
                    </div>
                    <div class="contenido col-md-3" id="cpBox">
                        <label for="cp" class="form-label">Código Postal: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cp" placeholder="Ejem: 92734" required>
                    </div>
                    <div class="contenido col-md-3" id="coloniaBox">
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
                    <div class="contenido col-md-5" id="calleUnoBox">
                        <label for="calleUno" class="form-label">Entre Calle: </label>
                        <input type="text" class="form-control without-special" name="calleUno" id="calleUno" placeholder="Laureles" maxlength="40">
                    </div>
                    <div class="contenido col-md-6" id="calleDosBox">
                        <label for="calleDos" class="form-label">Y Calle:</label>
                        <input type="text" class="form-control without-special" name="calleDos" id="calleDos" placeholder="Rojo Gomez" maxlength="40">
                    </div>
                    <div class="contenido col-md-11" id="referenciasBox">
                        <label for="referencias" class="form-label">Referencias:</label>
                        <input type="text" class="form-control without-special" name="referencias" id="referencias" placeholder="Ejem. Frente a tiendita" maxlength="150">
                    </div>
                    <!-- Fin de Libreria de Domicilio -->

                    <!-- Apartado de Documentación -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 class="form-title">Documentación</h2>
                    </div>

                    <!-- INE -->
                    <div class="contenido col-md-5" id="ineDocBox">
                        <label for="ineDoc" class="form-label">Credencial de Elector: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="ineDoc" id="ineDoc" required>
                    </div>
                    <!-- Acta de Nacimiento -->
                    <div class="contenido col-md-5" id="actaNacimientoBox">
                        <label for="actaNacimiento" class="form-label">Acta De Nacimiento: </label>
                        <input type="file" class="form-control" name="actaNacimiento" id="actaNacimiento">
                    </div>

                    <!-- Comprobante de domicilio -->
                    <div class="contenido col-md-5" id="comprobanteDomicilioBox">
                        <label for="comprobanteDomicilio" class="form-label">Comprobante De Domicilio: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="comprobanteDomicilio" id="comprobanteDomicilio" required>
                    </div>

                    <!-- Último certificado o Cédula -->
                    <div class="contenido col-md-4" id="certificadoEstudiosBox">
                        <label for="certificadoEstudios" class="form-label">Último Certificado / Cédula: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="certificadoEstudios" id="certificadoEstudios" required>
                    </div>

                    <!-- Estado de cuenta -->
                    <div class="contenido col-md-4" id="cuentaBox">
                        <label for="cuenta" class="form-label">Estado de Cuenta: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="cuenta" id="cuenta" required>
                    </div>

                    <!-- NSS Documento -->
                    <div class="contenido col-md-4" id="nssDocBox">
                        <label for="nssDoc" class="form-label">Nùmero De Seguro Social:</label>
                        <input type="file" class="form-control" name="nssDoc" id="nssDoc" required>
                    </div>

                    <!-- CURP Documento -->
                    <div class="contenido col-md-4" id="curpDocBox">
                        <label for="curpDoc" class="form-label">CURP: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="curpDoc" id="curpDoc" required>
                    </div>

                    <!-- RFC Documento -->
                    <div class="contenido col-md-4" id="rfcDocBox">
                        <label for="rfcDoc" class="form-label">RFC: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="rfcDoc" id="rfcDoc" required>
                    </div>

                    <!--Estos tambien hay que insertarlos-->
                    <div class="contenido col-md-4" id="referenciaLabBox">
                        <label for="referenciaLabUno" class="form-label">Referencia Laboral: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="referenciaLabUno" id="referenciaLab" required>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="referenciaLabDos" class="form-label">Referencia Personal:</label>
                        <input type="file" class="form-control" aria-label="file example" name="referenciaLabDos" id="referenciaLabDos">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="licenciaUno" class="form-label">Licencia: </label>
                        <input type="file" class="form-control" aria-label="file example" name="licenciaUno" id="licenciaUno">
                    </div>
                    <div class="contenido col-md-3" id="tipoLicenciaBox">
                        <label for="tipoLicencia" class="form-label">Tipo de Licencia:</label>
                        <input type="text" class="form-control letters-and-numbers" name="tipoLicencia" id="tipoLicencia" placeholder="Ejemplo A" minlength="1" maxlength="2" required>
                    </div>

                    <!-- Apartado Botones -->
                    <div class="col-12">
                        <hr>
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<script src="../../../js/validacionRegex.js"></script>
<script src="../../../js/validacionEnvio.js"></script>
<script src="js/validaciones.js"></script>
<script src="js/documentos.js"></script>
<script src="js/domicilio.js"></script>
<?php include("../../../templates/footer.php"); ?>