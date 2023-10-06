<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>token comprueba</title>
</head>

<body>
    <?php
    include '../../../connection/conexion.php';

    do {
        $regresar = false;
        $token = bin2hex(random_bytes(32));

        $checkToken = $con->prepare("SELECT token FROM usuarios");
        $checkToken->execute();
        $existToken = $checkToken->fetchAll(PDO::FETCH_ASSOC);
        foreach ($existToken as $tokenCheck) {
            if ($tokenCheck == $token) {
                $regresar = true;
                echo "son iguales";
            } else {
                $token = bin2hex(random_bytes(32));
                $regresar = false;
            }
        }
        echo "<h1>este es nuevo:</h1><p>{$token} </p><br>";
    } while ($regresar == true);
    ?>
</body>

</html>