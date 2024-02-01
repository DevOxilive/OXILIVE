<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("model/infoEmpleados.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Empleado</h1>
        
    </div><!-- End Page Title -->
    <div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general">General</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#direccion">Dirección</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#diagnostico">Documentaciòn</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active paciente" id="general">
                        <h5 class="card-title">Datos generales</h5>
                       
                        <dl class="row">
                        <dt class="col-lg-3 col-md-4 label">Nombre(s):</dt>
                        <dd class="col-lg-9 col-md-8" id="nombres"><?php echo $Nombres; ?></dd>


                            <dt class="col-lg-3 col-md-4 label">Apellidos:</dt>
                            <dd class="col-lg-9 col-md-8" id="apellidos"></dd>

                            <dt class="col-lg-3 col-md-4 label">Género:</dt>
                            <dd class="col-lg-9 col-md-8" id="genero"></dd>

                            <dt class="col-lg-3 col-md-4 label">Edad:</dt>
                            <dd class="col-lg-9 col-md-8" id="edad"></dd>

                            <dt class="col-lg-3 col-md-4 label">Tipo de Paciente:</dt>
                            <dd class="col-lg-9 col-md-8" id="tipoPac"></dd>

                            <dt class="col-lg-3 col-md-4 label">Telefono:</dt>
                            <dd class="col-lg-9 col-md-8" id="telefono"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="telefonoDos-label">Telefono 2:</dt>
                            <dd class="col-lg-9 col-md-8" id="telefonoDos"></dd>

                            <dt class="col-lg-3 col-md-4 label">Expediente N°:</dt>
                            <dd class="col-lg-9 col-md-8" id="expediente"></dd>
                        </dl>
                       
                    </div>
                    <div class="tab-pane fade paciente" id="direccion">
                        <h5 class="card-title">Dirección del domicilio</h5>
                        <dl class="row">
                            <dt class="col-lg-3 col-md-4 label">Calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calle"></dd>

                            <dt class="col-lg-3 col-md-4 label">N° Exterior:</dt>
                            <dd class="col-lg-9 col-md-8" id="noext"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="noint-label">N° Interior:</dt>
                            <dd class="col-lg-9 col-md-8" id="noint"></dd>

                            <dt class="col-lg-3 col-md-4 label">Colonia:</dt>
                            <dd class="col-lg-9 col-md-8" id="colonia"></dd>

                            <dt class="col-lg-3 col-md-4 label">Código Postal:</dt>
                            <dd class="col-lg-9 col-md-8" id="cp"></dd>

                            <dt class="col-lg-3 col-md-4 label">Delegación/Municipio:</dt>
                            <dd class="col-lg-9 col-md-8" id="delMun"></dd>

                            <dt class="col-lg-3 col-md-4 label">Estado:</dt>
                            <dd class="col-lg-9 col-md-8" id="estadoDir"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="calleUno-label">Entre calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calleUno"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="calleDos-label">Y calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calleDos"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="referencias-label">Referencias:</dt>
                            <dd class="col-lg-9 col-md-8" id="referencias"></dd>

                        </dl>
                    </div>
                    <div class="tab-pane fade paciente" id="diagnostico">


                        <h5 class="card-title">Documentaciòn</h5>
                        <dl class="row">
                        <label for="licenciaUno" class="form-label">Licencia: 
                            <a target="_blank" href="<?php echo $Ine; ?>"><i class="bi bi-eye-fill"></i></a></label>
                        </label>

                        <label for="licenciaUno" class="form-label">Acta De Nacimiento: 
                            <a target="_blank" href="<?php echo $acta; ?>"><i class="bi bi-eye-fill"></i></a></label>
                        </label>
                    <!--Aqui voy a poner los que faltan-->
                        <label for="comprobanteDomicilio" class="form-label">Comprobante De Domicilio:
                            <a target="_blank" href="<?php echo $comprobante; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    <!-- Último certificado o Cédula -->
                        <label for="certificadoEstudios" class="form-label">Último Certificado / Cédula:
                         <a target="_blank" href="<?php echo $certificado; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    
                    <!-- Estado de cuenta -->
                        <label for="cuenta" class="form-label">Estado de Cuenta: 
                         <a target="_blank" href="<?php echo $numCuenta; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    
                    <!-- NSS Documento -->
                        <label for="nssDoc" class="form-label">Nùmero De Seguro Social:
                         <a target="_blank" href="<?php echo $nssDoc; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    
                    <!-- CURP Documento -->
                        <label for="curpDoc" class="form-label">CURP: 
                         <a target="_blank" href="<?php echo $curp; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    
                    <!-- RFC Documento -->
                        <label for="rfcDoc" class="form-label">RFC: 
                            <a target="_blank" href="<?php echo $rfcDoc; ?>"><i class="bi bi-eye-fill"></i></a></label>

                    <!--Estos tambien hay que insertarlos-->
                        <label for="referenciaLabUno" class="form-label">Referencia Laboral:
                        <a target="_blank" href="<?php echo $laboral; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    
                        <label for="referenciaLabDos" class="form-label">Referencia Personal:
                        <a target="_blank" href="<?php echo $personal; ?>"><i class="bi bi-eye-fill"></i></a></label>
                    
                        <label for="licenciaUno" class="form-label">Licencia: 
                        <a target="_blank" href="<?php echo $licencia; ?>"><i class="bi bi-eye-fill"></i></a></label>
                
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="idPaciente" value="<?php echo $paciente; ?>">
        <input type="hidden" id="puesto" value="<?php echo $_SESSION['puesto']; ?>">
</main>

</html>
<?php
include('../../../templates/footer.php');
?>