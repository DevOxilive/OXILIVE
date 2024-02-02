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
        <h2>Empleado </h2>
        <hr>
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
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#diagnostico">Documentación</button>
    </li>
    <li class="nav-item ms-auto">
        <a href="index.php" class="btn btn-sm btn-danger">
            <span class="badge badge-danger">X</span>
        </a>
    </li>
</ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active paciente" id="general">
                        <h5 class="card-title">Datos generales</h5>

                        <dl class="row">
                            <dt class="col-lg-3 col-md-4 label">Nombre(s):</dt>
                            <dd class="col-lg-9 col-md-8" id="nombres"><?php echo $Nombres; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">Apellidos:</dt>
                            <dd class="col-lg-9 col-md-8" id="apellidos"><?php echo $Apellidos; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">Género:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $Genero; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">Telefono:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $telefono; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">Telefono Dos:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $telefonoDos ?></dd>

                            <dt class="col-lg-3 col-md-4 label">Correo:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $correo; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">CURP:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $Curp; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">rfc:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $rfc; ?></dd>
                        </dl>

                    </div>
                    <div class="tab-pane fade paciente" id="direccion">
                        <h5 class="card-title">Dirección del domicilio</h5>
                        <dl class="row">
                            <dt class="col-lg-3 col-md-4 label">Calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calle"><?php echo $calle; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">N° Exterior:</dt>
                            <dd class="col-lg-9 col-md-8" id="noext"><?php echo $numInt; ?></dd>

                            <dt class="col-lg-3 col-md-4 label" id="noint-label">N° Interior:</dt>
                            <dd class="col-lg-9 col-md-8" id="noint"><?php echo $numExt; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">Colonia:</dt>
                            <dd class="col-lg-9 col-md-8" id="colonia"><?php echo $colonia; ?></dd>

                            <dt class="col-lg-3 col-md-4 label">Código Postal:</dt>
                            <dd class="col-lg-9 col-md-8" id="cp"><?php echo $codigo_postal ?></dd>

                            <dt class="col-lg-3 col-md-4 label">Delegación/Municipio:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $municipio ?> </dd>

                            <dt class="col-lg-3 col-md-4 label">Estado:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $estado?></dd>

                            <dt class="col-lg-3 col-md-4 label" id="calleUno-label">Entre calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calleUno"><?php echo $calleUno ?></dd>

                            <dt class="col-lg-3 col-md-4 label" id="calleDos-label">Y calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calleDos"><?php echo $calleDos ?></dd>

                            <dt class="col-lg-3 col-md-4 label" id="referencias-label">Referencias:</dt>
                            <dd class="col-lg-9 col-md-8"><?php echo $referencias?></dd>

                        </dl>
                    </div>
                    <div class="tab-pane fade paciente" id="diagnostico" style="text-align: center;">
                        <dl class="row">
                            <!-- <div class="card" style="width: 10rem;">
                                <img class="card-img-top"
                                    src="https://www.debate.com.mx/__export/1677448001431/sites/debate/img/2023/02/26/licencia_de_conducir_slp.jpg_242310155.jpg"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <label for="licenciaUno" class="form-label">Licencia:
                                        <a target="_blank" href="<?php echo $licencia; ?>"><i
                                                class="bi bi-eye-fill"></i></a></label>
                                </div>
                            </div> -->
                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $Ine; ?>"><br>
                                    <img class="card-img-top" src="https://cdn.forbes.com.mx/2019/06/INE.jpg"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">INE:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>

                            <!-- CURP Documento -->
                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $curp; ?>"><br>
                                    <img class="card-img-top"
                                        src="https://cdn-3.expansion.mx/dims4/default/e90802f/2147483647/strip/true/crop/827x470+0+0/resize/1800x1023!/format/webp/quality/80/?url=https%3A%2F%2Fcdn-3.expansion.mx%2F8a%2F04%2Fb11e7df7416a85f238834fac2d27%2Fscreen-shot-2021-10-19-at-7.21.27%20PM.png"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">CURP:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>
                            <!-- RFC Documento -->
                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $rfcDoc; ?>"><br>
                                    <img class="card-img-top"
                                        src="https://www.elcontribuyente.mx/wp-content/uploads/2021/05/El-SAT-cambio-el-tramite-de-inscripcion-en-el-RFC-de-personas-morales.jpg"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">RFC:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>

                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $licencia; ?>"><br>
                                    <img class="card-img-top"
                                        src="https://www.elfinanciero.com.mx/resizer/hyqZfB0UtbEB8zaZUD33TuodEX8=/1440x810/filters:format(jpg):quality(70)/cloudfront-us-east-1.images.arcpublishing.com/elfinanciero/6TXUS5L4TVGAJPGZ423MHSA54Y.jpg"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">Licencia:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>

                            <!-- Último certificado o Cédula -->
                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $certificado; ?>"><br>
                                    <img class="card-img-top"
                                        src="https://tvazteca.brightspotcdn.com/dims4/default/ff76a25/2147483647/strip/true/crop/1280x720+0+0/resize/1200x675!/quality/90/?url=http%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F80%2F33%2F50441f1a4f93a58f7f29938afd7b%2Fque-es-la-cedula-profesional-y-por-que-es-importante-tramitarla.jpg"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">Último Certificado / Cédula:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>

                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $acta; ?>"> <br>
                                    <img class="card-img-top"
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Acta_de_Nacimiento_Gabriela_Alejandra_Guzm%C3%A1n_Pinal.pdf/page1-1275px-Acta_de_Nacimiento_Gabriela_Alejandra_Guzm%C3%A1n_Pinal.pdf.jpg"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">Acta:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>
                            <!--Aqui voy a poner los que faltan-->
                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $comprobante; ?>"> <br>
                                    <img class="card-img-top"
                                        src="https://imgv2-1-f.scribdassets.com/img/document/481248227/original/405ede6c2e/1706219779?v=1"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">Comprobante:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>

                            <!--Estos tambien hay que insertarlos-->
                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $laboral; ?>"><br>
                                    <img class="card-img-top"
                                        src="https://www.nominapro.mx/wp-content/uploads/2023/04/carta-de-referencia-laboral.png"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">Referencia Laboral:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>

                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $personal; ?>"><br>
                                    <img class="card-img-top"
                                        src="https://www.nominapro.mx/wp-content/uploads/2023/04/carta-de-referencia-laboral.png"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">Referencia Personal:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>
                            <!-- Estado de cuenta -->
                            <div class="card" style="width: 10rem;">
                                <a target="_blank" href="<?php echo $numCuenta; ?>"><br>
                                    <img class="card-img-top"
                                        src="https://transparencia.tlaquepaque.gob.mx/wp-content/uploads/2016/01/ICNPNG188.png"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">Estado de Cuenta:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>
                            <!-- NSS Documento -->
                            <div class="card" style="width: 13rem;">
                                <a target="_blank" href="<?php echo $nssDoc; ?>"><br>
                                    <img class="card-img-top"
                                        src="https://www.mejortasa.com.mx/wp-content/uploads/2018/12/que-es-nss.jpg"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <label for="licenciaUno" class="form-label">Nùmero De Seguro Social:
                                            <i class="bi bi-eye-fill"></i></label>
                                    </div>
                                </a>
                            </div>
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