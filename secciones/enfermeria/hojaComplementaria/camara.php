<!DOCTYPE html>
<html>
<head>
    <title>Detección de objetos en tiempo real</title>
    <style>
        /* Estilos para centrar el contenido y hacerlo responsivo */
        body {
            background-color: rgb(0, 0, 49) !important;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        h1{
            color: #fff !important;
        }
        #canvasContainer {
            display: flex; /* Hacer que los elementos se muestren en línea */
            align-items: center; /* Centrar verticalmente */
            justify-content: center; /* Centrar horizontalmente */
        }

        #canvas {
            max-width: 100%;
            height: auto;
        }

        #capturedImage {
            max-width: 240px; /* Puedes ajustar el tamaño máximo según tus necesidades */
            display: none;
        }

        #videoContainer {
            position: absolute;
            top: 18vh;
            left: 62vh;
        }

        #video {
            width: 100px; /* Ancho reducido a 20px */
            height: auto;
        }

        /* Estilos para los botones */
        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <h1>Captura el INE</h1>
    <div id="canvasContainer">
        <canvas id="canvas"></canvas>
        <div id="videoContainer">
            <video id="video" autoplay></video>
        </div>
        <img id="capturedImage"> <!-- Imagen capturada al lado de la canvas -->
    </div>
    <div class="btn-container">
        <button type="button" class="btn btn-success" id="startCamera">Iniciar Cámara</button>
        <button type="button" class="btn btn-danger" id="stopDetection" disabled>Detener Detección</button>
        <button type="button" class="btn btn-info" id="capture" disabled>Capturar</button>
        <button type="button" class="btn btn-primary" id="downloadImage" disabled>Descargar Imagen</button>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.7.0/fabric.min.js"></script>

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
                    document.getElementById('capture').disabled = false;
                    document.getElementById('downloadImage').disabled = false;
                }
            }, 100);
        }

        // Obtener referencias a los botones
        const startCameraButton = document.getElementById('startCamera');
        const stopDetectionButton = document.getElementById('stopDetection');
        const captureButton = document.getElementById('capture');
        const capturedImage = document.getElementById('capturedImage');
        const downloadButton = document.getElementById('downloadImage'); // Botón de descarga

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
            }
        });

        // Agregar funcionalidad al botón de descarga
        downloadButton.addEventListener('click', () => {
            if (capturedImage.src) {
                const a = document.createElement('a');
                a.href = capturedImage.src;
                a.download = 'captured_image.png';
                a.click();
            }
        });
    </script>
</body>
</html>
