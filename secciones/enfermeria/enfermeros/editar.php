<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../secciones/puestos/consulta.php");
    include("../../../secciones/usuarios/consulta.php");
    include("../../../module/genero.php");
    include("../../../module/estado.php");
    include("enfermeroUP.php");
} else {
    echo "Error en el sistema";
}
?>
<html lang="en">
<link rel="stylesheet" href="../../../assets/css/foto_editar.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar datos de Usuario</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;"> <br>
                <form action="enfermeroUP.php" method="POST" enctype="multipart/form-data" class="formEdit row g-3">
                    <div class="contenido col-md-3">
                    <label for="Foto_perfil" class="form-label">Foto de perfil</label> <br>
                        <div class="profile-picture">
                            <div class="picture-container">
                                <?php if (!empty($Foto_perfil)){ ?>
                                    <img src="../../../secciones/usuarios/OXILIVE/<?php echo $apellidos . " " .$nombres ?>/<?php echo $Foto_perfil; ?>" alt="" id="imagenActual"
                                        class="img-thumbnail rounded-circle">
                                <?php }else{ ?>
                                    <img src="../../../img/png.png" alt="Foto de perfil" id="imagenActual"
                                        class="img-thumbnail">
                                <?php } ?>
                                <div class="overlay">
                                    <?php if (!empty($Foto_perfil)){ ?>    
                                    <label for="Foto_perfil" class="change-link"><i class="fas fa-camera"></i> </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Foto_perfil" id="Foto_perfil" onchange="cambiarImagen(event)"
                            style="display: none;">
                    </div>
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                            id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="contenido col-md-3"><br>
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" value="<?php echo $nombres; ?>" class="form-control" name="nombres"
                            id="nombres" placeholder="Ingrese el nombre" required>
                    </div>

                    <div class="contenido col-md-3"><br>
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" value="<?php echo $apellidos; ?>" class="form-control" name="apellidos"
                            id="apellidos" placeholder="Apellidos" required>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="genero" class="form-label">Género</label>
                        <select id="genero" name="genero" class="form-select">
                            <?php foreach ($lista_genero as $registro) { ?>
                                <option <?php echo ($genero == $registro['id_genero']) ? "selected" : ""; ?>
                                    value="<?php echo $registro['id_genero']; ?>">
                                    <?php echo $registro['genero']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" value="<?php echo $rfc; ?>" class="form-control" name="rfc" id="rfc"
                            placeholder="rfc" required>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario"
                            id="usuario" placeholder="Usuario" required>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" value="<?php echo $password; ?>" class="form-control" name="password"
                            id="password" placeholder="********" required>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select id="departamento" name="departamento" class="form-select">
                            <?php foreach ($lista_puestos as $registro) { ?>
                                <option <?php echo ($departamento == $registro['id_puestos']) ? "selected" : ""; ?>
                                    value="<?php echo $registro['id_puestos']; ?>">
                                    <?php echo $registro['Nombre_puestos']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-2">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="Phone" value="<?php echo $telefono; ?>" class="form-control" name="telefono"
                            id="telefono" placeholder="Telefono de 10 digito">
                    </div>

                    <div class="contenido col-md-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" value="<?php echo $email; ?>" class="form-control" name="email" id="email"
                            placeholder="Ingrese el correo institusional ">
                    </div>

                    <div class="contenido col-md-2">
                        <label for="status" class="form-label">Estado</label>
                        <select id="status" name="status" class="form-select">
                            <?php foreach ($lista_estado as $registro) { ?>
                                <option <?php echo ($status == $registro['id_estado']) ? "selected" : ""; ?>
                                    value="<?php echo $registro['id_estado']; ?>">
                                    <?php echo $registro['Nombre_estado']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-2">
                        <label for="alcaldia" class="form-label">Alcaldia</label>
                        <input type="text" value="<?php echo $alcaldia; ?>" class="form-control" name="alcaldia"
                            id="alcaldia" placeholder="alcaldia" required>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="calle" class="form-label">Calle:</label></label>
                        <input type="text" value="<?php echo $calle; ?>" class="form-control" name="calle"
                            id="calle" placeholder="Calle" required>
                    </div>

                    <div class="contenido col-md-2">
                        <label for="num_interior" class="form-label">Numero Interior</label>
                        <input type="text" value="<?php echo $num_interior; ?>" class="form-control" name="num_interior"
                            id="num_interior" placeholder="num_interior" required>
                    </div>

                    <div class="contenido col-md-2">
                        <label for="num_exterior" class="form-label">Numero Exterior</label>
                        <input type="text" value="<?php echo $num_exterior; ?>" class="form-control" name="num_exterior"
                            id="num_exterior" placeholder="num_exterior" required>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="codigo_postal" class="form-label">Codigo Postal</label>
                        <input type="text" value="<?php echo $codigo_postal; ?>" class="form-control"
                            name="codigo_postal" id="codigo_postal" placeholder="codigo_postal" required>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="calleUno" class="form-label">Entre Calle:</label></label>
                        <input type="text" value="<?php echo $calleUno; ?>" class="form-control" name="calleUno"
                            id="calleUno" placeholder="calleUno" required>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="calleDos" class="form-label">Y calle:</label>
                        <input type="text" value="<?php echo $calleDos; ?>" class="form-control" name="calleDos"
                            id="calleDos" placeholder="calleDos" required>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="referencias" class="form-label">Referencias</label>
                        <input type="text" value="<?php echo $referencias; ?>" class="form-control" name="referencias"
                            id="referencias" placeholder="referencias" required>
                    </div>

                    <div class="col-md-3">
                        <label for="comprobante_domicilio" class="form-label">Comprobante de domicilio</label>
                        <?php echo $comprobante_domicilio; ?>
                        <input type="file" value="<?php echo $comprobante_domicilio; ?>" class="form-control" name="comprobante_domicilio" id="comprobante_domicilio">
                    </div>

                    <div class="col-md-4">
                        <label for="credencialFrente" class="form-label">(INE) Credencial parte superior </label>
                        <br>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($credencialFrente)): ?>
                                    <img src="./OXILIVE/<?php echo $apellidos . " " . $nombres?>/<?php echo $credencialFrente; ?>"
                                        alt="" id="imagenActual1" class="img-thumbnail-ine"
                                        style="width: 350px ; height: 210px;">
                                <?php else: ?>
                                    <img src="../../img/OXILIVE.ico" alt="foto de perfil" id="imagenActual1"
                                        class="img-thumbnail-ine">
                                <?php endif; ?>
                                <div class="overlay-cre">
                                    <label for="credencialFrente" class="change-link"><i class="fas fa-camera"></i>
                                    </label>
                                    <?php if (!empty($credencialFrente)): ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="credencialFrente" id="credencialFrente"
                            onchange="cambiarImagen1(event)" style="display: none;">
                    </div>



                    <div class="col-md-4">
                        <label for="credencialAtras" class="form-label">(INE) Credencial parte inferior </label>
                        <br>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($credencialAtras)): ?>
                                    <img src="./OXILIVE/<?php echo $apellidos . " " . $nombres?>/<?php echo $credencialAtras; ?>"
                                        alt="" id="imagenActual2" class="img-thumbnail-ine"
                                        style="width: 350px ; height: 210px;">
                                <?php else: ?>
                                    <img src="../../img/OXILIVE.ico" alt="foto de perfil" id="imagenActual2"
                                        class="img-thumbnail-ine">
                                <?php endif; ?>
                                <div class="overlay-cre">
                                    <label for="credencialAtras" class="change-link"><i class="fas fa-camera"></i>
                                    </label>
                                    <?php if (!empty($credencialAtras)): ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="credencialAtras" id="credencialAtras"
                            onchange="cambiarImagen2(event)" style="display: none;">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar"
                            class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main>
<script>
    function mostrarImagen(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imagenActual = document.getElementById("imagenActual");
                imagenActual.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function abrirSelectorArchivo(event) {
        event.preventDefault();
        var selectorArchivo = document.getElementById("Foto_perfil");
        selectorArchivo.click();
    }

    function cambiarImagen(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imagenActual = document.getElementById("imagenActual");
                imagenActual.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eliminarImagen(event) {
        event.preventDefault();
        var imagenActual = document.getElementById("imagenActual");
        imagenActual.src = "./img/error.png";
        var selectorArchivo = document.getElementById("Foto_perfil");
        selectorArchivo.value = null;
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.formEdit').addEventListener('submit', function (e) {
            e.preventDefault(); // Evitar el envío automático del formulario

            Swal.fire({
                title: 'Datos Guardados',
                text: 'Los datos han sido guardados correctamente.',
                icon: 'success',
            }).then(() => {
                e.target.submit();
            });
        });
    });
//

    //    INE1
    function mostrarImagen1(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imagenActual1 = document.getElementById("imagenActual1");
                imagenActual1.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function abrirSelectorArchivo1(event) {
        event.preventDefault();
        var selectorArchivo1 = document.getElementById("credencialFrente");
        selectorArchivo1.click();
    }

    function cambiarImagen1(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imagenActual1 = document.getElementById("imagenActual1");
                imagenActual1.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eliminarImagen1(event) {
        event.preventDefault();
        var imagenActual1 = document.getElementById("imagenActual1");
        imagenActual1.src = "./img/error.png";
        var selectorArchivo1 = document.getElementById("credencialFrente");
        selectorArchivo1.value = null;
    }

    //    INE2
    function mostrarImagen2(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imagenActual2 = document.getElementById("imagenActual2");
                imagenActual2.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function abrirSelectorArchivo2(event) {
        event.preventDefault();
        var selectorArchivo2 = document.getElementById("credencialAtras");
        selectorArchivo2.click();
    }

    function cambiarImagen2(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imagenActual2 = document.getElementById("imagenActual2");
                imagenActual2.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eliminarImagen2(event) {
        event.preventDefault();
        var imagenActual2 = document.getElementById("imagenActual2");
        imagenActual2.src = "./img/error.png";
        var selectorArchivo2 = document.getElementById("credencialAtras");
        selectorArchivo2.value = null;
    }

    function mostrarAlertaCancelar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Los cambios no se guardarán',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireccionar a la página de inicio o realizar alguna acción adicional
                window.location.href = '<?php echo $url_base; ?>secciones/enfermeria/enfermeros/index.php';
            }
        })
    }
</script>
<?php
include("../../../templates/footer.php");
?> 