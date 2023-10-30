<?php
session_start();
if (isset($_SESSION['us'])) {

} else {

}
?>
<!doctype html>
<html lang="es">

<head>
    <title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/log.css">
    <link rel="icon" href="img/OXILIVE.ico">
</head>

<body>
    <section id="sect1" class="sect">
        <video src="https://prod-streaming-video-msn-com.akamaized.net/49a16a97-2dfb-4296-90f4-12459a46d5d5/c5fc2d44-2573-4fff-99d7-c863763063e6.mp4" autoplay="true" muted="true" loop="true" poster="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA110KSi.img"></video>
        <div class="section">
            <div class="container">
                <div class="row full-height justify-content-center">
                    <div class="col-12 text-center align-self-center py-5">
                        <div class="section pb-5 pt-5 pt-sm-2 text-center">
                            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                            <label for="reg-log"></label>
                            <div class="card-3d-wrap mx-auto">
                                <div class="card-3d-wrapper">
                                    <div class="card-front">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <?php if (isset($error)) { ?>
                                                    <p style="color: red;">
                                                        <?php echo $error; ?>
                                                    </p>
                                                <?php } ?>
                                                <h4 class="mb-3 pb-3">Iniciar Sesión</h4>
                                                <form method="POST" action="procesarlogin.php" id="formLogin">
                                                    <div class="form-group">
                                                        <input type="text" name="txtUsu" class="form-style" placeholder="Usuario">
                                                        <i class="input-icon uil uil-user"></i>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="password" name="txtPass" class="form-style" placeholder="Contraseña">
                                                        <i class="input-icon uil uil-lock-alt"></i>
                                                    </div>
                                                    <button class="btn mt-4" type="submit" class="login-form-btn">Iniciar sesión</button>
                                            </div>
                                            </form>
                                            <p class="mb-0 mt-4 text-center"><a href="registro/registro.php" class="link">¿No tienes cuenta? Registrate</a></p>
                                        </div>
                                    </div>
                                    <div class="card-back">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-3 pb-3">¿Quienes somos?</h4>
                                                <div class="form-group text-center">
                                                    <p type="text" class="formu-style"> Somos líderes en términos de
                                                        rendimiento, seguridad, confiabilidad, durabilidad y bajos
                                                        costos operativos. Tuvimos la idea de generar un nuevo concepto
                                                        de negocio enfocado y especializado de oxígeno medicinal,
                                                        considerando la demanda del mundo actual. Creemos firmemente que
                                                        las enfermedades no tiene horario y por ello nuestro servicio de
                                                        entrega es lo más importante.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="JS/jquery-3.7.0.min.js"></script>

</html>