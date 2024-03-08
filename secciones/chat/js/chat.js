$(document).ready(function () {
    const sendButton = document.getElementById('enviar');
    var text = document.getElementById('texto');
    var file = document.getElementById('archivos');
    var view = document.getElementById('id_recibe');
    var boxMessage = document.getElementById('box-messages');

    function send(msg, exit, doc) {
        if (msg !== '' || doc !== undefined) {
            var formData = new FormData();
            formData.append('text', msg);
            formData.append('view', exit);
            formData.append('doc', doc);

            $.ajax({
                type: 'POST',
                url: 'send_message.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $(boxMessage).html(response);
                },
                error: function (error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        } else {
            console.log("error rico");
        }
    }

    function get() {
        var exit = $(view).val();
        $.ajax({
            type: 'POST',
            url: 'get_message.php',
            data: { view: exit },
            success: function (response) {
                $(boxMessage).html(response);
            }
        })
    }

    $(sendButton).on('click', function () {
        var msg = $(text).val().trim();
        var exit = $(view).val();
        var doc = file.files[0];
        var contentText = /\S/.test(msg);
        if (doc) {
            var extencion = doc.name.split('.').pop().toLowerCase();
            if (extencion !== 'pdf' && extencion !== 'jpg' && extencion !== 'png') {
                alert("el archivo debe tener las siguientes extenciones: pdf, jpg, png");
                file.value = '';
            } else {
                send(msg, exit, doc);
            }
        } else {
            if (contentText) {
                send(msg, exit, doc);
            }
        }
        $(text).val('');
        file.value = '';
    });
    setInterval(() => {
        get();
    }, 500);
})