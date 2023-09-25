const tieneSoporteUserMedia = () => !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)

        .apply(navigator, arguments);

// Declaramos elementos del DOM
const $video = document.querySelector("#video"),
    $canvas = document.querySelector("#canvas"),
    $boton = document.querySelector("#boton"),
    $boton2 = document.querySelector("#boton2"),
    $latitud = document.querySelector("#latitud"),
    $longitud = document.querySelector("#longitud");

const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

 //Funcion cancelar 1.1 LISTO
function confirmCancel(event) {
    event.preventDefault();
    Swal.fire({
        title: '¿Estás seguro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',  
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
            window.location.href = "index.php";
        }
    });
}
function guardarFoto(event) {
    event.preventDefault();
    setBtnTo2();
    //Pausar reproducción
    $video.pause();
    //Obtener contexto del canvas y dibujar sobre él
    let contexto = $canvas.getContext("2d");
    //Damos dimensiones del video
    $canvas.width = $video.videoWidth;
    $canvas.height = $video.videoHeight;
    //Tomamos captura del video pausado
    contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);
    let foto = $canvas.toDataURL(); //Esta es la foto, en base 64
    //Se guardan los datos en tipo JSON
    var data = {
        'nomFoto' : nomFoto,
        'foto': encodeURIComponent(foto),
    }
    //Se mandan los datos con el método Fetch
    fetch("model/tomarAsistencia.php", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-type": "application/x-www-form-urlencoded",
        }
    })
    .then(resultado => {
        // A los datos los decodificamos como texto plano
        return resultado.text();
    })
    .then(nombreDeLaFoto => {
        // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
        document.getElementById('nomFoto').value = nombreDeLaFoto;
        let $nomFoto = document.getElementById('nomFoto').value;
        alert($nomFoto);
    })
}
function newFoto(event) {
    event.preventDefault();
    setBtnTo1();
    deleteFoto(nomFoto());
}
function tomarAsistencia(event) {
    event.preventDefault();
    //Se toman las coordenadas
    let lat = document.getElementById('latitud').value;
    let lon = document.getElementById('longitud').value;

    let status = document.getElementById('status').value;
    let idUser = document.getElementById('idUser').value;
    var data = {
        'lat' : lat,
        'lon' : lon,
        'status' : status,
        'idUser' : idUser,
        'nomFoto' : nomFoto,
    }
    fetch("model/tomarAsistencia", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-type": "application/x-www-form-urlencoded",
        }
    }).then( response =>{
        if(response){
        }
    }) 
}

// La función que es llamada después de que ya se dieron los permisos
(function() {
    // Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        alert("Lo siento. Tu navegador no soporta esta característica");
        return;
    }
    //Aquí guardaremos el stream globalmente
    let stream;
    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
    .then(dispositivos => {
        // Vamos a filtrarlos y guardar aquí­ los de vídeo
        const dispositivosDeVideo = [];
        // Recorrer y filtrar
        dispositivos.forEach(function(dispositivo) {
            const tipo = dispositivo.kind;
            if (tipo === "videoinput") {
                dispositivosDeVideo.push(dispositivo);
            }
        });
        // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
        // y le pasamos el id de dispositivo
        if (dispositivosDeVideo.length > 0) {
            // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
            mostrarStream(dispositivosDeVideo[0].deviceId);
        }
    });
    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
            video: {
                // Justo aquí indicamos cuál dispositivo usar
                deviceId: idDeDispositivo,
            }
        },
        (streamObtenido) => {
            // Simple asignación
            stream = streamObtenido;
            // Mandamos el stream de la cámara al elemento de ví­deo
            $video.srcObject = stream;
            $video.play();
        },
        (error) => {
            console.log("Permiso denegado o error: ", error);
        });
    }
})
();

//Funcion de geolocalizacion
//Funciones para la ubicación
if(!navigator.geolocation) {
    console.log('Geolocalización no disponible.');
} else {
    console.log('Geolocalizando...');
    navigator.geolocation.getCurrentPosition(pos_ok, pos_fallo);
}
function nomFoto(){
    let $nomFoto = document.getElementById('nomFoto').value;
    return $nomFoto;
}
function setBtnTo1(){
    $boton.textContent = "Tomar foto";
    $boton2.textContent = "Cancelar";
    $boton.setAttribute("onclick", "guardarFoto(event)")
    $boton2.setAttribute("onclick", "confirmCancel(event)");
}
function setBtnTo2(){
    $boton.textContent = "Continuar";
    $boton2.textContent = "Tomar nueva foto";
    $boton.setAttribute("onclick", "tomarAsistencia()");
    $boton2.setAttribute("onclick", "newFoto()");
}
function pos_ok (posicion) {
    console.log(posicion);
    var latitud  = posicion.coords.latitude;
    var longitud = posicion.coords.longitude;
    document.getElementById('latitud').value = latitud;
    document.getElementById('longitud').value = longitud;
}
function pos_fallo () {
    console.log('Error al geolocalizar.');
}