<?php
include '../../../connection/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tokens</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    ::selection {
        background-color: #ADD8E6;
        /* Cambia el color de fondo a azul celeste */
        color: #000;
        /* Cambia el color del texto a negro */
    }
</style>

<body>
    <div class="container">
        <h2>Tokens en para poder usar</h2>
        <div class="col-md-1">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Token usuble</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
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
                            echo "<td>{$token}</td>";
                        } while ($regresar == true);
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Agrega el enlace a los archivos JavaScript de Bootstrap (jQuery y Popper.js) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>