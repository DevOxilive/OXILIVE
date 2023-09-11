//Funciones de mostrar contenedor 



/**var videoWidth = 320;
var videoHeight = 240;
var videoTag = document.getElementById('theVideo');
var canvasTag = document.getElementById('theCanvas');
var btnCapture = document.getElementById("btnCapture");
var btnDownloadImage = document.getElementById("btnDownloadImage");
var btnSendImageToServer = document.getElementById("btnSendImageToServer");

videoTag.setAttribute('width', videoWidth);
videoTag.setAttribute('height', videoHeight);
canvasTag.setAttribute('width', videoWidth);
canvasTag.setAttribute('height', videoHeight);

window.onload = () => {
    navigator.mediaDevices.getUserMedia({
        audio: true,
        video: {
            width: videoWidth,
            height: videoHeight
        }
    }).then(stream => {
        videoTag.srcObject = stream;
    }).catch(e => {
        document.getElementById('errorTxt').innerHTML = 'ERROR: ' + e.toString();
    });

    var canvasContext = canvasTag.getContext('2d');

    // Capturar button..
    btnCapture.addEventListener("click", () => {
        canvasContext.drawImage(videoTag, 0, 0, videoWidth, videoHeight);
        btnSendImageToServer.removeAttribute("disabled");
    });

    // Download button..
    btnDownloadImage.addEventListener("click", () => {
        var link = document.createElement('a');
        link.download = 'capturedImage.png';
        link.href = canvasTag.toDataURL();
        link.click();
    });

    // Send image to server button..
    btnSendImageToServer.addEventListener("click", () => {
        var dataURL = theCanvas.toDataURL();
        var blob = dataURLtoBlob(dataURL);
        var data = new FormData();
        data.append("capturedImage", blob, "capturedImage.jpg");

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                alert(xmlHttp.responseText);
            }
        }
        xmlHttp.open("post", "testingCam.php");
        xmlHttp.send(data);
    });

    function dataURLtoBlob(dataURL) {
        var arr = dataURL.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new Blob([u8arr], {
            type: mime
        });
    }
};*/
