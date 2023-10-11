<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <?php
        include 'control.php';
        $ruta = './';
        $nombreArchivo = "Proyecto.pdf";

        mostrarPDF($con, $ruta, $nombreArchivo);
        ?>
    </center>
</body>

</html>