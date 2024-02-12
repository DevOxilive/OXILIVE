$(document).ready(function () {
    chatBox = document.querySelector("#chat-container");
    var userScrolled = false; //variable para detectar scroll
    // Cargar mensajes existentes
    loadMessages();
    // Enviar mensaje
    $('#send').click(function () {
        const fileInput = document.getElementById('fileInput');
        var message = $('#message').val().trim();
        var user = $('#user').val();
        var output = $('#output').val();
        var userC = $('#userChat').val();
        // validacion
        var contieneTexto = /\S/.test(message);
        const selectedFile = fileInput.files[0];
        if (selectedFile) {
            // Sube el archivo seleccionado
            uploadFile(selectedFile);
            // Limpia el campo de archivo
            fileInput.value = ''; // Esto restablecerá el campo de archivo
        }
        if (contieneTexto) {
            $.ajax({
                url: 'send_message.php', //ruta del archivo que envia a la base los mensajes
                type: 'POST',
                data: { user: user, message: message, output: output, userC: userC },
                success: function () {
                    $('#message').val('');
                    loadMessages();
                    scrollToBottom();
                }
                //no lo deja enviar si no tiene texto el mensaje.
            });
        }
    });

    // Enviar archivo
    // const sendFileButton = document.getElementById('sendFile');

    // sendFileButton.addEventListener('click', () => {

    // });

    const fileInput = document.getElementById('fileInput');
    const fileLabel = document.getElementById('fileLabel');
    fileInput.addEventListener('change', (event) => {
        const selectedFile = event.target.files[0];
        if (selectedFile) {
            fileLabel.classList.add('file-selected');
            console.log('Archivo seleccionado:', selectedFile.name);
            // Aquí puedes realizar otras acciones, como cargar el archivo o mostrar información adicional.
        }
    });

    function uploadFile(file) {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('user', $('#user').val());
        formData.append('output', $('#output').val());
        formData.append('userC', $('#userChat').val());

        $.ajax({
            url: 'send_file.php', // Ruta del archivo que maneja la subida de archivos
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                fileLabel.classList.remove('file-selected');
                console.log("Archivo enviado correctamente.");
                // Realiza cualquier acción adicional después de cargar el archivo
            }
        });
    }

    function loadMessages() {
        var output = $('#output').val();
        $.ajax({
            url: 'get_message.php', //ruta del archivo que general los mensajes
            type: 'POST',
            data: { output: output },
            success: function (data) {
                $('#chat-messages').html(data);
                if (!userScrolled) {
                    scrollToBottom();
                }
            }
        });
    }

    setInterval(() => {
        loadMessages();
    }, 1000);    // esta función ayuda a actualizar el chat cada 1 segundos

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function isScrollAtBottom() {
        return chatBox.scrollTop + chatBox.clientHeight >= chatBox.scrollHeight;
    }

    chatBox.addEventListener('scroll', function () {
        if (isScrollAtBottom()) {
            // si usuario ha vuelto al fondo, podemos activar el scroll
            userScrolled = false;
        } else {
            // si usuario está viendo mensajes anteriores, desactivar el scroll
            userScrolled = true;
        }
    });
});
