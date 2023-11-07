function cambiarImagen(event, imageId) {
    const input = event.target;
    const image = document.getElementById(imageId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        image.src = "../../../../img/OXILIVE.ico";
    }
}
document.getElementById('Credencial_front').addEventListener('change', function(event) {
    cambiarImagen(event, 'imagenActual');
});

document.getElementById('Credencial_post').addEventListener('change', function(event) {
    cambiarImagen(event, 'imagenActual1');
});
document.getElementById('Credencial_aseguradora').addEventListener('change', function(event) {
    cambiarImagen(event, 'imagenActual2');
});
document.getElementById('Credencial_aseguradoras_post').addEventListener('change', function(event) {
    cambiarImagen(event, 'imagenActual3');
});