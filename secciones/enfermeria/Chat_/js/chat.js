$(document).ready(function () {
    chatBox = document.querySelector("#chat-container");
    var userScrolled = false;
    // Cargar mensajes existentes
    loadMessages();
    // Enviar mensaje
    $('#send').click(function () {
        var message = $('#message').val();
        var user = $('#user').val();
        if (message !== '') {
            $.ajax({
                url: 'send_message.php',
                type: 'POST',
                data: { user: user, message: message },
                success: function () {
                    $('#message').val('');
                    loadMessages();
                }
            });
        }
    });

    function loadMessages() {
        $.ajax({
            url: 'get_messages.php',
            type: 'POST',
            success: function (data) {
                $('#chat-messages').html(data);
                if (!userScrolled) {
                    scrollToBottom();
                }
            },
            error: function () {
                // Manejar errores
                alert("Error al cargar los mensajes");
            }
        });
    }

    setInterval(() => {
        loadMessages();
    }, 1000);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function isScrollAtBottom() {
        return chatBox.scrollTop + chatBox.clientHeight >= chatBox.scrollHeight;
    }

    chatBox.addEventListener('scroll', function () {
        if (isScrollAtBottom()) {
            // Si el usuario ha vuelto al fondo, desactivar el scroll
            userScrolled = false;
        } else {
            // Si el usuario está viendo mensajes anteriores, activar el scroll
            userScrolled = true;
        }
    });
});