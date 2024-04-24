<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="prueba.css">
    <title>pruebas notificaciones, primeros vistasos</title>
</head>

<body>
    <div id="caja_de_notificacion">
        <div id="camapana">Campana</div>
        <div id="contador"></div>
    </div>
    <div id="notificaciones"></div>
    <script>
        $(document).ready(function() {
            caja = document.getElementById('notificaciones');
            cajaCount = document.getElementById('contador')
            cont = 0;
            text = '';
            $.ajax({
                url: 'pruebas2.php',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    text += '<lu>';
                    $.each(response, function(index, notificacion) {
                        text += '<li>' + notificacion.titulo + ':' + notificacion.texto + '</li>';
                        cont++;
                    })
                    text += '</lu>';
                    console.log(cont)
                    $(caja).html(text);
                    $(cajaCount).html(cont);
                }
            })
        })
    </script>
</body>

</html>