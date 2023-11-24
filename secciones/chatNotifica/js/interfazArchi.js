document.getElementById('btnMostrar').addEventListener('click', function () {
    var galeria = document.getElementById('miGaleria');
    var chatContainer = document.getElementById('chat-container');

    if (galeria.style.display === 'none') {
        galeria.style.display = 'grid';
        chatContainer.classList.add('ocult');
    } else {
        galeria.style.display = 'none';
        chatContainer.classList.remove('ocult');

    }
});