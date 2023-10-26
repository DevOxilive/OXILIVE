<?php
include '../../../../connection/conexion.php';

$sql = "SELECT a.id_sv, a.num_paciente, p.nombres, p.apellidos, a.fecha, a.hora, a.moti_consulta, a.num_medico, u.Nombres, a.asignacion 
      FROM asignacion_servicio a INNER JOIN usuarios u, pacientes_call_center p 
      WHERE p.id_pacientes = a.num_paciente AND a.num_medico = U.id_usuarios;";

$stat = $con->prepare("$sql");
$stat->execute();
$resultados = $stat->fetchAll(PDO::FETCH_ASSOC);


?>
<center>
    <table>
        <thead>
            <tr class="historial">
                <th colspan="5">Acciones en tiempo real</th>
            </tr>
            <tr>
                <th>Num</th>
                <th>Medico</th>
                <th>Paciente</th>
                <th>Estado o actividad</th>
                <th>Tiempo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultados as $filas) {
                if ($filas['asignacion'] == 1 || $filas['asignacion'] == 2) {
                    echo '<tr>
                            <td><b>' . $filas['id_sv'] . '</b></td>
                            <td>' . $filas['Nombres'] . '</td>
                            <td>' . $filas['nombres'] . ' ' . $filas['apellidos'] . '</td>
                            <td>' . $filas['asignacion'] . '</td>
                            <td>' . $filas['hora'] . '</td>
                          <tr/>';
                }
            }
            ?>
        </tbody>
    </table>
    <br>
    <?php
    $sql = "SELECT a.id_sv, a.num_paciente, p.nombres, p.apellidos, a.fecha, a.hora, a.moti_consulta, a.num_medico, u.Nombres, a.asignacion 
FROM asignacion_servicio a INNER JOIN usuarios u, pacientes_call_center p 
WHERE p.id_pacientes = a.num_paciente AND a.num_medico = U.id_usuarios;";

    $stat = $con->prepare("$sql");
    $stat->execute();
    $resultados = $stat->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <table>
        <thead>
            <tr class="historial">
                <th colspan="5">historial</th>
            </tr>
            <tr>
                <th>Num</th>
                <th>Medico</th>
                <th>Paciente</th>
                <th>Estado o actividad</th>
                <th>Tiempo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultados as $filas) {
                if ($filas['asignacion'] == 3) {
                    echo '<tr>
                    <td><b>' . $filas['id_sv'] . '</b></td>
                    <td>' . $filas['Nombres'] . '</td>
                    <td>' . $filas['nombres'] . ' ' . $filas['apellidos'] . '</td>
                    <td>' . $filas['asignacion'] . '</td>
                    <td>' . $filas['hora'] . '</td>
                  <tr/>';
                }
            }
            ?>
        </tbody>
    </table>
</center>