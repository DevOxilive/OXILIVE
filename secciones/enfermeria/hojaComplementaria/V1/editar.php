<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../module/genero.php");
    include("../../../module/banco.php");
    include("../../../module/aseguradora.php");
    include("../../../module/administradora.php");
    include("pacientesUP.php");
} else {
    echo "Error en el sistema";
}
?>
<html>


<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css">
    <link href="../../../assets/css/enfermeriaCamara.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../assets/css/vali.css">
    <link rel="stylesheet" href="../../../assets/css/edit.css">

</html>

<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar datos del Paciente</h4>
            </div>

            <div class="card-body" style="border: 2px solid #BFE5FF">
                <form action="./pacientesUP.php" method="post" enctype="multipart/form-data" class="row g-3 formEdit">
                 
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                    </div>


                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__Nombres"> <br>
                            <label for="Nombres" class="formulario__label">Nombre</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $Nombres; ?>" class="form-control" name="Nombres" id="Nombres" aria-describedby="helpId" placeholder="Nombres" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__Apellidos"> <br>
                            <label for="Apellidos" class="formulario__label">Apellidos</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $Apellidos; ?>" class="form-control" name="Apellidos" id="Apellidos" aria-describedby="helpId" placeholder="Apellidos" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__rfc"> <br>
                            <label for="rfc" class="formulario__label">RFC</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $rfc; ?>" class="form-control" name="rfc" id="rfc" aria-describedby="helpId" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2"> <br>
                        <label for="Edad" class="formulario__label">Género</label>
                        <select id="genero" name="genero" class="form-select">
                            <?php foreach ($lista_genero as $registro) { ?>
                                <option <?php echo ($genero == $registro['id_genero']) ? "selected" : ""; ?> value="<?php echo $registro['id_genero']; ?>">
                                    <?php echo $registro['genero']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__Edad"> <br>
                            <label for="Edad" class="formulario__label">Edad</label>
                            <div class="formulario__grupo-input">
                            <input type="number" value="<?php echo $Edad; ?>" class="form-control" name="Edad" id="Edad" aria-describedby="helpId" placeholder="Edad" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__calle"> <br>
                            <label for="calle" class="formulario__label">Calle</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $calle; ?>" class="form-control" name="calle" id="calle" aria-describedby="helpId" placeholder="Direccion" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__num_in"> <br>
                            <label for="num_in" class="formulario__label">Núm. Interior</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $num_in; ?>" class="form-control" name="num_in" id="num_in" aria-describedby="helpId" placeholder="Direccion" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__num_ext"> <br>
                            <label for="num_ext" class="formulario__label">Núm. Ext</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $num_ext; ?>" class="form-control" name="num_ext" id="num_ext" aria-describedby="helpId" placeholder="Direccion" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__colonia"> <br>
                            <label for="colonia" class="formulario__label">Colonia</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $colonia; ?>" class="form-control" name="colonia" id="colonia" aria-describedby="helpId" placeholder="Direccion" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__cp"> <br>
                            <label for="cp" class="formulario__label">Código Postal</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $cp; ?>" class="form-control" name="cp" id="cp" aria-describedby="helpId" placeholder="Direccion" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__municipio"> <br>
                            <label for="municipio" class="formulario__label">Municipio</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $municipio; ?>" class="form-control" name="municipio" id="municipio" aria-describedby="helpId" placeholder="Direccion" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__estado_direccion"> <br>
                            <label for="estado_direccion" class="formulario__label">Estado:</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $estado_direccion; ?>" class="form-control" name="estado_direccion" id="estado_direccion" aria-describedby="helpId" placeholder="Direccion" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__Alcaldia"> <br>
                            <label for="Alcaldia" class="formulario__label">Alcaldia</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $Alcaldia; ?>" class="form-control" name="Alcaldia" id="Alcaldia" aria-describedby="helpId" placeholder="Alcaldia" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__referencias">
                            <label for="referencias" class="formulario__label">Referencias</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $referencias; ?>" class="form-control" name="referencias" id="referencias" aria-describedby="helpId" placeholder="referencias" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__Telefono">
                            <label for="Telefono" class="formulario__label">Teléfono</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $Telefono; ?>" class="form-control" name="Telefono" id="Telefono " aria-describedby="helpId" placeholder="Telefono" required>

                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="Administradora" class="formulario__label">Administradora</label>
                        <select id="Administradora" name="Administradora" class="form-select">
                            <?php foreach ($lista_administradora as $registro) { ?>
                                <option <?php echo ($Administradora == $registro['id_administradora']) ? "selected" : ""; ?> value="<?php echo $registro['id_administradora']; ?>">
                                    <?php echo $registro['Nombre_administradora']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="Aseguradora" class="formulario__label">Aseguradora</label>
                        <div id="div">
                            <select id="Aseguradora" name="Aseguradora" class="form-select">
                            <?php foreach ($lista_ase as $registro) { ?>
                                <option <?php echo ($Aseguradora == $registro['id_aseguradora']) ? "selected" : ""; ?> value="<?php echo $registro['id_aseguradora']; ?>">
                                    <?php echo $registro['Nombre_aseguradora']; ?>
                                </option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                    <label for="banco" class="form-label">Banco</label>
                        <select id="banco" name="banco" class="form-select">
                        <?php foreach ($lista_bancos as $ban) { ?>
                            <option value="<?php echo $ban['id_bancos']; ?>"><?php echo $ban['Nombre_banco']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__No_nomina">
                            <label for="No_nomina" class="formulario__label">No. nomina</label>
                            <div class="formulario__grupo-input">
                            <input type="text" value="<?php echo $Nomina; ?>" class="form-control" name="Nomina" id="Nomina " aria-describedby="helpId" placeholder="Nomina" required>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <p class="formulario__input-error">La nomina no es valida, solo se aceptan letras y numeros
                            </p>
                        </div>
                    </div>
                    <div class="contenido col-md-5">
                        <div class="formulario__grupo" id="grupo__responsable">
                           
                        </div>
                    </div>
                    <!--Aqui vamos a probar-->
                    <div class="col-md-5">
                        <!-- Contenido centrado -->
                        <p style="color:black"><strong>Comprobante de domicilio</strong></p>
                        <!-- Etiqueta <input> con icono -->
                        <div class="input-group">
                            <div class="custom-file">
                                 <input type="file" value="<?php echo $comprobante; ?>" class="form-control" name="comprobante" id="comprobante">
                                <label class="custom-file-label" for="comprobante">Selecciona un archivo</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                            </div>
                        </div>
                    </div>

                    <!--Aqui termina-->

                    <br><br><br><br><br>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="Credencial_front" class="formulario__label">Credencial INE Frontal</label>
                            <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_front)) : ?>
                                    <img src="../../PAPELETA/<?php echo $Apellidos . " " . $Nombres ?>/<?php echo $Credencial_front; ?>" alt="" id="imagenActual" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php else : ?>
                                    <img src="../../img/OXILIVE.ico" alt="foto de perfil" id="imagenActual" class="img-thumbnail-ine">
                                <?php endif; ?>
                                <div class="overlay-cre">
                                    <label for="Credencial_front" class="change-link"><i class="fas fa-camera"></i>
                                    </label>
                                    <?php if (!empty($Credencial_front)) : ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            </div>
                            <input type="file" class="form-control" name="Credencial_front" id="Credencial_front" onchange="cambiarImagen(event)" style="display: none;">
                        </div>
                        <div class="col-md-4">
                            <label for="Credencial_post" class="formulario__label" >(INE) Credencial INE Posterior</label>
                            <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_post)) : ?>
                                    <img src="../../PAPELETA/<?php echo $Apellidos . " " . $Nombres ?>/<?php echo $Credencial_post; ?>" alt="" id="imagenActual1" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php else : ?>
                                    <img src="../../img/OXILIVE.ico" alt="foto de perfil" id="imagenActual1" class="img-thumbnail-ine">
                                <?php endif; ?>
                                <div class="overlay-cre">
                                    <label for="Credencial_post" class="change-link"><i class="fas fa-camera"></i>
                                    </label>
                                    <?php if (!empty($Credencial_post)) : ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            </div>
                            <input type="file" class="form-control" name="Credencial_post" id="Credencial_post" onchange="cambiarImagen1(event)" style="display: none;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradora" class="formulario__label">Credencial Aseguradora
                            Frontal</label>
                        <div class="profile-picture-cre">
                        <div class="picture-container-cre">
                                <?php if (!empty($Credencial_aseguradora)) : ?>
                                    <img src="../PAPELETA/<?php echo $Apellidos . " " . $Nombres ?>/<?php echo $Credencial_aseguradora; ?>" alt="" id="imagenActual2" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php else : ?>
                                    <img src="../../../img/OXILIVE.ico" alt="SIN ASEGURADORA" id="imagenActual2" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php endif; ?>
                                <div class="overlay-cre">
                                    <label for="Credencial_aseguradora" class="change-link"><i class="fas fa-camera"></i>
                                    </label>
                                    <?php if (!empty($Credencial_aseguradora)) : ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradora" id="Credencial_aseguradora" onchange="cambiarImagen2(event)" style="display: none;">
                    </div>
                    <div class="contenido col-md-1">
                        <label></label>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradoras_post" class="formulario__label">Credencial Aseguradora
                            Posterior</label>
                        <div class="profile-picture-cre">
                        <div class="picture-container-cre">
                                <?php if (!empty($Credencial_aseguradoras_post)) : ?>
                                    <img src="../PAPELETA/<?php echo $Apellidos . " " . $Nombres ?>/<?php echo $Credencial_aseguradoras_post; ?>" alt="" id="imagenActual3" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php else : ?>
                                    <img src="../../../img/OXILIVE.ico" alt="SIN ASEGURADORA" id="imagenActual3" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php endif; ?>
                                <div class="overlay-cre">
                                    <label for="Credencial_aseguradoras_post" class="change-link"><i class="fas fa-camera"></i>
                                    </label>
                                    <?php if (!empty($Credencial_aseguradoras_post)) : ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradoras_post" id="Credencial_aseguradoras_post" onchange="cambiarImagen3(event)" style="display: none;">
                    </div>
                    <div class="contenido col-md-9" style="text-align: center;">
                        <div class="formulario__mensaj" id="formulario__mensaj">
                            <p><i class="bi bi-stickies-fill"></i> <b>Nota:</b> Agrega las credenciales de Aseguradora
                            </p>
                        </div>
                    </div>
                    <br>
                    <!--Row boton de descargar imagen-->
                    <div class="col-10 ">
                        <div class="row justify-content-center formulario__grupo formulario__grupo-btn-enviar">
                            <div class="col-md-auto ">
                                <button type="submit" class="formulario__btn btn btn-outline-primary">Enviar</button>
                            </div>
                            <div class="col-md-auto ">
                                <a role="button" onclick="confirmCancel(event)" name="cancelar"
                                    class="btn btn-outline-danger">Cancelar</a>
                            </div>
                            <div class="col-md-auto ">
                                    <a href="camara.php" target="_blank" class="btn btn-outline-success">
                                        <i class="fa fa-camera"></i></a>
                                </div>
                        </div>
                        </form>
            </div>
        </div>
</main>
</div>
<script src="../../../assets/js/scriptCamaWeb.js"></script>
<script src="../../../assets/js/archivosPacientes.js"></script>
<script src="../../../assets/js/nomina.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
<!--Aqui termina mi escript de la ventana emergente-->
<script>
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
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/hojaComplementaria/index.php";
        }
    });
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.formLogin').addEventListener('submit', function(event) {
        event.preventDefault();

        // Verifica si los campos obligatorios están vacíos
        var Nombres = document.getElementById('Nombres').value;
        var Apellidos = document.getElementById('Apellidos').value;
        var Direccion = document.getElementById('Direccion').value;
        var No_nomina = document.getElementById('No_nomina').value;
        var Credencial_front = document.getElementById('Credencial_front').value;

        if (!Nombres || !Apellidos || !Direccion || !No_nomina || !Credencial_front) {
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