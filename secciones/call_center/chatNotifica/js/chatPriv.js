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
        var userC = $('#userChat').val();
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

    // Enviar archivo
    const fileInput = document.getElementById('fileInput');
    const sendFileButton = document.getElementById('sendFile');

    sendFileButton.addEventListener('click', () => {
        const selectedFile = fileInput.files[0];
        if (selectedFile) {
            // Sube el archivo seleccionado
            uploadFile(selectedFile);
            // Limpia el campo de archivo
            fileInput.value = ''; // Esto restablecerá el campo de archivo
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
    }, 500);    // esta función ayuda a actualizar el chat cada 0.5 segundos

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
// $(document).ready(function () {
//     chatBox = document.querySelector("#chat-container");
//     var userScrolled = false; //variable para detectar scroll
//     // Cargar mensajes existentes
//     loadMessages();
//     // Enviar mensaje
//     $('#send').click(function () {
//         var message = $('#message').val().trim();
//         var user = $('#user').val();
//         var output = $('#output').val();
//         var userC = $('userChat').val();
//         // validacion
//         var contieneTexto = /\S/.test(message);

//         if (contieneTexto) {

//             $.ajax({
//                 url: 'send_message.php', //ruta del archivo que envia a la base los mensajes
//                 type: 'POST',
//                 data: { user: user, message: message, output: output, userC: userC },
//                 success: function () {
//                     $('#message').val('');
//                     loadMessages();
//                     scrollToBottom();
//                 }
//                 //no lo deja enviar si no tiene texto el mensaje.

//             });
//         }
//     });


//     // // Enviar archivo
//     // const fileInput = document.getElementById('fileInput');
//     // const sendFileButton = document.getElementById('sendFile');

//     // // fileInput.addEventListener('change', (event) => {
//     // //     const selectedFile = event.target.files[0];
//     // //     if (selectedFile) {
//     // //         // Habilita el botón de enviar archivo una vez que se selecciona un archivo
//     // //         sendFileButton.removeAttribute('disabled');
//     // //         console.log('Archivo seleccionado:', selectedFile.name);
//     // //     }
//     // // });

//     // sendFileButton.addEventListener('click', () => {
//     //     const selectedFile = fileInput.files[0];
//     //     if (selectedFile) {
//     //         // Sube el archivo seleccionado
//     //         uploadFile(selectedFile);
//     //     }
//     // });

//     // function uploadFile(file) {
//     //     const formData = new FormData();
//     //     formData.append('file', file);
//     //     formData.append('user', $('#user').val());
//     //     formData.append('output', $('#output').val());
//     //     formData.append('userC', $('#userChat').val());

//     //     $.ajax({
//     //         url: 'send_file.php', // Ruta del archivo que maneja la subida de archivos
//     //         type: 'POST',
//     //         data: formData,
//     //         processData: false,
//     //         contentType: false,
//     //         success: function () {
//     //             formData.append('file', file);
//     //             console.log("envio correcto del archivo desde el ajax");
//     //             // Realiza cualquier acción adicional después de cargar el archivo
//     //         }
//     //     });
//     // }
//     // Enviar archivo
//     const fileInput = document.getElementById('fileInput');
//     const sendFileButton = document.getElementById('sendFile');

//     fileInput.addEventListener('change', (event) => {
//         const selectedFile = event.target.files[0];
//         if (selectedFile) {
//             // Cambia el color del botón a verde cuando se selecciona un archivo
//             sendFileButton.style.backgroundColor = 'green';
//         } else {
//             // Restablece el color original del botón
//             sendFileButton.style.backgroundColor = '';
//         }
//     });

//     sendFileButton.addEventListener('click', () => {
//         const selectedFile = fileInput.files[0];
//         if (selectedFile) {
//             // Sube el archivo seleccionado
//             uploadFile(selectedFile);
//             // Limpia el campo de archivo
//             fileInput.value = ''; // Esto restablecerá el campo de archivo
//         }
//     });

//     // Restablece el color original del botón cuando el campo de archivo está vacío
//     fileInput.addEventListener('click', () => {
//         if (!fileInput.value) {
//             sendFileButton.style.backgroundColor = '';
//         }
//     });

//     // Restablece el color original del botón cuando el campo de archivo se cancela
//     fileInput.addEventListener('change', () => {
//         if (!fileInput.value) {
//             sendFileButton.style.backgroundColor = '';
//         }
//     });

//     // Restablece el color original del botón cuando el campo de archivo pierde el foco
//     fileInput.addEventListener('blur', () => {
//         if (!fileInput.value) {
//             sendFileButton.style.backgroundColor = '';
//         }
//     });

//     // Restablece el color original del botón cuando se inicia el documento
//     if (!fileInput.value) {
//         sendFileButton.style.backgroundColor = '';
//     }

// function uploadFile(file) {
//     const formData = new FormData();
//     formData.append('file', file);
//     formData.append('user', $('#user').val());
//     formData.append('output', $('#output').val());
//     formData.append('userC', $('#userChat').val());

//     $.ajax({
//         url: 'send_file.php', // Ruta del archivo que maneja la subida de archivos
//         type: 'POST',
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function () {
//             formData.append('file', file);
//             console.log("Archivo enviado correctamente.");
//             // Realiza cualquier acción adicional después de cargar el archivo
//         }
//     });


//     function loadMessages() {
//         var output = $('#output').val();
//         $.ajax({
//             url: 'get_message.php', //ruta del archivo que general los mensajes

//             type: 'POST',
//             data: { output: output },
//             success: function (data) {
//                 $('#chat-messages').html(data);
//                 if (!userScrolled) {
//                     scrollToBottom();
//                 }
//             }
//         });
//     }

//     setInterval(() => {
//         loadMessages();
//     }, 500);    // esta funcion ayuda a actualizar el chat cada 0.5 segundos

//     function scrollToBottom() {
//         chatBox.scrollTop = chatBox.scrollHeight;
//     }

//     function isScrollAtBottom() {
//         return chatBox.scrollTop + chatBox.clientHeight >= chatBox.scrollHeight;
//     }

//     chatBox.addEventListener('scroll', function () {
//         if (isScrollAtBottom()) {
//             // si usuario ha vuelto al fondo, podemos activar el scroll
//             userScrolled = false;
//         } else {
//             // si usuario está viendo mensajes anteriores, desactivar el scroll
//             userScrolled = true;
//         }
//     });
// });
