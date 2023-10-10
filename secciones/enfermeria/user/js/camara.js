const tieneSoporteUserMedia = () =>
  !!(
    navigator.getUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.mediaDevices.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.msGetUserMedia
  );
const _getUserMedia = (...arguments) =>
  (
    navigator.getUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.mediaDevices.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.msGetUserMedia
  ).apply(navigator, arguments);

// Declaramos elementos del DOM
const $video = document.querySelector("#video"),
  $canvas = document.querySelector("#canvas"),
  $boton = document.querySelector("#boton"),
  $boton2 = document.querySelector("#boton2"),
  $latitud = document.querySelector("#latitud"),
  $longitud = document.querySelector("#longitud");

const obtenerDispositivos = () => navigator.mediaDevices.enumerateDevices();

//Funcion cancelar 1.1 LISTO
function confirmCancel(event) {
  event.preventDefault();
  Swal.fire({
    title: "¿Estás seguro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, cancelar",
    cancelButtonText: "No, continuar",
  }).then((result) => {
    if (result.isConfirmed) {
      // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
      window.location.href = "index.php";
    }
  });
}
//Funcion de guardado de foto temporal 1.2 LISTO
function guardarFoto() {
  //Cambia a la posición 2 de botones
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
  let idUser = document.getElementById("idUser").value;
  //Se guardan los datos en tipo JSON
  var data = {
    nomFoto: nomFoto(),
    idUser : idUser,
    foto: encodeURIComponent(foto),
  };
  //Se mandan los datos con el método Fetch
  fetch("model/tomarAsistencia.php", {
    method: "POST",
    body: JSON.stringify(data),
    headers: { "Content-type": "application/x-www-form-urlencoded" },
  })
    .then((resultado) => {
      // A los datos los decodificamos como texto plano
      return resultado.text();
    })
    .then((nombreDeLaFoto) => {
      // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
      // Y se lo guardamos a un input hidden para llamarlo si es necesario
      document.getElementById("nomFoto").value = nombreDeLaFoto;
      //Se confirma que se almacenó de manera momentanea
      console.log("Foto almacenada con éxito");
    })
    .catch((error) => {
      //Agarramos los errores y mostramos en consola
      console.error("Error:", error);
    });
}
//Funcion de nueva foto 2.1 LISTO
function newFoto() {
  //Reanudamos el video
  $video.play();
  //Seteamos los botones en posición uno
  setBtnTo1();
  //Se borra la foto que se había guardado anteriormente
  deleteFoto(nomFoto());
}
//Funcion que guarda todos los datos y registra asistencia 2.2
function tomarAsistencia() {
  //Se toman las coordenadas
  let lat = document.getElementById("latitud").value;
  let lon = document.getElementById("longitud").value;
  //Se setean los datos Estado y ID del usuario
  let status = document.getElementById("status").value;
  let idUser = document.getElementById("idUser").value;
  //Se setean status de la asistencia y el id del Horario
  let statusHor = document.getElementById("statusHor").value;
  let idHor = document.getElementById("idHor").value;
  //Se setean los datos con sintaxis JSON para enviarse
  var data = {
    lat: lat,
    lon: lon,
    status: status,
    idUser: idUser,
    statusHor: statusHor,
    idHor: idHor,
    nomFoto: nomFoto(),
  };
  //Se utiliza la función fetch para enviar los datos
  fetch("model/tomarAsistencia.php", {
    //Por método post
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-type": "application/x-www-form-urlencoded",
    },
  }).then((response) => {
    return response.text();
  }).then(resultado =>{
    console.log(resultado);
    if(resultado == "Registro Exitoso"){
      window.location.replace("index.php");
    }
  }).catch((error) => {
    console.log("Error: "+error);
  })
}

// La función que es llamada después de que ya se dieron los permisos
(function () {
  // Comenzamos viendo si tiene soporte, si no, nos detenemos
  if (!tieneSoporteUserMedia()) {
    alert("Lo siento. Tu navegador no soporta esta característica");
    return;
  }
  //Aquí guardaremos el stream globalmente
  let stream;
  // Comenzamos pidiendo los dispositivos
  obtenerDispositivos().then((dispositivos) => {
    // Vamos a filtrarlos y guardar aquí­ los de vídeo
    const dispositivosDeVideo = [];
    // Recorrer y filtrar
    dispositivos.forEach(function (dispositivo) {
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
  const mostrarStream = (idDeDispositivo) => {
    _getUserMedia(
      {
        video: {
          // Justo aquí indicamos cuál dispositivo usar
          deviceId: idDeDispositivo,
        },
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
      }
    );
  };
})();

//Funcion de geolocalizacion
if (!navigator.geolocation) {
  console.log("Geolocalización no disponible.");
} else {
  console.log("Geolocalizando...");
  navigator.geolocation.getCurrentPosition(pos_ok, pos_fallo);
}
function nomFoto() {
  let $nomFoto = document.getElementById("nomFoto").value;
  return $nomFoto;
}
//Función llamada para borrar foto
function deleteFoto(nomFoto) {
  //Se setea el dato para enviar
  data = { nomFoto: nomFoto };
  //Se busca por la funcion fetch
  fetch("model/deleteFoto.php", {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-type": "application/x-www-form-urlencoded",
    },
  })
    .then((resultado) => {
      // A los datos los decodificamos como texto plano
      return resultado.text();
    })
    .then((estadoFoto) => {
      //Mostramos en consola el estado de la foto
      console.log("Estado de foto: " + estadoFoto);
    })
    .catch((error) => {
      //Tomamos los erroes y los mostramos en consola
      console.error("Error:", error);
    });
}
//Funciones de seteo de botones según las necesidades
function setBtnTo1() {
  //Cambia el texto de los botones
  $boton.textContent = "Tomar foto";
  $boton2.textContent = "Cancelar";
  //Cambia las acciones que hace cada botón al presionar
  $boton.setAttribute("onclick", "guardarFoto()");
  $boton2.setAttribute("onclick", "confirmCancel(event)");
}
function setBtnTo2() {
  //Cambia el texto de los botones
  $boton.textContent = "Confirmar";
  $boton2.textContent = "Tomar nueva foto";
  //Cambia las acciones que hace cada botón al presionar
  $boton.setAttribute("onclick", "tomarAsistencia()");
  $boton2.setAttribute("onclick", "newFoto()");
}
//Funciones para la ubicación
function pos_ok(posicion) {
  console.log(posicion);
  var latitud = posicion.coords.latitude;
  var longitud = posicion.coords.longitude;
  document.getElementById("latitud").value = latitud;
  document.getElementById("longitud").value = longitud;
}
function pos_fallo() {
  console.log("Error al geolocalizar.");
}
