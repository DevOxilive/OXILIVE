<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
    include("../../../model/genero.php");
    include("../../../secciones/puestos/consulta.php");
    include("./empleadosUPP.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="css/valid.css">


<main id="main" class="main">
    <section class="section dashboard">
        <div class="card card-form">
            <div class="card-header">
                <h4>Editar Empleado</h4>
            </div>
            <div class="card-body">
                <form action="empleadosUPP.php" method="POST" enctype="multipart/form-data" class="row g-3" id="formulario" novalidate>
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="contenido col-md-3"> <br>
                        <label for="grado" class="form-label">Grado:</label>
                        <select name="grado" id="grado" class="form-select">
                            <option value="">SELECCIONA UN GRADO</option>
                            <option value="1" <?php echo ($Grado == 1) ? "selected" : "";  ?>>1</option>
                            <option value="2" <?php echo ($Grado == 2) ? "selected" : "";  ?>>2</option>
                            <option value="3" <?php echo ($Grado == 3) ? "selected" : "";  ?>>3</option>
                            <option value="4" <?php echo ($Grado == 4) ? "selected" : "";  ?>>4</option>
                            <option value="5" <?php echo ($Grado == 5) ? "selected" : "";  ?>>5</option>
                            <option value="6" <?php echo ($Grado == 6) ? "selected" : "";  ?>>6</option>
                        </select>
                    </div>
                    <!-- Apartado Libre -->
                    <div class="contenido col-md-4" id="departamentoBox"><br>
                        <label for="departamento" class="form-label">Puesto: <span class="text-danger">*</span></label>
                        <select id="departamento" name="departamento" class="form-select" required>
                            <?php foreach ($listadoEmpleados as $puesto) {
                                echo  '<option value="' . $puesto['Nombre_puestos'] . '">' . $Puesto . '</option>';
                                if ($Grado == $puesto['id_puestos']) {
                            ?>
                                    <option value="<?php echo $puesto['id_puestos']; ?>">
                                        <?php echo $puesto['Nombre_puestos']; ?>
                                    </option>
                            <?php
                                }
                                { ?>
                                    <option value="<?php echo $puesto['id_puestos']; ?>">
                                        <?php echo $puesto['Nombre_puestos']; ?>
                                    </option>
                            <?php }
                            } ?>
                        </select>
                    </div>

                    <!--LISTADO DE CONTRATO-->
                    <div class="contenido col-md-5" id="contratoBox"> <br>
                        <label for="contrato" class="form-label">Cuenta con contrato: <span class="text-danger">*</span></label>
                        <select name="contrato" id="contrato" class="form-select">
                            
                            <option value="SI CONTRATADO" <?php echo ($contrato == "SI CONTRATADO") ? "selected" : "";  ?>>SI CONTRATO</option>
                            <option value="NO CONTRATADO" <?php echo ($contrato == "NO CONTRATADO") ? "selected" : "";  ?>>NO CONTRATADO</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3" id="tipoDeContratoHid" style="display:none;">
                        <label for="tipoDeContrato" class="form-label">Tipo De Contrato:</label>
                        <select name="tipoDeContrato" id="tipoDeContrato" class="form-select">

                        <option value="PLANTA" <?php echo ($tipoDeContrato == "PLANTA") ? "selected" : "";  ?>>PLANTA / INDEFINIDO</option>                        
                        <option value="TEMPORAL" <?php echo ($tipoDeContrato == "TEMPORAL") ? "selected" : "";  ?>>TEMPORAL</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3" id="fechaAltaBox">
                    </div>


                    <!-- Apartado de Datos Generales -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 class="form-title">Datos Generales</h2>
                    </div>

                    <!-- Nombre Completo -->
                    <div class="contenido col-md-5" id="nombresBox">
                        <label for="nombres" class="form-label">Nombre(s): <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-letters" value="<?php echo $Nombres; ?>" name="nombres" id="nombres" placeholder="Ingrese el/los nombre(s)" minlength="3" maxlength="40">
                    </div>
                    <div class="contenido col-md-5" id="apellidosBox">
                        <label for="apellidos" class="form-label">Apellidos: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-letters" value="<?php echo $Apellidos ?>" name="apellidos" id="apellidos" placeholder="Ingrese los apellidos" minlength="3" maxlength="40">
                    </div>

                    <!-- Género -->
                    <div class="contenido col-md-3">
                        <label for="Genero" class="form-label">Género</label>
                        <select id="Genero" name="Genero" class="form-select">
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option <?php echo ($Genero == $genero['id_genero']) ? "selected" : ""; ?> value="<?php echo $genero['id_genero']; ?>">
                                    <?php echo $genero['genero']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- CURP y RFC -->
                    <div class="contenido col-md-4" id="curpBox">
                        <label for="curp" class="form-label">CURP: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control letters-and-numbers" value="<?php echo $Curp; ?>" name="curp" id="curp" placeholder="Ingresa el CURP" minlength="18" maxlength="18">
                    </div>
                    <div class="contenido col-md-3" id="rfcBox">
                        <label for="rfc" class="form-label">RFC: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control letters-and-numbers" value="<?php echo $rfc ?>" name="rfc" id="rfc" placeholder="x1x1x1x1x1x1x1x" minlength="13" maxlength="13">
                    </div>

                    <!-- Teléfono -->
                    <div class="contenido col-md-3" id="telefonoBox">
                        <label for="telefono" class="form-label">Teléfono: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-numbers" value="<?php echo $telefono ?>" name="telefono" id="telefono" placeholder="Teléfono de 10 digitos" minlength="10" maxlength="10">
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="contenido col-md-4">
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $correo ?>" id="email" placeholder="Ingresa el correo electrónico" minlength="15" maxlength="50">
                    </div>

                    <!-- Div de relleno -->
                    <div class="col-md-2"></div>

                    <!-- Número de cuenta bancaria -->
                    <div class="contenido col-md-4" id="cuentaInputBox">
                        <label for="cuentaInput" class="form-label">Cuenta Bancaria: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-numbers" value="<?php echo $cuentaBancaria ?>" name="cuentaInput" id="cuentaInput" placeholder="12345432" oninput="validarCuenta()" minlength="10" maxlength="20">
                        <div id="mensajeError" class="error-message"></div>
                    </div>

                    <!-- NSS -->
                    <div class="contenido col-md-3" id="nssBox">
                        <label for="nss" class="form-label">NSS: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control only-numbers" name="nss" id="nss" value="<?php echo $nss ?>" placeholder="Ingrese el correo" minlength="11" maxlength="11">
                    </div>

                    <!-- Nivel Educativo -->
                    <div class="contenido col-md-3" id="nivelEducativoBox">
                        <label for="nivelEducativo" class="form-label">Nivel Estudios: <span class="text-danger">*</span></label>
                        <select name="nivelEducativo" id="nivelEducativo" class="form-select">
                        <option value="CEDULA" <?php echo ($nivelEducativo == "CEDULA") ? "selected" : "";  ?>>CÈDULA</option>                        
                        <option value="BACHILLERATO" <?php echo ($nivelEducativo == "BACHILLERATO") ? "selected" : "";  ?>>BACHILLERATO</option>                        
                        <option value="SECUNDARIA" <?php echo ($nivelEducativo == "SECUNDARIA") ? "selected" : "";  ?>>SECUNDARIA</option>                        

                        </select>
                    </div>

                    <div class="contenido col-md-12">
                        <label for="especialidad" class="form-label">Especialidad:</label>
                        <input type="text" class="form-control" value="<?php echo $especialidad ?>" name="especialidad" id="especialidad" placeholder="Especialidad del àrea" maxlength="249">
                    </div>

                    <!-- Apartado de Domicilio -->
                    <?php include("../../../templates/apartadoDom.php"); ?>

                    <!-- Apartado de Documentación -->
                    <div class="contenido col-md-12">
                        <hr>
                        <h2 class="form-title">Documentación</h2>
                    </div>

                    <!-- INE -->
                    <div class="contenido col-md-5" id="ineDocBox">
                        <label for="ineDoc" class="form-label">Credencial de Elector: <span class="text-danger">*</span> </label>
                        <input type="file" class="form-control" name="ineDoc" id="ineDoc"> Ver INE: <a target="_blank" href="<?php echo $Ine; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>
                    <!-- Acta de Nacimiento -->
                    <div class="contenido col-md-5" id="actaNacimientoBox">
                        <label for="actaNacimiento" class="form-label">Acta De Nacimiento: </label>
                        <input type="file" class="form-control" name="actaNacimiento" id="actaNacimiento"> Ver Acta Nacimiento: <a target="_blank" href="<?php echo $acta; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>

                    <!-- Comprobante de domicilio -->
                    <div class="contenido col-md-5" id="comprobanteDomicilioBox">
                        <label for="comprobanteDomicilio" class="form-label">Comprobante De Domicilio: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="comprobanteDomicilio" id="comprobanteDomicilio">Ver Comprobante: <a target="_blank" href="<?php echo $comprobante; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>

                    <!-- Último certificado o Cédula -->
                    <div class="contenido col-md-4" id="certificadoEstudiosBox">
                        <label for="certificadoEstudios" class="form-label">Último Certificado / Cédula: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="certificadoEstudios" id="certificadoEstudios">Ver Certificado: <a target="_blank" href="<?php echo $certificado; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>

                    <!-- Estado de cuenta -->
                    <div class="contenido col-md-4" id="cuentaBox">
                        <label for="cuenta" class="form-label">Estado de Cuenta: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="cuenta" id="cuenta">Ver Estado Cuenta: <a target="_blank" href="<?php echo $numCuenta; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>

                    <!-- NSS Documento -->
                    <div class="contenido col-md-4" id="nssDocBox">
                        <label for="nssDoc" class="form-label">Nùmero De Seguro Social:</label>
                        <input type="file" class="form-control" name="nssDoc" id="nssDoc">Ver NSS: <a target="_blank" href="<?php echo $nssDoc; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>

                    <!-- CURP Documento -->
                    <div class="contenido col-md-4" id="curpDocBox">
                        <label for="curpDoc" class="form-label">CURP: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="curpDoc" id="curpDoc">Ver CURP: <a target="_blank" href="<?php echo $curp; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>

                    <!-- RFC Documento -->
                    <div class="contenido col-md-4" id="rfcDocBox">
                        <label for="rfcDoc" class="form-label">RFC: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="rfcDoc" id="rfcDoc">Ver RFC: <a target="_blank" href="<?php echo $rfcDoc; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>

                    <!--Estos tambien hay que insertarlos-->
                    <div class="contenido col-md-4" id="referenciaLabBox">
                        <label for="referenciaLabUno" class="form-label">Referencia Laboral: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="referenciaLabUno" id="referenciaLab">Ver Ref.Laboral: <a target="_blank" href="<?php echo $laboral; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="referenciaLabDos" class="form-label">Referencia Personal:</label>
                        <input type="file" class="form-control" aria-label="file example" name="referenciaLabDos" id="referenciaLabDos">Ver Ref.Personal: <a target="_blank" href="<?php echo $personal; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="licenciaUno" class="form-label">Licencia: </label>
                        <input type="file" class="form-control" aria-label="file example" name="licenciaUno" id="licenciaUno">Ver Licencia: <a target="_blank" href="<?php echo $licencia; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    </div>
                    <div class="contenido col-md-3" id="tipoLicenciaBox">
                        <label for="tipoLicencia" class="form-label">Tipo de Licencia:</label>
                        <input type="text" class="form-control letters-and-numbers" name="tipoLicencia" value="<?php echo $tipoLicencia ?>" id="tipoLicencia" placeholder="Ejemplo A" minlength="1" maxlength="2">
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
<script src="./js/validaciones.js"></script>
<script src="../../../js/domicilio.js"></script>
<script src="js/grado.js"></script>
<script src="js/contrato.js"></script>
<?php include("../../../templates/footer.php"); ?>