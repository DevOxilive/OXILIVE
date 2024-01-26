<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../model/genero.php");
    include("../../../model/administradora.php");
    include("../../../model/banco.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/foto_perfil.css">
<link rel="stylesheet" href="../../../assets/css/vali.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo Paciente</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF">
                <form action="./pacientesADD.php" method="post" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__Nombres"> <br>
                            <label for="Nombres" class="form-label">Nombre</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Nombres" id="Nombres" placeholder="Ingresa el nombre completo">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__Apellidos"> <br>
                            <label for="Apellidos" class="form-label">Apellidos</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Apellidos" id="Apellidos" placeholder="Ingresa los Apellidos">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__rfc"> <br>
                            <label for="rfc" class="form-label">RFC</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="rfc" id="rfc" placeholder="Ejem: EJEM123456">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2"> <br>
                        <label for="Edad" class="form-label">Género</label>
                        <select id="Genero" name="Genero" class="form-select">
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__Edad"> <br>
                            <label for="Edad" class="form-label">Edad</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Edad" id="Edad" placeholder="Edad">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__calle"> <br>
                            <label for="calle" class="form-label">Calle</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="calle" id="calle" placeholder="Ejem: Calle">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__num_in"> <br>
                            <label for="num_in" class="form-label">Núm. Interior</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="num_in" id="num_in" placeholder="Ejem: 2">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__num_ext"> <br>
                            <label for="num_ext" class="form-label">Núm. Ext</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="num_ext" id="num_ext" placeholder="Ejem: 3">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__colonia"> <br>
                            <label for="colonia" class="form-label">Colonia</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="colonia" id="colonia" placeholder="Ejem: Colonia">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__cp"> <br>
                            <label for="cp" class="form-label">Código Postal</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="cp" id="cp" placeholder="Ejem: 12345">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__municipio"> <br>
                            <label for="municipio" class="form-label">Municipio</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Ejem: Municipio">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__estado_direccion"> <br>
                            <label for="estado_direccion" class="form-label">Estado:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="estado_direccion" id="estado_direccion" placeholder="Ejem: CDMX">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__Alcaldia"> <br>
                            <label for="Alcaldia" class="form-label">Alcaldia</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Alcaldia" id="Alcaldia" placeholder="Alcaldia">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__referencias">
                            <label for="referencias" class="form-label">Referencias</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="referencias" id="referencias" placeholder="Referencias">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__Telefono">
                            <label for="Telefono" class="form-label">Teléfono</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Telefono" id="Telefono" placeholder="Teléfono">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="Administradora" class="form-label">Administradora</label>
                        <select id="Administradora" name="Administradora" class="form-select" onchange="actualizarAseguradoras(this.value)">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($lista_administradora as $admin) { ?>
                                <option value="<?php echo $admin['id_administradora']; ?>">
                                    <?php echo $admin['Nombre_administradora']; ?>
                                </option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="Aseguradora" class="form-label">Aseguradora</label>
                        <div id="div">
                            <select id="Aseguradora" name="Aseguradora" class="form-select">
                                <option value="0" selected disabled>Elija una opción</option>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="Banco" class="form-label">Banco</label>
                        <select id="Banco" name="Banco" class="form-select">
                            <?php foreach ($lista_bancos as $ban) { ?>
                                <option value="<?php echo $ban['id_bancos']; ?>"><?php echo $ban['Nombre_banco']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__No_nomina">
                            <label for="No_nomina" class="form-label">No. nomina</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="No_nomina" id="No_nomina" placeholder="No_nomina">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <p class="formulario__input-error">La nomina no es valida, solo se aceptan letras y numeros
                            </p>
                        </div>
                    </div>
                    <div class="contenido col-md-5">
                        <div class="formulario__grupo" id="grupo__responsable">
                            <label for="responsable" class="form-label">Nombre del responsable</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="responsable" id="responsable" placeholder="Ejem: Otra persona">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="comprobante" class="form-label">Comprobante de domicilio</label>
                        <input type="file" class="formulario__input-file" name="comprobante" id="comprobante" accept="application/pdf">
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_front" class="form-label">Credencial INE Frontal</label>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_front)) { ?>
                                    <img id="preview" src="<?php echo $Credencial_front; ?>">
                                <?php } else { ?>
                                    <img id="preview" src="../../../img/post.jpg" style="width: 350px ; height: 210px;">
                                <?php } ?>
                                <div class="overlay-cre">
                                    <?php if (empty($Credencial_front)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker(event)">
                                            <i class="fa fa-camera"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_front" id="Credencial_front" onchange="previewImage(this);" style="display: none;" accept="application/jpg">
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_post" class="form-label">Credencial INE Posterior</label>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_post)) { ?>
                                    <img id="preview1" src="<?php echo $Credencial_post; ?>">
                                <?php } else { ?>
                                    <img id="preview1" src="../../../img/reverso.jpg" style="width: 350px ; height: 210px;">
                                <?php } ?>
                                <div class="overlay-cre">
                                    <?php if (empty($Credencial_post)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker1(event)">
                                            <i class="fa fa-camera"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto1(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_post" id="Credencial_post" onchange="previewImage1(this);" style="display: none;" accept="application/jpg">
                    </div>

                    <div class="contenido col-md-9">
                        <div class="formulario__mensaj" id="formulario__mensaj">
                            <p><i class="bi bi-stickies-fill"></i> <b>Nota:</b> Agrega las credenciales de Aseguradora
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradora" class="form-label">Credencial Aseguradora
                            Frontal</label>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_aseguradora)) { ?>
                                    <img id="preview2" src="<?php echo $Credencial_aseguradora; ?>">
                                <?php } else { ?>
                                    <img id="preview2" src="../../../img/post.jpg" style="width: 350px ; height: 210px;">
                                <?php } ?>
                                <div class="overlay-cre">
                                    <?php if (empty($Credencial_aseguradora)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker2(event)">
                                            <i class="fa fa-camera"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto2(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradora" id="Credencial_aseguradora" onchange="previewImage2(this);" style="display: none;" accept="application/jpg">
                    </div>
                    <div class="contenido col-md-1">
                        <label></label>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradoras_post" class="form-label">Credencial Aseguradora
                            Posterior</label>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_aseguradoras_post)) { ?>
                                    <img id="preview3" src="<?php echo $Credencial_aseguradoras_post; ?>">
                                <?php } else { ?>
                                    <img id="preview3" src="../../../img/reverso.jpg" style="width: 350px ; height: 210px;">
                                <?php } ?>
                                <div class="overlay-cre">
                                    <?php if (empty($Credencial_aseguradoras_post)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker3(event)">
                                            <i class="fa fa-camera"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto3(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradoras_post" id="Credencial_aseguradoras_post" onchange="previewImage3(this);" style="display: none;" accept="application/jpg">
                    </div>

                    <br>
                    <div class="col-12">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="formulario__btn btn btn-outline-primary">Enviar</button>
                            <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                                Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</main>
<script src="../../../assets/js/archivosPacientes.js"></script>
<script src="../../../assets/js/nomina.js"></script>
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
                window.location.href = "<?php echo $url_base; ?>secciones/Padministradora/pacientes/index.php";
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