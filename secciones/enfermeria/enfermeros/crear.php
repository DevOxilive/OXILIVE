<?php

session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../module/genero.php");
    include("../../../module/estado.php");
} else {
    echo "Error en el sistema";
}

?>
<!DOCTYPE html>
<link rel="stylesheet" href="../../../assets/css/foto_perfil.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">
</head>

</html>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Registro de nuevo enfermero(a)
                </h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./usuariosADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3">
                    <div class="col-md-2">
                        <label for="Foto_perfil" class="form-label">Sube una foto de perfil</label>
                        <div class="profile-picture">
                            <div class="picture-container">
                                <?php if (!empty($Foto_perfil)) { ?>
                                    <img id="preview" src="<?php echo $Foto_perfil; ?>">
                                <?php } else { ?>
                                    <img id="preview" src="../../../img/png.png">
                                <?php } ?>
                                <div class="overlay">
                                    <?php if (empty($Foto_perfil)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker(event)">
                                            <i class="fa fa-camera"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Foto_perfil" id="Foto_perfil" onchange="previewImage(this);" style="display: none;">
                    </div>
                    <div class="contenido col-md-3"> <br>
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese el nombre">
                    </div>

                    <div class="contenido col-md-3"> <br>
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
                    </div>

                    <div class="contenido col-md-2"> <br>
                        <label for="genero" class="form-label">Género</label>

                        <select id="genero" name="genero" class="form-select">
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="contenido col-md-2"> <br>
                        <label for="usuario" class="form-label">RFC</label>
                        <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC">
                    </div>

                    <div class="contenido col-md-2">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                    </div>
                    <div class="contenido col-md-2">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="********">
                    </div>

                    <div class="contenido col-md-2">
                        <label for="departamento" class="form-label">Departamento</label>

                        <select id="departamento" name="departamento" class="form-select">
                            <option value="6">
                                Enfermeria
                            </option>
                        </select>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="Phone" class="form-control" name="telefono" id="telefono" placeholder="Telefono de 10 digitos">
                    </div>

                    <div class="contenido col-md-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese el correo ">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="alcaldia" class="form-label">Alcaldía</label>
                        <input type="text" class="form-control" name="alcaldia" id="alcaldia" placeholder="Dolores">
                    </div>

                    <div class="contenido col-md-2">
                        <label for="codigo_postal" class="form-label">Código Postal</label>
                        <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" placeholder="12345">
                    </div>

                    <div class="contenido col-md-2">
                        <label for="num_interior" class="form-label">Número Interior</label>
                        <input type="text" class="form-control" name="num_interior" id="num_interior">
                    </div>

                    <div class="contenido col-md-2">
                        <label for="num_exterior" class="form-label">Número Exterior</label>
                        <input type="text" class="form-control" name="num_exterior" id="num_exterior">
                    </div>

                    <div class="contenido col-md-3">
                        <label for="calleUno" class="form-label">Entre Calle:</label>
                        <input type="text" class="form-control" name="calleUno" id="calleUno" placeholder="Laureles">
                    </div>

                    <div class="contenido col-md-3">
                        <label for="referencias" class="form-label">Y Calle:</label>
                        <input type="text" class="form-control" name="calleDos" id="calleDos" placeholder="Rojo Gomez">
                    </div>
                    <div class="contenido col-md-6">
                        <label for="referencias" class="form-label">Referencias</label>
                        <input type="text" class="form-control" name="referencias" id="referencias" placeholder="Ejem. Frente a tiendita">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="referencias" class="form-label">Comprobante de domicilio</label>
                        <input type="file" class="formulario__input-file" name="comprobante_domicilio" id="comprobante_domicilio">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="credencialFrente" class="form-label">(INE) Credencial parte superior</label>
                        <input type="file" class="formulario__input-file" name="credencialFrente" id="credencialFrente">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="credencialAtras" class="form-label">(INE) Credencial parte inferior</label>
                        <input type="file" class="formulario__input-file" name="credencialAtras" id="credencialAtras">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main>
<script>
    function previewImage(input) {
        var preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
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
        document.getElementById('Foto_perfil').click();
    }

    function deletePhoto(event) {
        event.preventDefault();
        document.getElementById('preview').src = '../../img/png.png';
        document.getElementById('preview').style.display = 'none';
        document.getElementById('Foto_perfil').value = '';
        var deleteLink = document.querySelector('.delete-link');
        deleteLink.style.display = 'none';
    }


    function confirmCancel(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Si cancelas, se perderán los datos ingresados.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
                window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/enfermeros/index.php";
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            // Evita el envío del formulario por defecto
            event.preventDefault();

            // Verifica si los campos obligatorios están vacíos
            var nombres = document.getElementById('nombres').value;
            var apellidos = document.getElementById('apellidos').value;
            var rfc = document.getElementById('rfc').value;
            var usuario = document.getElementById('usuario').value;
            var password = document.getElementById('password').value;
            var email = document.getElementById('email').value;

            if (!nombres || !apellidos || !rfc || !usuario || !password || !email) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos obligatorios.',
                });
            } else {
                this.submit();
            }
        });
    });
</script>
<?php
include("../../../templates/footer.php");
?>