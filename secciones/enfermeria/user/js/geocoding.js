//Funcion de geolocalizacion
if (!navigator.geolocation) {
  console.log("Geolocalización no disponible.");
} else {
  console.log("Geolocalizando...");
  navigator.geolocation.getCurrentPosition(pos_ok, pos_fallo);
}
var latitud, longitud;
//Funciones para la ubicación
function pos_ok(posicion) {
  console.log("Geolocalización realizada con éxito");
  latitud = posicion.coords.latitude;
  longitud = posicion.coords.longitude;
}
function pos_fallo() {
  console.log("Error al geolocalizar.");
}
