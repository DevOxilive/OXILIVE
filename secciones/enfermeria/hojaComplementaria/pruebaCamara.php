<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../module/genero.php");
    include("../../../module/administradora.php");
    include("../../../module/banco.php");
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
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo Paciente</h4>
            </div>

            <div class="card-body" style="border: 2px solid #BFE5FF">
                <form action="./pacientesADD.php" method="post" enctype="multipart/form-data" class="formLogin row g-3"
                    id="formulario">
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__Nombres"> <br>
                            <label for="Nombres" class="formulario__label">Nombre</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Nombres" id="Nombres"
                                    placeholder="Ingresa el nombre completo">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__Apellidos"> <br>
                            <label for="Apellidos" class="formulario__label">Apellidos</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Apellidos" id="Apellidos"
                                    placeholder="Ingresa los Apellidos">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__rfc"> <br>
                            <label for="rfc" class="formulario__label">RFC</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="rfc" id="rfc"
                                    placeholder="Ejem: EJEM123456">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2"> <br>
                        <label for="Edad" class="formulario__label">Género</label>
                        <select id="Genero" name="Genero" class="form-select">
                            <?php foreach ($lista_genero as $genero) { ?>
                            <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?>
                            </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__Edad"> <br>
                            <label for="Edad" class="formulario__label">Edad</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Edad" id="Edad" placeholder="Edad">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__calle"> <br>
                            <label for="calle" class="formulario__label">Calle</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="calle" id="calle"
                                    placeholder="Ejem: Calle">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__num_in"> <br>
                            <label for="num_in" class="formulario__label">Núm. Interior</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="num_in" id="num_in"
                                    placeholder="Ejem: 2">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__num_ext"> <br>
                            <label for="num_ext" class="formulario__label">Núm. Ext</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="num_ext" id="num_ext"
                                    placeholder="Ejem: 3">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__colonia"> <br>
                            <label for="colonia" class="formulario__label">Colonia</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="colonia" id="colonia"
                                    placeholder="Ejem: Colonia">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__cp"> <br>
                            <label for="cp" class="formulario__label">Código Postal</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="cp" id="cp"
                                    placeholder="Ejem: 12345">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__municipio"> <br>
                            <label for="municipio" class="formulario__label">Municipio</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="municipio" id="municipio"
                                    placeholder="Ejem: Municipio">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__estado_direccion"> <br>
                            <label for="estado_direccion" class="formulario__label">Estado:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="estado_direccion"
                                    id="estado_direccion" placeholder="Ejem: CDMX">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__Alcaldia"> <br>
                            <label for="Alcaldia" class="formulario__label">Alcaldia</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Alcaldia" id="Alcaldia"
                                    placeholder="Alcaldia">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__referencias">
                            <label for="referencias" class="formulario__label">Referencias</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="referencias" id="referencias"
                                    placeholder="Referencias">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__Telefono">
                            <label for="Telefono" class="formulario__label">Teléfono</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Telefono" id="Telefono"
                                    placeholder="Teléfono">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="Administradora" class="formulario__label">Administradora</label>
                        <select id="Administradora" name="Administradora" class="form-select"
                            onchange="actualizarAseguradoras(this.value)">
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
                        <label for="Aseguradora" class="formulario__label">Aseguradora</label>
                        <div id="div">
                            <select id="Aseguradora" name="Aseguradora" class="form-select">
                                <option value="0" selected disabled>Elija una opción</option>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="Banco" class="formulario__label">Banco</label>
                        <select id="Banco" name="Banco" class="form-select">
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
                                <input type="text" class="formulario__input" name="No_nomina" id="No_nomina"
                                    placeholder="No_nomina">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <p class="formulario__input-error">La nomina no es valida, solo se aceptan letras y numeros
                            </p>
                        </div>
                    </div>
                    <div class="contenido col-md-5">
                        <div class="formulario__grupo" id="grupo__responsable">
                            <label for="responsable" class="formulario__label">Nombre del responsable</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="responsable" id="responsable"
                                    placeholder="Ejem: Otra persona">
                            </div>
                        </div>
                    </div>
                    <!--Aqui vamos a probar-->
                    <div class="col-md-5">
                        <!-- Contenido centrado -->
                        <p style="color:black"><strong>Comprobante de domicilio</strong></p>
                        <!-- Etiqueta <input> con icono -->
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input formulario__input-file" name="comprobante"
                                    id="comprobante" accept="application/pdf">
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
                                    <?php if (!empty($Credencial_front)) { ?>
                                    <img id="preview" src="<?php echo $Credencial_front; ?>">
                                    <?php } else { ?>
                                    <img id="preview" src="../../../img/post.jpg" style="width: 350px ; height: 210px;">
                                    <?php } ?>
                                    <div class="overlay-cre">
                                        <?php if (empty($Credencial_front)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker(event)">
                                            <i class="fa-solid fa-image"></i>
                                        </a>

                                        <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto(event)">Eliminar foto</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <input type="file" class="form-control" name="Credencial_front" id="Credencial_front"
                                onchange="previewImage(this);" style="display: none;" accept="application/jpg">
                        </div>
                        <div class="col-md-4">
                            <label for="Credencial_post" class="formulario__label">Credencial INE Posterior</label>
                            <div class="profile-picture-cre">
                                <div class="picture-container-cre">
                                    <?php if (!empty($Credencial_post)) { ?>
                                    <img id="preview1" src="<?php echo $Credencial_post; ?>">
                                    <?php } else { ?>
                                    <img id="preview1" src="../../../img/reverso.jpg"
                                        style="width: 350px ; height: 210px;">
                                    <?php } ?>
                                    <div class="overlay-cre">
                                        <?php if (empty($Credencial_post)) { ?>
                                        <a href="#" class="change-link" onclick="openFilePicker1(event)">
                                            <i class="fa-solid fa-image"></i>
                                        </a>
                                        <?php } else { ?>
                                        <a href="#" class="delete-link" onclick="deletePhoto1(event)">Eliminar foto</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <input type="file" class="form-control" name="Credencial_post" id="Credencial_post"
                                onchange="previewImage1(this);" style="display: none;" accept="application/jpg">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradora" class="formulario__label">Credencial Aseguradora
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
                                        <i class="fa-solid fa-image"></i>
                                    </a>
                                    <?php } else { ?>
                                    <a href="#" class="delete-link" onclick="deletePhoto2(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradora"
                            id="Credencial_aseguradora" onchange="previewImage2(this);" style="display: none;"
                            accept="application/jpg">
                    </div>
                    <div class="contenido col-md-1">
                        <label></label>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradoras_post" class="formulario__label">Credencial Aseguradora
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
                                        <i class="fa-solid fa-image"></i>
                                    </a>
                                    <?php } else { ?>
                                    <a href="#" class="delete-link" onclick="deletePhoto3(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradoras_post"
                            id="Credencial_aseguradoras_post" onchange="previewImage3(this);" style="display: none;"
                            accept="application/jpg">
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
                                <button class="formulario__btn btn  btn-outline-success" id="mostrarDiv"><i
                                        class="fa fa-camera"></i> </button>

                            </div>
                        </div>
                        <!--Fin del row-->
                        <!--Div para pantalla de la web cam-->
                        <div id="miDiv" class="oculto">
                            <div>
                                <button class="btn btn-danger" id="cerrarDiv">Cerrar <i
                                        class="fa-regular fa-rectangle-xmark"></i></button>
                                <!-- Botón para recortar la imagen -->
                                <br><br>
                                <div class="col-14 ">
                                    <div class="row justify-content-center ">
                                        <div class="col-md-auto ">
                                            <button id="cropButton" class="btn btn-warning btn-block"
                                                style="display: none;">Recortar Imagen</button>
                                        </div><br>
                                        <div class="col-md-auto ">
                                            <button id="captureButton"
                                                class="btn btn-success btn-block">Captura</button>
                                        </div><br>
                                        <div class="col-md-auto ">
                                            <button id="downloadButton"
                                                class="btn btn-info btn-block">Descargar</button>
                                        </div>
                                    </div>
                                    <div><br>

                                        <div class="row justify-content-center">
                                            <div class="col-md-auto border border-danger">
                                                <div id="cropperPreview" style="display: none;">
                                                    <img id="croppedImage" src="#" alt="Imagen Recortada" width="250" height="250"><br>
                                                    <h3 style="color:#ffff">Imagen Recortada</h3>
                                                </div>
                                            </div>

                                            <div class="col-md-auto border border-success">
                                                <!-- Elemento de video para mostrar la vista previa de la cámara web -->
                                                <video id="video" width="250" height="250" autoplay></video>
                                                <h3 style="color:#ffff">Captura la imagen</h3>
                                            </div>
                                            <div class="col-md-auto border border-warning">
                                                <!-- Canvas para mostrar la imagen capturada -->
                                                <canvas id="canvas" width="250" height="250"
                                                    style="display: none;"></canvas>
                                                    <h3 style="color:#ffff">Recorta lo necesario</h3>
                                            </div>
                                        </div>


                                        <!--Este div es del miDiv-->
                                        <!--fin de la pantalla de la web cam-->
                </form>
            </div>
        </div>
</main>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const mostrarDiv = document.getElementById("mostrarDiv");
    const miDiv = document.getElementById("miDiv");
    const cerrarDiv = document.getElementById("cerrarDiv");

    mostrarDiv.addEventListener("click", function() {
        miDiv.style.display = "block";
    });

    cerrarDiv.addEventListener("click", function() {
        miDiv.style.display = "none";
    });
});

//Este es el script para la web cam
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const captureButton = document.getElementById('captureButton');
const cropButton = document.getElementById('cropButton');
const downloadButton = document.getElementById('downloadButton');

let cropper;

// Obtener acceso a la cámara web
navigator.mediaDevices.getUserMedia({
        video: true
    })
    .then(function(stream) {
        video.srcObject = stream;
    })
    .catch(function(error) {
        console.error('Error al acceder a la cámara web:', error);
    });

// Capturar una imagen desde la cámara web
captureButton.addEventListener('click', function() {
    canvas.style.display = 'block';
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Mostrar el botón de recorte
    captureButton.style.display = 'none';
    cropButton.style.display = 'inline-block';

    // Inicializar Cropper.js con el canvas
    cropper = new Cropper(canvas, {
        aspectRatio: 1, // Proporción de recorte
        viewMode: 1, // Vista previa del recorte
        guides: true, // Muestra guías de recorte
    });
});

// Recortar la imagen capturada
cropButton.addEventListener('click', function() {
    if (cropper) {
        // Obtener la imagen recortada como un objeto Blob
        cropper.getCroppedCanvas().toBlob(function(blob) {
            const croppedImage = document.getElementById('croppedImage');
            croppedImage.src = URL.createObjectURL(blob);

            // Mostrar la vista previa del recorte y el botón de descarga
            document.getElementById('cropperPreview').style.display = 'block';
            downloadButton.style.display = 'inline-block';
        });
    } else {
        console.error('Primero debes capturar una imagen.');
    }
});

// Descargar la imagen recortada
downloadButton.addEventListener('click', function() {
    const croppedImage = document.getElementById('croppedImage').src;
    const a = document.createElement('a');
    a.href = croppedImage;
    a.download = 'imagen_recortada.png'; // Cambia el nombre del archivo según tus necesidades
    a.click();
});
</script>

<script src="../../../assets/js/scriptCamaWeb.js"></script>
<script src="../../../assets/js/archivosPacientes.js"></script>
<script src="../../../assets/js/nomina.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
<!--Aqui empieza mi escript de la ventana emergente-->
<script>
function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
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