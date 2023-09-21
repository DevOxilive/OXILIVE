
const tieneSoporteUserMedia = () => !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)

        .apply(navigator, arguments);

// Declaramos elementos del DOM
const $video = document.querySelector("#video"),
    $canvas = document.querySelector("#canvas"),
    $boton = document.querySelector("#boton"),

    $latitud = document.querySelector("#latitud"),
    $longitud = document.querySelector("#longitud");

const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

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
            //Escuchar el click del botón para tomar la foto
            $boton.addEventListener("click",function() {
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
                //Se toman las coordenadas
                let lat = document.getElementById('latitud').value;
                let lon = document.getElementById('longitud').value;
                let status = document.getElementById('status').value;
                let idUser = document.getElementById('idUser').value;
                //Se guardan los datos en tipo JSON
                var data = {
                    'idUser' : idUser,
                    'lat': lat,
                    'lon' : lon,
                    'status' : status,
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
                    return resultado.text()
                })
                .then(nombreDeLaFoto => {
                    // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
                    alert(nombreDeLaFoto);
                })

                //Reanudar reproducción
                $video.play();
                //Y redireccionamos a la página de inicio
                window.location.href.replace('C:\laragon\www\OXILIVE\secciones/enfermeria/user/index.php');
            });
        },
        (error) => {
            console.log("Permiso denegado o error: ", error);
        });
    }
})
();
 //Funcion cancelar
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

//Funcion de geolocalizacion
//Funciones para la ubicación

if(!navigator.geolocation) {
    console.log('Geolocalización no disponible.');
} else {
    console.log('Geolocalizando...');
    navigator.geolocation.getCurrentPosition(pos_ok, pos_fallo);
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

