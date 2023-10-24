<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
    <style>
    #videoContainer {
        position: absolute;
        top: 6.5vh;
        left: 3.5vh;
    }

    #video {
        width: 100px;
        height: auto;
    }
    </style>
</head>
<main id="main" class="main">

    <body>
        <div class="container">
            <h1 class="text-center mt-4">Captura Tu Reporte</h1>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="canvasContainer" class="text-center" style="margin-top: 40px;">
                                <canvas id="canvas" class="img-fluid"></canvas>
                                <div id="videoContainer">
                                    <video id="video" autoplay class="img-fluid"></video>
                                </div>
                                <img id="capturedImage" class="img-fluid">
                            </div>
                            <div class="btn-container text-center">
                                <button type="button" class="btn btn-success btn-sm" id="startCamera">Iniciar
                                    Cámara</button>
                                <button type="button" class="btn btn-danger btn-sm" id="stopDetection" disabled>Detener
                                    Detección</button>

                                <button type="button" class="btn btn-info btn-sm" id="capture" style="display:none;"
                                    disabled>Capturar</button>
                                <button type="button" class="btn btn-primary btn-sm" id="showImage"
                                    style="display:none;" disabled>Descargar
                                    PDF</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.9.0/dist/pdf-lib.js"></script>
        <script>
        let video, canvas, context, model, stream, intervalId, closestPrediction;
        async function setupCamera() {
            video = document.getElementById('video');
            canvas = document.getElementById('canvas');
            context = canvas.getContext('2d');
            stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });
            video.srcObject = stream;
            video.onloadedmetadata = () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                runObjectDetection();
                document.getElementById('stopDetection').disabled =
                    false;
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
                    document.getElementById('capture').disabled = false;
                    document.getElementById('showImage').disabled = false;
                }
            }, 100);
        }
        const startCameraButton = document.getElementById('startCamera');
        const stopDetectionButton = document.getElementById('stopDetection');
        const captureButton = document.getElementById('capture');
        const showImageButton = document.getElementById('showImage');
        startCameraButton.addEventListener('click', async () => {
            if (!stream) {
                await setupCamera();
                startCameraButton.style.display = 'none';
                stopDetectionButton.style.display = 'inline';
                captureButton.style.display = 'inline';
                showImageButton.style.display = 'inline';
            }
        });
        stopDetectionButton.addEventListener('click', () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                clearInterval(intervalId);
                context.clearRect(0, 0, canvas.width, canvas.height);
                startCameraButton.style.display = 'inline';
                stopDetectionButton.style.display = 'none';
                captureButton.style.display = 'none';
                showImageButton.style.display = 'none';
                location.reload();
            }
        });

        captureButton.addEventListener('click', () => {
            // Aquí voy a tomar mi captura de la canva
            if (closestPrediction) {
                const x = Math.max(0, closestPrediction.bbox[0]);
                const y = Math.max(0, closestPrediction.bbox[1]);
                const width = Math.min(canvas.width - x, closestPrediction.bbox[2]);
                const height = Math.min(canvas.height - y, closestPrediction.bbox[3]);

                // Crear un nuevo canvas para la captura
                const captureCanvas = document.createElement('canvas');
                captureCanvas.width = width;
                captureCanvas.height = height;
                const captureContext = captureCanvas.getContext('2d');

                // Capturar la parte completa de la detección
                captureContext.drawImage(video, x, y, width, height, 0, 0, width, height);

                // Mostrar la captura al lado
                capturedImage.src = captureCanvas.toDataURL('image/jpeg');
                capturedImage.style.display = 'block';

                // Agregar la captura al PDF
                const imgData = captureCanvas.toDataURL('image/jpeg');
                const {
                    PDFDocument,
                    rgb
                } = 'PDFLib';

                (async () => {
                    const pdfDoc = await PDFDocument.create();
                    const page = pdfDoc.addPage([512, 992]);
                    const jpgImage = await pdfDoc.embedJpg(imgData);
                    const imgDims = jpgImage.scale(1);
                    const centerX = (page.getWidth() - imgDims.width) / 2;
                    const centerY = (page.getHeight() - imgDims.height) / 4;

                    page.drawImage(jpgImage, {
                        x: centerX,
                        y: centerY,
                        width: imgDims.width,
                        height: imgDims.height,
                        color: rgb(0, 0, 0),
                    });
                    const pdfBytes = await pdfDoc.save();
                    const pdfBlob = new Blob([pdfBytes], {
                        type: 'application/pdf'
                    });
                    const pdfUrl = URL.createObjectURL(pdfBlob);

                    const link = document.createElement('a');
                    link.href = pdfUrl;
                    link.download = 'Expediente.pdf';
                    link.style.display = 'none';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(pdfUrl);
                })();
            }
        });

        showImageButton.addEventListener('click', async () => {
            if (capturedImage.src) {
                const imgData = capturedImage.src;
                // Crear un nuevo PDF
                const {
                    PDFDocument,
                    rgb
                } = PDFLib;
                const pdfDoc = await PDFDocument.create();
                const page = pdfDoc.addPage([canvas.width, canvas.height]);
                // Agregar la imagen y agregarla a la página pdf
                const jpgImage = await pdfDoc.embedJpg(imgData);
                const jpgDims = jpgImage.scale(1);
                page.drawImage(jpgImage, {
                    x: 0,
                    y: 0,
                    width: jpgDims.width,
                    height: jpgDims.height,
                    color: rgb(0, 0, 0),
                });
                // Generar el archivo PDF
                const pdfBytes = await pdfDoc.save();
                // Crear un objeto Blob para el archivo PDF
                const pdfBlob = new Blob([pdfBytes], {
                    type: 'application/pdf'
                });
                // Crear un enlace para descargar el PDF
                const pdfUrl = URL.createObjectURL(pdfBlob);
                const link = document.createElement('a');
                link.href = pdfUrl;
                link.download = 'Expediente.pdf';
                link.style.display = 'none';
                // Agregar el enlace al cuerpo del documento y hacer clic para descargar
                document.body.appendChild(link);
                link.click();
                // Limpiar después de la descarga
                document.body.removeChild(link);
                URL.revokeObjectURL(pdfUrl);
            }
        });
        </script>
        <script src="js/nextService.js"></script>
        <script src="js/rangeActivity.js"></script>
    </body>

</html>
</main>
<?php
include("../../../templates/footer.php");
?>