<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento rico</title>
</head>

<body>
    <form action="procesar.php" method="POST" enctype="multipart/form-data">
        <label for="imagenes">carga tu imagen aqui para ver la galeria</label>
        <br>
        <input type="file" name="imagen">
        <br>
        <select name="id" id="">
            <?php
            include '../../../../connection/conexion.php';
            $sent = $con->prepare("SELECT * FROM usuarios");
            $sent->execute();
            $resul = $sent->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resul as $value) {
                echo '<option value="'. $value['id_usuarios'] .'">'. $value['Usuario'] .'</option>';
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Enviar">


    </form>
</body>

</html>