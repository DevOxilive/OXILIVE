<?php
session_start();
include '../../../../connection/conexion.php';
$id = $_SESSION['idus'];
$stmt = $con->prepare("SELECT s.*,CONCAT (p.nombres,' ',p.apellidos) AS pacientes, b.Nombre_banco, a.Nombre_administradora, p.referencias,c.municipio, c.ciudad, c.codigo_postal, c.nombre AS calle, m.nombre AS municipio
FROM asignacion_servicio s, pacientes_call_center p, bancos b, administradora a , colonias c, municipios m
WHERE s.num_paciente = p.id_pacientes
AND p.bancosAdmi = b.id_bancos
AND b.admi = a.id_administradora
AND p.colonia = c.id
AND c.municipio = m.id
and num_medico = $id
ORDER BY estado asc");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Aquí agrego mi contador de servicios
$conServ = 1;
// se revisa el estado del servicio del medico en tiempo real
if (count($result) > 0) {
    foreach ($result as $key => $value) {
        if ($value['estado'] == 1) {
            ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <h5 style="color: Black"> No.Servicio:
                    <?php echo $conServ++; ?>
                </h5>
                <div class="card-body" class="tenedor" style="text-align: center;">
                    <h2 class="card-title">Tienes un servicio de : <br>
                        <?php echo $value['nom_solicitante'] ?> <i class="bi bi-telephone-inbound"></i>
                    </h2>
                    <h5 class="card-title"> Nombre del paciente:
                        <p class="card-text" style="color:blue">
                            <?php echo $value['pacientes'] ?> 🫡
                        </p>
                        Administradora:
                        <p class="card-text" style="color:red">
                            <?php echo $value['Nombre_administradora'] ?>
                        </p>
                    </h5>
                    <h5 class="card-title">Motivo de Consulta:
                        <p class="card-text" style="color:Blue"><i class="bi bi-emoji-frown"></i>
                            <?php echo $value['moti_consulta'] ?>
                        </p>
                    </h5>
                    <h5 class="card-title">Acudir al lugar:
                        <p id="contenidoACopiar" class="card-text" style="color:Blue">
                            Ciudad:
                            <?php echo $value['ciudad'] ?><br>
                            Calle:
                            <?php echo $value['calle'] ?> <br>
                            Municio:
                            <?php echo $value['municipio'] ?> <br>
                            Cp:
                            <?php echo $value['codigo_postal'] ?><br>
                            Referencias:
                            <?php echo $value['referencias'] ?>
                            <p id="copiado" style="color: red;">----</p>
                        </p>
                        <button type="button" class="btn btn-primary" id="copiarContenido">Copiar 📋</button>

                    </h5>
                    <h5 class="card-title">Acudir a la:
                        <p class="card-text" style="color:Blue">
                            <?php echo $value['hora'] ?> ⏳
                        </p>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card" style="margin-top: 120px;">
                <div class="container d-flex align-items-center flex-column">
                    <h1 style="text-align: center;">Mapa </h1>
                    <iframe class="map-inframe"
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15052.618110601145!2d-98.97974744999998!3d19.405728200000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1700235997194!5m2!1ses-419!2smx"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <p style="text-align:center">Nota: El mapa no te indica donde está; para eso debes copiar el código postal y la calle.</p>
                    <div class="text-center">
                        <button type="button" class="btn btn-success start-service" id="start"
                            data-caso="<?php echo $_SESSION['idus']; ?>"
                            data-sv="<?php echo $value['id_sv'] ?>">Comenzar servicio</button><br><br>
                    </div>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <h5 class="card-title">Servicio en proceso:<i class="bi bi-telephone-inbound"></i></h5>
                    <p class="card-text" style="color:red">
                    </p>
                    </h5>
                    <h5 class="card-title"> Estamos atendiendo
                        <p class="card-text" style="color:blue">
                            <?php echo $value['moti_consulta'] ?> 🥶
                        </p>
                    </h5>
                    <h5 class="card-title"> Atendiendo al paciente:
                        <p class="card-text" style="color:blue">
                            <?php echo $value['pacientes'] ?> 🫡
                        </p>
                    </h5>
                    <!--Aqui voy agregar mi cronometro-->
                    <button type="button" class="btn btn-danger start-service" id="start" disabled
                        data-caso="<?php echo $_SESSION['idus']; ?>" data-sv="<?php echo $value['id_sv'] ?>">Finalizar
                        Incidencia</button><br><br>
                        <div class="cronometro" style="text-align:center">Tiempo restante: <span id="tiempo">5</span> segundos</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
        } else if ($value['estado'] == 3) {
            // echo "servicio terminado";
            ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" style="text-align: center;"><br>
                    <h1 style="color:blue">Incidencia Terminada 😎</h1>
                    <h5 class="card-title"> Se atendio el día:
                        <p class="card-text" style="color:blue">
                            <?php echo $value['fecha'] ?> 🫡
                        </p>
                    </h5>
                    <h5 class="card-title"> Al paciente:
                        <p class="card-text" style="color:blue">
                            <?php echo $value['pacientes'] ?> 🫡
                        </p>
                    </h5>
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
<script>
    document.getElementById('copiarContenido').addEventListener('click', function() {
    var contenido = document.getElementById('contenidoACopiar'); 
    var seleccion = window.getSelection();
    var rango = document.createRange();
    rango.selectNodeContents(contenido);
    seleccion.removeAllRanges();
    seleccion.addRange(rango);
    try {
        document.execCommand('copy');
            var copiado = document.getElementById("copiado").innerHTML = "Copiado Correctamente"; 
    } catch (error) {
        console.error('No se pudo copiar el contenido.');
    }
    seleccion.removeAllRanges();
});
</script>
<script src="js/validacionBoton.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>