<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>documentos</title>
</head>

<body>
    <a href="verPDF.php" target="_blank">ver pdf</a>
    <form action="mdl.php" method="post" enctype="multipart/form-data">
        <h1>envia tu pdf escaneado</h1>
        <input type="file" name="archivo" id="archivo">
        <br>
        <input type="submit" value="enviar">
    </form>
</body>

</html>