<?php
session_start();
include '../../../../connection/conexion.php';
$id = $_SESSION['idus'];
$stmt = $con->prepare("SELECT * FROM asignacion_servicio WHERE num_medico = $id");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Aquí agrego mi contador de servicios
$conServ = 1;
// se revisa el estado del servicio del medico en tiempo real
if (count($result) > 0) {
    foreach ($result as $key => $value) {
        if ($value['estado'] == 1) {
            // echo "Tienes un servicio"; 
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                           No.Servicio: <?php echo $conServ++; ?>
                            <div class="card-body" style="text-align: center;">
                            <h5 class="card-title">Tienes un servicio de : <br>
                                    <?php echo $value['nom_solicitante'] ?> <i class="bi bi-telephone-inbound"></i>
                                </h5>
                                <h5 class="card-title">Motivo de Consulta:
                                    <p class="card-text" style="color:red"><i class="bi bi-emoji-frown"></i>
                                        <?php echo $value['moti_consulta'] ?>
                                    </p>
                                </h5>
                                <p class="card-text">Hora
                                    <?php echo $value['hora'] ?>
                                </p>
                                <button type="button" class="btn btn-success start-service" id="start"
                                    data-caso="<?php echo $_SESSION['idus']; ?>" data-sv="<?php echo $value['id_sv'] ?>">comenzar
                                    servicio</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else if ($value['estado'] == 2) {
            // echo "servicio en proceso";

            ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" style="text-align: center;">
                                    <h5 class="card-title">Servicio en proceso:<i class="bi bi-telephone-inbound"></i></h5>
                                    <p class="card-text" style="color:red"><i class="bi bi-emoji-frown"></i>
                                    <?php echo $value['moti_consulta'] ?>
                                    </p>
                                    </h5>
                                    <!--Aqui voy agregar mi cronometro-->
                                    <button type="button" class="btn btn-danger start-service" id="start" disabled
                                        data-caso="<?php echo $_SESSION['idus']; ?>"
                                        data-sv="<?php echo $value['id_sv'] ?>">terminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="cronometro" style="text-align:center">Tiempo restante: <span id="tiempo">10</span> segundos</div>
            <?php
        } else if ($value['estado'] == 3) {
            // echo "servicio terminado";
            ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body" style="text-align: center;"><br>
                                        <h1 style="color:red">Incidencia Terminada <i class="bi bi-emoji-laughing"></i> </h1>
                                        <a class="btn btn-success" href="../camara/camara.php"><i class="bi bi-camera"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php  
        }
    }
} else {
    echo "no hay servicios";
}
?>
<script src="js/validacionBoton.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

