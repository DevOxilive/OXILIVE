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
    <link rel="stylesheet" href="../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../assets/css/vali.css">
    <link rel="stylesheet" href="../../../assets/css/edit.css">
    <style>
        /* Estilos para centrar el contenido y hacerlo responsivo */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.90);
            /* Gris clarito semitransparente */
            z-index: 6;
        }
        #canvasContainer {
            position: relative;
            top: 50px;
            left: 20vh;
        }
        #canvas {
            max-width: 100%;
            height: auto;
        }
        .rico {

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: auto;
        }
        #videoContainer {
            position: absolute;
            top: 0;
            left: 0;
        }
        #video {
            width: 100px;
            /* Ancho reducido a 20px */
            height: auto;
        }
        /* Estilos para el botón "Editar y Descargar" */
        #editAndDownload {
            margin-top: 0px;
        }
        #Titulo-Ine-Fondo{
            color: #fff !important;
        }   
        #capturedImage {
            max-width: 240px;
            /* Puedes ajustar el tamaño máximo según tus necesidades */
            display: none;
        }
       
        
        
        /* Estilos para el div que se muestra cuando haces clic en el botón */
        #myDIV {
            display: none;
            position: fixed;
            top: 15%;
            left: 90%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: white;
            z-index: 2;
        }

        #cerrarDiv {
            position: absolute;
            top: 10vh;
            right: 10vh;
            }
        </style>
    </head>
<body>
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                    <h4
                        style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                        Datos del nuevo Paciente</h4>
                </div>
                <div class="card-body" style="border: 2px solid #BFE5FF">
                    <form action="./pacientesADD.php" method="post" enctype="multipart/form-data"
                        class="formLogin row g-3" id="formulario">
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
                                    <option value="<?php echo $genero['id_genero']; ?>">
                                        <?php echo $genero['genero']; ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="contenido col-md-2">
                            <div class="formulario__grupo" id="grupo__Edad"> <br>
                                <label for="Edad" class="formulario__label">Edad</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" class="formulario__input" name="Edad" id="Edad"
                                        placeholder="Edad">
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
                                    <option value="<?php echo $ban['id_bancos']; ?>">
                                        <?php echo $ban['Nombre_banco']; ?>
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
                                <p class="formulario__input-error">La nomina no es valida, solo se aceptan letras y
                                    numeros
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
                                    <input type="file" class="custom-file-input formulario__input-file"
                                        name="comprobante" id="comprobante" accept="application/pdf">
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
                                            <img id="preview" src="../../../img/post.jpg"
                                                style="width: 350px ; height: 210px;">
                                        <?php } ?>
                                        <div class="overlay-cre">
                                            <?php if (empty($Credencial_front)) { ?>
                                                <a href="#" class="change-link" onclick="openFilePicker(event)">
                                                    <i class="fa-solid fa-image"></i>
                                                </a>

                                            <?php } else { ?>
                                                <a href="#" class="delete-link" onclick="deletePhoto(event)">Eliminar
                                                    foto</a>
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
                                                <a href="#" class="delete-link" onclick="deletePhoto1(event)">Eliminar
                                                    foto</a>
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
                                        <img id="preview2" src="../../../img/post.jpg"
                                            style="width: 350px ; height: 210px;">
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
                                        <img id="preview3" src="../../../img/reverso.jpg"
                                            style="width: 350px ; height: 210px;">
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
                                <p><i class="bi bi-stickies-fill"></i> <b>Nota:</b> Agrega las credenciales de
                                    Aseguradora
                                </p>
                            </div>
                        </div>
                        <br>
                        <!--Row boton de descargar imagen-->
                        <div class="col-10 ">
                            <div class="row justify-content-center formulario__grupo formulario__grupo-btn-enviar">
                                <div class="col-md-auto ">
                                    <button type="submit"
                                        class="formulario__btn btn btn-outline-primary">Enviar</button>
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
                            <!--fin de la pantalla de la web cam-->
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
<script src="../../../assets/js/archivosPacientes.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
<!-- <script src="../../../assets/js/nomina.js"></script> -->
<!--Alerta de retroceso-->
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
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.formEdit').addEventListener('submit', function (event) {
        event.preventDefault();

        // Verifica si los campos obligatorios están vacíos
        var Nombres = document.getElementById('Nombres').value;
        var Apellidos = document.getElementById('Apellidos').value;
        var Direccion = document.getElementById('calle').value;
        var No_nomina = document.getElementById('Nomina').value;
        var Credencial_front = document.getElementById('Credencial_front').value;

        if (!Nombres || !Apellidos || !Direccion || !No_nomina || !Credencial_front) {
            // Muestra una alerta de SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Por favor, completa todos los campos obligatorios.',
            });
        } else {
            // Realiza la solicitud Ajax solo si los campos están completos
            $.ajax({
                type: 'POST', // O el método que necesites
                url: './pacientesUP.php', // La URL a la que enviar los datos
                data: $('.formEdit').serialize(), // Serializa el formulario
                success: function (response) {
                    // Aquí puedes manejar la respuesta del servidor después de enviar el formulario
                    // Por ejemplo, redirigir a otra página o mostrar un mensaje de éxito
                }
            });
        }
    });
});

