$(document).ready(function () {
    chatBox = document.querySelector("#chat-container");
    var userScrolled = false; //variable para detectar scroll
    // Cargar mensajes existentes
    loadMessages();
    // Enviar mensaje
    $('#send').click(function () {
<<<<<<< HEAD
        var message = $('#message').val().trim();
        var user = $('#user').val();
        var output = $('#output').val();
        var userC = $('userChat').val();
        // validacion
        var contieneTexto = /\S/.test(message);

        if (contieneTexto) {
=======
        var message = $('#message').val();
        var user = $('#user').val();
        var output = $('#output').val();
        var userC = $('userChat').val();
        if (message !== '') {
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
            $.ajax({
                url: 'send_message.php', //ruta del archivo que envia a la base los mensajes
                type: 'POST',
                data: { user: user, message: message, output: output, userC: userC },
                success: function () {
                    $('#message').val('');
                    loadMessages();
                    scrollToBottom();
                }
<<<<<<< HEAD
                //no lo deja enviar si no tiene texto el mensaje.
=======
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
            });
        }
    });

    function loadMessages() {
        var output = $('#output').val();
        $.ajax({
<<<<<<< HEAD
            url: 'get_message.php', //ruta del archivo que general los mensajes
=======
            url: 'get_message.php', //ruta del archivo que genera los mensajes
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
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