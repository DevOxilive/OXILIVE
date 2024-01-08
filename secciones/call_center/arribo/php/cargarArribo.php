<?php
include '../../../../connection/conexion.php';

$sql = "SELECT a.id_sv, a.num_paciente, p.nombres, p.apellidos, a.fecha, a.hora, a.moti_consulta, a.num_medico, u.Nombres, a.estado, e.estatus
        FROM asignacion_servicio a INNER JOIN usuarios u, pacientes_call_center p , estatus_callcenter e
        WHERE p.id_pacientes = a.num_paciente AND a.num_medico = u.id_usuarios AND a.estado = e.id_ets;";

$stat = $con->prepare("$sql");
$stat->execute();
$resultados = $stat->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Entrada Arribo</h3>
        <hr>
    </div>
    <div class="card-body">
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
                        if ($filas['estado'] == 1 || $filas['estado'] == 2) {
                            echo '<tr>
                            <td><b>' . $filas['id_sv'] . '</b></td>
                            <td>' . $filas['Nombres'] . '</td>
                            <td>' . $filas['nombres'] . ' ' . $filas['apellidos'] . '</td>
                            <td>' . $filas['estatus'] . '</td>
                            <td>' . $filas['hora'] . '</td>
                          <tr/>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </center>
    </div>
</div>
<br>
<?php
$stat = $con->prepare("$sql");
$stat->execute();
$resultados = $stat->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Historial</h3>
        <hr>
    </div>
    <div class="card-body">
        <center>
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
                        if ($filas['estado'] == 3 || $filas['estado'] == 0) {
                            echo '<tr>
                    <td><b>' . $filas['id_sv'] . '</b></td>
                    <td>' . $filas['Nombres'] . '</td>
                    <td>' . $filas['nombres'] . ' ' . $filas['apellidos'] . '</td>
                    <td>' . $filas['estatus'] . '</td>
                    <td>' . $filas['hora'] . '</td>
                  <tr/>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </center>
    </div>
</div>