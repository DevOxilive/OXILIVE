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
            // si usuario ha vuelto al fondo, podemos activar el scroll
            userScrolled = false;
        } else {
            // si usuario está viendo mensajes anteriores, desactivar el scroll
            userScrolled = true;
        }
    });
    // esta funcion ayuda a actualizar el chat cada dos segundos
});