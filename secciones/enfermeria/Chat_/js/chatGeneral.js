
$(document).ready(function () {
    chatBox = document.querySelector("#chat-container");
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
                scrollToBottom();
            }
        });
    }

    setInterval(() => {
        loadMessages();
    }, 1000);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    // esta funcion ayuda a actualizar el chat cada dos segundos
});

