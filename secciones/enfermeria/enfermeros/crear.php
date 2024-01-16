<?php

session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../model/genero.php");
    include("../../../model/estado.php");
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
                <form action="enfermeroADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3">
                    <h1>Datos Generales</h1>
                    <div class="col-md-3">
                        <label for="Foto_perfil" class="form-label">Sube una foto de perfil</label>
                        <div class="profile-picture">
                            <div class="picture-container">
                                <?php if (!empty($Foto_perfil)) { ?>
                                    <img id="preview" src="<?php echo $Foto_perfil; ?>">
                                <?php } else { ?>
                                    <img id="preview" src="<?php echo $url_base; ?>img/usuario.png">
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
                    <div class="contenido col-md-4 align-self-center">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese el nombre">
                    </div>

                    <div class="contenido col-md-4 align-self-center">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
                    </div>
                    <div class="contenido col-md-6">
                        <label for="genero" class="form-label">Género</label>

                        <select id="genero" name="genero" class="form-select">
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="contenido col-md-6">
                        <label for="usuario" class="form-label">RFC</label>
                        <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC">
                    </div>
                    <hr>
                    <h1>Datos de acceso al sistema</h1>
                    <div class="contenido col-md-6">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                    </div>
                    <div class="contenido col-md-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="********">
                    </div>

                    <div class="contenido col-md-4">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select id="departamento" name="departamento" class="form-select">
                            <option value="6">
                                Enfermeria
                            </option>
                        </select>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="Phone" class="form-control" name="telefono" id="telefono" placeholder="Telefono de 10 digitos">
                    </div>

                    <div class="contenido col-md-4">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese el correo ">
                    </div>
                    <hr>
                    <h1>Documentos personales</h1>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <label for="comprobante_domicilio" class="form-label">Comprobante de domicilio</label>
                            <input type="file" value="" class="form-control" name="comprobante_domicilio" id="comprobante_domicilio">
                        </div>

                    </div>
                    <div class="col-md-5">
                        <label for="credencialFrente" class="form-label">Credencial de elector (Anverso) </label>
                        <br>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($credencialFrente)) { ?>
                                    <img src="../../usuarios/OXILIVE/<?php echo $apellidos . " " . $nombres ?>/<?php echo $credencialFrente; ?>" alt="" id="imagenActual1" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php } else { ?>
                                    <img src="../../../img/anverso.jpg" alt="foto de perfil" id="imagenActual1" class="img-thumbnail-ine">
                                <?php } ?>
                                <div class="overlay-cre">
                                    <?php if (empty($credencialFrente)) { ?>
                                        <label for="credencialFrente" class="change-link"><i class="fas fa-camera"></i>
                                        </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="credencialFrente" id="credencialFrente" onchange="cambiarImagen1(event)" style="display: none;">
                    </div>

                    <div class="col-md-5">
                        <label for="credencialAtras" class="form-label">Credencial de elector (Reverso) </label>
                        <br>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($credencialAtras)) { ?>
                                    <img src="../../usuarios/OXILIVE/<?php echo $apellidos . " " . $nombres ?>/<?php echo $credencialAtras; ?>" alt="" id="imagenActual2" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php } else { ?>
                                    <img src="../../../img/reverso.jpg" alt="foto de perfil" id="imagenActual2" class="img-thumbnail-ine">
                                <?php } ?>
                                <div class="overlay-cre">
                                    <?php if (empty($credencialAtras)) { ?>
                                        <label for="credencialAtras" class="change-link"><i class="fas fa-camera"></i>
                                        </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="credencialAtras" id="credencialAtras" onchange="cambiarImagen2(event)" style="display: none;">
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
<script src="../../../assets/js/forms_validations.js"></script>
<?php
include("../../../templates/footer.php");
?>