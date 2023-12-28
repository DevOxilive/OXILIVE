// $(document).ready(function () {
//     // Evento click para elementos <li> dentro de #listaUsuarios
//     $('#listaUsuarios').on('click', 'li', function () {
//         // Obtén el valor del atributo data-id
//         var selectedId = $(this).data('id');

//         // Realiza la solicitud AJAX a chat.php
//         $.ajax({
//             type: 'GET',
//             url: 'php/chat.php',
//             data: { id: selectedId },
//             success: function (response) {
//                 // Maneja la respuesta si es necesario
//                 console.log(response);

//                 // Puedes redirigir aquí si lo deseas
//                 window.location.href = 'php/chat.php?id=' + selectedId;
//                 // ?id=' + selectedId;
//             },
//             error: function (error) {
//                 // Maneja los errores si es necesario
//                 console.error(error);
//             }
//         });
//     });
// });