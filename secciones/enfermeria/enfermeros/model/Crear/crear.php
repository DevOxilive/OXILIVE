
<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../../templates/header.php");
    require_once "../../../../../connection/conexion.php";
    include("../../../../../model/genero.php");
    include("../../consulta.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="../../../../../assets/css/foto_perfil.css">
<link rel="stylesheet" href="../../../../../assets/css/edit.css">
<link rel="stylesheet" href="../../css/valid.css">


<main id="main" class="main">
    <section class="section dashboard">
        <div class="card card-form">
            <div class="card-header">
                <h4>Nuevo Empleado</h4>
            </div>
            <div class="card-body">
                <form action="./enfermeroADD.php" method="POST" enctype="multipart/form-data" class="row g-3" id="formulario" novalidate>
                    <!--PUESTO DE ENFERMERIA -->
                    <div class="contenido col-md-4" id="departamentoBox"><br>
                        <label for="departamento" class="form-label">Puesto: <span class="text-danger">*</span></label>
                        <?php
                        $puesto_11 = "";
                        foreach ($lista as $puesto) {
                        if ($puesto['id_puestos'] == 6) {
                            $puesto_11 = $puesto['Nombre_puestos']; 
                            break;
                        }
                    }
                    ?>
                    <input type="text" value="<?php echo $puesto_11; ?>"  disabled>
                    </div>

                    <div class="contenido col-md-5" id="contratoBox"> <br>
                        <label for="contrato" class="form-label">Cuenta con contrato: <span class="text-danger">*</span></label>
                        <select name="contrato" id="contrato" class="form-select" required>
                            <option value="">Seleccione contrato</option>
                            <option value="SI CONTRATADO">SI CONTRATADO</option>
                            <option value="NO CONTRATADO">NO CONTRATADO</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3"> <br>
                        <label for="tipoDeContrato" class="form-label">Tipo De Contrato:</label>
                        <select name="tipoDeContrato" id="tipoDeContrato" class="form-select">
                            <option value="">Seleccione contrato</option>
                            <option value="PLANTA">PLANTA</option>
                            <option value="TEMPORAL">TEMPORAL</option>
                            <option value="INDEFINIDO">INDEFINIDO</option>
                        </select>
                    </div>
                    <!-- <div class="contenido col-md-3" id="fechaAltaBox"><br>
                        <label for="fechaAlta" class="form-label">Fecha Alta Contrato: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control " name="fechaAlta" id="fechaAlta" required>
                    </div> -->
                    
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
                    <!-- Telefono Dos -->
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
                                    style="border-radius: 3px; height: 100%;">
                                    <i class="fas fa-trash-alt justify-content-center"></i>
                                </a>
                            </div>
                        </div>
                        <p id="errTelDos" style="color: red; font-weight: bold;"></p>
                    </div>
                    <!--Fin del telefono dos-->
                    
                    <!-- Correo Electrónico -->
                    <div class="contenido col-md-5">
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

                    <!-- Apartado de Domicilio -->
                    <?php include("../../../../../templates/apartadoDom.php");?>

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
<script src="../../../../../Js/validacionRegex.js"></script>
<script src="../../../../../Js/validacionEnvio.js"></script>
<script src="../../js/validaciones.js"></script>
<script src="../../../../../js/domicilio.js"></script>
<script src="../../../../../Js/botonAdd.js"></script>

<!--<script src="js/documentos.js"></script>
 -->
<?php include("../../../../../templates/footer.php"); ?>