</script>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>
    let video, canvas, context, model, stream, intervalId, closestPrediction;
    async function setupCamera() {
        video = document.getElementById('video');
        canvas = document.getElementById('canvas');
        context = canvas.getContext('2d');
        stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;
        video.onloadedmetadata = () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            runObjectDetection();
        };
    }

    async function runObjectDetection() {
        model = await cocoSsd.load();

        intervalId = setInterval(async () => {
            context.clearRect(0, 0, canvas.width, canvas.height);
            context.drawImage(video, 0, 0);
            const predictions = await model.detect(video);

            if (predictions.length > 0) {
                closestPrediction = predictions[0];
                context.beginPath();
                context.rect(...closestPrediction.bbox);
                context.lineWidth = 2;
                context.strokeStyle = 'blue';
                context.globalAlpha = 0.5;
                context.stroke();

                // Habilitar el botón de Capturar
                document.getElementById('capture').disabled = false;
            }
        }, 100);
    }

    // Obtener referencias a los botones
    const startCameraButton = document.getElementById('startCamera');
    const stopDetectionButton = document.getElementById('stopDetection');
    const captureButton = document.getElementById('capture');
    const capturedImage = document.getElementById('capturedImage');
    const editAndDownloadButton = document.getElementById('editAndDownload');
    const editedCanvas = document.getElementById('editedCanvas');

    startCameraButton.addEventListener('click', async () => {
        if (!stream) {
            await setupCamera();
            startCameraButton.disabled = true;
            stopDetectionButton.disabled = false;
        }
    });

    stopDetectionButton.addEventListener('click', () => {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            clearInterval(intervalId);
            context.clearRect(0, 0, canvas.width, canvas.height);
            startCameraButton.disabled = false;
            stopDetectionButton.disabled = true;
            captureButton.disabled = true;
            capturedImage.style.display = 'none';
            location.reload();
        }
    });

    captureButton.addEventListener('click', () => {
        // Tomar una captura de la detección
        if (closestPrediction) {
            const x = Math.max(0, closestPrediction.bbox[0]);
            const y = Math.max(0, closestPrediction.bbox[1]);
            const width = Math.min(canvas.width - x, closestPrediction.bbox[2]);
            const height = Math.min(canvas.height - y, closestPrediction.bbox[3]);

            const captureCanvas = document.createElement('canvas');
            captureCanvas.width = width;
            captureCanvas.height = height;
            const captureContext = captureCanvas.getContext('2d');
            captureContext.drawImage(video, x, y, width, height, 0, 0, width, height);

            // Mostrar la captura al lado
            capturedImage.src = captureCanvas.toDataURL('image/png');
            capturedImage.style.display = 'block';

            // Habilitar el botón "Editar y Descargar"
            editAndDownloadButton.disabled = false;
        }
    });

    editAndDownloadButton.addEventListener('click', () => {
        // Captura la imagen y conviértela en un elemento canvas
        html2canvas(capturedImage).then(canvas => {
            // Muestra el canvas capturado en el elemento "editedCanvas"
            editedCanvas.width = canvas.width;
            editedCanvas.height = canvas.height;
            editedCanvas.getContext('2d').drawImage(canvas, 0, 0);

            // Habilita la descarga de la imagen
            const editedImage = new Image();
            editedImage.src = editedCanvas.toDataURL('image/png');

            // Crea un enlace de descarga
            const a = document.createElement('a');
            a.href = editedImage.src;
            a.download = 'edited_image.png';
            a.textContent = 'Descargar imagen editada';
            a.style.display = 'block';

            // Agrega el enlace al documento
            editedCanvas.parentNode.appendChild(a);
        });
    });

</script>
<?php
include("../../../templates/footer.php");
?>