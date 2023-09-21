$(document).ready(function () {
    chatBox = document.querySelector("#chat-container");
    var userScrolled = false; //variable para detectar scroll
    // Cargar mensajes existentes
    loadMessages();
    // Enviar mensaje
    $('#send').click(function () {
        var message = $('#message').val().trim();
        var user = $('#user').val();
        var output = $('#output').val();
        var userC = $('userChat').val();
        // validacion
        var contieneTexto = /\S/.test(message);

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
    }, 500);

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
    // esta funcion ayuda a actualizar el chat cada 0.5 segundos
});