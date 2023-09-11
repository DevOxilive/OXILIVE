<?php
include("../connection/conexion.php");
include("../module/genero.php");
include("registroADD.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="../img/OXILIVE.ico">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/registro.css">
    <link rel="stylesheet" href="../assets/css/foto_perfil.css">
    <title>Registrarse</title>
    <style>
    </style>
</head>

<body>
    <section id="sect1" class="sect">
        <video
            src="https://prod-streaming-video-msn-com.akamaized.net/49a16a97-2dfb-4296-90f4-12459a46d5d5/c5fc2d44-2573-4fff-99d7-c863763063e6.mp4"
            autoplay="true" muted="true" loop="true"
            poster="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA110KSi.img"></video>
        <div class="container contact-form">
            <form method="POST" action="registroADD.php" enctype="multipart/form-data" class="formulario"
                id="formulario">
                <h4 class="mb-3 pb-3" style="text-align:center;">Formulario de Registro</h4> <br>
                <h6 style="padding: 0 20px; font-weight: 700;" class="tema"> <i class="input-icon uil uil-user"></i>
                    Datos
                    personales </h6>
                <hr>
                <div class="section">
                    <!-- Grupo: Nombre -->
                    <div class="formulario__grupo" id="grupo__nombre">
                        <label for="nombre" class="formulario__label">Nombre</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="nombre" id="nombre"
                                placeholder="John Doe">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">El nombre tiene que ser de 1 a 16 dígitos y solo puede
                            contener
                            letras y
                            espacios.
                        </p>
                    </div>

                    <div class="formulario__grupo" id="grupo__apellidoP">
                        <label for="apellidoP" class="formulario__label">Apellidos</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="apellidoP" id="apellidoP"
                                placeholder="López Garza">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">El apellido tiene que ser de 4 a 16 dígitos y solo puede
                            contener
                            letras.
                        </p>
                    </div>

                    <div class="formulario__grupo" id="grupo__rfc">
                        <label for="rfc" class="formulario__label">RFC</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="rfc" id="rfc" placeholder="ASDF1234">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">El RFC debe estar compuesto de 10 dígitos.
                        </p>
                    </div>

                    <div class="formulario__grupo" id="grupo__genero">
                        <label for="genero" class="formulario__label">Género</label>
                        <div class="formulario__grupo-input">
                            <select id="genero" name="genero" class="formulario__input">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_genero as $genero) { ?>
                                    <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>

                    <div class="formulario__grupo" id="grupo__email">
                        <div class="formulario__grupo-input">
                            <label for="email" class="formulario__label">Correo Electrónico</label>
                            <input type="email" class="formulario__input" name="email" id="email"
                                placeholder="example@algo.com">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos,
                            guiones y
                            guion
                            bajo.
                        </p>
                    </div>

                    <div class="formulario__grupo" id="grupo__telefono">
                        <div class="formulario__grupo-input">
                            <label for="telefono" class="formulario__label">Teléfono</label>
                            <input type="text" class="formulario__input" name="telefono" id="telefono"
                                placeholder="4491234567">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">El telefono solo puede contener numeros y el maximo son 14
                            dígitos.
                        </p>
                    </div>
                </div> <br>
                <!-- DATOS DOMICILIARIOS -->

                <h6 style="padding: 0 20px; font-weight: 700;" class="tema"> <i class="bi bi-pin-map-fill"></i>
                    Datos Domiciliarios </h6>
                <hr>
                <div class="section">
                    <div class="formulario__grupo" id="grupo__alcaldia">
                        <label for="alcaldia" class="formulario__label">Alcaldía</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="alcaldia" id="alcaldia"
                                placeholder="Dolores">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">La Alcaldía tiene que ser de 4 a 16 dígitos y solo puede
                            contener
                            letras
                            y
                            espacios.
                        </p>
                    </div>

                    <div class="formulario__grupo" id="grupo__codigo_postal">
                        <label for="codigo_postal" class="formulario__label">Código Postal</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="codigo_postal" id="codigo_postal"
                                placeholder="12345">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">El Código Postal debe ser de 5 números.
                        </p>
                    </div>

                    <div class="formulario__grupo" id="grupo__num_interior">
                        <label for="num_interior" class="formulario__label">Número Interior</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="num_interior" id="num_interior"
                                placeholder="1">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>

                    <div class="formulario__grupo" id="grupo__num_exterior">
                        <label for="num_exterior" class="formulario__label">Número Exterior</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="num_exterior" id="num_exterior"
                                placeholder="1">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>

                    <div class="formulario__grupo" id="grupo__calleUno">
                        <label for="calleUno" class="formulario__label">Entre Calle:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="calleUno" id="calleUno"
                                placeholder="Laureles">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>

                    <div class="formulario__grupo" id="grupo__calleDos">
                        <label for="calleDos" class="formulario__label">Y Calle:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="calleDos" id="calleDos"
                                placeholder="21 de marzo">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>

                    <div class="formulario__grupo" id="grupo__referencias">
                        <label for="referencias" class="formulario__label">Referencias</label>
                        <div class="formulario__grupo-input">
                            <textarea type="text" class="formulario__input" name="referencias"
                                id="referencias"> </textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div> <br>
                <!-- DOCUMENTOS -->

                <h6 style="padding: 0 20px; font-weight: 700;" class="tema"> <i
                        class="bi bi-file-earmark-arrow-up-fill"></i>
                    Documentos </h6>
                <hr>
                <div class="section">
                    <div class="formulario__grupo" id="grupo__comprobante_domicilio">
                        <label for="comprobante_domicilio" class="formulario__label">Comprobante de domicilio</label>
                        <div class="formulario__grupo-input">
                            <input type="file" class="formulario__input-file" name="comprobante_domicilio"
                                id="comprobante_domicilio" accept="application/pdf">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                    <div class="formulario__grupo" id="grupo__credencialFrente">
                        <label for="credencialFrente" class="formulario__label">(INE) Credencial parte superior</label>
                        <div class="formulario__grupo-input">
                            <input type="file" class="formulario__input-file" name="credencialFrente"
                                id="credencialFrente">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                    <div class="formulario__grupo" id="grupo__credencialAtras">
                        <label for="credencialAtras" class="formulario__label">(INE) Credencial parte inferior</label>
                        <div class="formulario__grupo-input">
                            <input type="file" class="formulario__input-file" name="credencialAtras"
                                id="credencialAtras">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <br>
                <!-- PERFIL -->
                <h6 style="padding: 0 20px; font-weight: 700;" class="tema"> <i class="bi bi-person-plus-fill"></i>
                    Crea tu Perfil </h6>
                <hr>
                <div class="section">
                    <div class="formulario__grupo">
                        <label for="foto" class="form-label">Sube una foto de perfil</label>
                        <div class="profile-picture">
                            <div class="picture-container" style="border: 2px solid black;">
                                <?php if (!empty($foto)) { ?>
                                    <img id="preview" src="<?php echo $foto; ?>">
                                <?php } else { ?>
                                    <img id="preview" src="../img/OXILIVE.ico">
                                <?php } ?>
                                <div class="overlay">
                                    <?php if (empty($foto)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker(event)">
                                            <i class="bi bi-camera"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="foto" id="foto" onchange="previewImage(this);"
                            style="display: none;">
                    </div>
                    <div class="formulario__grupo" id="grupo__usuario">
                        <label for="usuario" class="formulario__label">Usuario</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="usuario" id="usuario"
                                placeholder="john123">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede
                            contener
                            numeros,
                            letras y guion bajo.</p>
                    </div>

                    <!-- Grupo: Contraseña -->
                    <div class="formulario__grupo" id="grupo__password">
                        <label for="password" class="formulario__label">Contraseña</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="password" id="password">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">La contraseña tiene que ser de 8 a 12 dígitos incluyendo
                            mayúsculas,
                            nùmeros y símbolos.</p>
                    </div>

                    <!-- Grupo: Contraseña 2 -->
                    <div class="formulario__grupo" id="grupo__password2">
                        <label for="password2" class="formulario__label">Confirmar Contraseña</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="password2" id="password2">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <p class="formulario__input-error">Las contraseñas deben ser iguales.</p>
                    </div>
                </div> <br>
                <div class="formulario__mensaje" id="formulario__mensaje">
                    <p><i class="bi bi-exclamation-triangle-fill"></i> <b>Error:</b> Por favor rellena el formulario
                        correctamente.
                    </p>
                </div>
                <br>
                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button type="submit" class="formulario__btn">Enviar</button>
                    <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
                    </p>
                    <br>
                    <h6 style="text-align:center;">¿Ya tienes cuenta?<a href="../login.php"> Inicia Sesión </a>
                        <h6>
                </div>
            </form>

        </div>
    </section>
</body>
<script src="../assets/js/formulario.js"></script>
<script>
    function previewImage(input) {
        var preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.setAttribute('src', e.target.result);
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }

    function openFilePicker(event) {
        event.preventDefault();
        document.getElementById('foto').click();
    }

    function deletePhoto(event) {
        event.preventDefault();
        document.getElementById('preview').src = '../../img/png.png';
        document.getElementById('preview').style.display = 'none';
        document.getElementById('foto').value = '';
        var deleteLink = document.querySelector('.delete-link');
        deleteLink.style.display = 'none';
    }
</script>

</html>