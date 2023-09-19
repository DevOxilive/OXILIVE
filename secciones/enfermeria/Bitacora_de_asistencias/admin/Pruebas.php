<?php

    function ejecuta_consulta($labusqueda)
    {


        $conexion= mysqli_connect('localhost','root','');

        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la base de datos";
            exit();
        }

        mysqli_select_db($conexion, "gym") or die("No se encuentra la base de datos.");


        $consulta = "select * FROM pagosclientes  where idCliente like '%$labusqueda%' ";
        $consulta2 = "INSERT INTO `gym`.`registrodiario` (`idPagoCliente`, `idCliente`, `idTipoPeriodo`, `inicio`, `final`,  `costo`) select * FROM pagosclientes  where idCliente like '%$labusqueda%' AND curdate() < final ";

        $resultados = mysqli_query($conexion, $consulta);
        $resultados2 = mysqli_query($conexion, $consulta2);
        $filas = array(); // Crea la variable $filas y se le asigna un array vacío
        // (Si la consulta no devuelve ningún resultado, la función por lo menos va a retornar un array vacío)

        while ($fila=mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
            $filas[] = $fila; // Añade el array $fila al final de $filas
        }

        mysqli_close($conexion);

        return $filas; // Devuelve el array $filas
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sistema de historias médicas - Dr. Darling Davila</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">
</head>

<body>
    <?php
        $mibusqueda=$_GET["buscar"];

        $mipag=$_SERVER["PHP_SELF"];

        if ($mibusqueda!=null) {
            $pacientes = ejecuta_consulta($mibusqueda);
    ?>

        <div id="main-container">
            <table>
                <thead>
                    <tr>
                        <th>idPagoCliente</th>
                        <th>idCliente</th>
                        <th>idTipoPeriodo</th>
                        <th>inicio</th>
                        <th>final</th>
                        <th>costo</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Si la variable $pacientes esta definida y no está vacía
                    if (isset($pacientes) && !empty($pacientes)) {
                        // Recorre cada $paciente dentro del array $pacientes
                        foreach ($pacientes as $paciente) {
                            ?>
                        <tr>
                            <td><?php echo $paciente['idPagoCliente'] ?></td>
                            <td><?php echo $paciente['idCliente'] ?></td>
                            <td><?php echo $paciente['idTipoPeriodo'] ?></td>
                            <td><?php echo $paciente['inicio'] ?></td>
                            <td><?php echo $paciente['final'] ?></td>
                            <td><?php echo $paciente['costo'] ?></td>

                        </tr>
                    <?php
                        }
                    } ?>
                </tbody>
        </div>
    <?php
        } else {
            echo ("<form action='". $mipag . "' method='GET'>

                    <h2>Busqueda de paciente</h2>
                    <div class='contenedor'>
                    <input type='text' name='buscar' class='input-100 text-center inline-block col-md-6 btn-enviar espacio-arriba'></label>

                    <input type='submit' name='enviando' value='Consulta' class='text-center inline-block col-md-12 espacio-arriba btn-enviar'>
                </div>
                </form>");
        }
     ?>

</body>

</html>