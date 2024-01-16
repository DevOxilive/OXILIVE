<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../pacientes/consulta.php");
    include("../carros/consulta.php");
    include("../choferes/consulta.php");
    include("./consulta_estado_entrega.php");
    include("../../../model/aseguradora.php");
    include_once './buscarsubmit.php';
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos para generar ruta</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;"> <br>
                <form action="./rutaADD.php" method="POST" class="row g-3">
                    <p style="text-align: center;"><i class="bi bi-person-badge-fill"></i> <b> DATOS DEL PACIENTE </b></p>
                    <label for="Buscar_pacientes" class="form-label">Nombre de paciente</label>
                    <div class="input-group mb-3">
                        <input type="text" value="<?php echo $countryName; ?>" readonly class="form-control" id="Buscar_pacientes" name="Buscar_pacientes" placeholder="Nombre del paciente">
                        <br>
                        <a role="button" href="<?php echo $url_base; ?>secciones/oxigeno/rutas/Buscar.php" name="cancelar" class="btn btn-outline-info"> Buscar de nuevo</a>
                    </div>

                    <div class="col-md-5">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" value="<?php echo $row['municipio']; ?>" readonly class="form-control" name="direccion" id="direccion" placeholder="Direccion">
                    </div>

                    <div class="col-md-2">
                        <label for="Alcaldia" class="form-label">Alcaldia</label>
                        <input type="text" value="<?php echo $row['Alcaldia']; ?>" readonly class="form-control" name="Alcaldia" id="Alcaldia" placeholder="Alcaldia">
                    </div>

                    <div class="col-md-2">
                        <label for="Aseguradora" class="form-label">Núm. Nomina</label>
                        <input type="text" value="<?php echo $row['Aseguradora']; ?>" readonly class="form-control" name="Aseguradora" id="Aseguradora" placeholder="Aseguradora">
                    </div>

                    <div class="col-md-2">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="phone" value="<?php echo $row['Telefono']; ?>" readonly class="form-control" name="telefono" id="telefono" placeholder="Telefono">
                    </div> <br>
                    <p style="text-align: center;"><i class="bi bi-geo-fill"></i> <b> DATOS DE LA RUTA </b></p>
                    <div class="col-md-2">
                        <label for="cbcarro" class="form-label">Carrro</label>
                        <select name="cbcarro" id="cbcarro" class="form-select">
                            <?php foreach ($listacarros as $registro) { ?>
                                <option value="<?php echo $registro['id_carro']; ?>">
                                    <?php echo $registro['Nombre_carro']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="cbchofer" class="form-label">Chofer</label>
                        <select name="cbchofer" id="cbchofer" class="form-select">
                            
                            <?php foreach ($choA as $registro) { ?>
                                <option value="<?php echo $registro['id_choferes']; ?>">
                                    <?php echo $registro['Nombre_completo']; ?></option>
                            <?php  }?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="Tanque" class="form-label">Tanque</label>
                        <input type="number" value="0" class="form-control" name="Tanque" id="Tanque" min="0">
                    </div>

                    <div class="col-md-2">
                        <label for="Regulador" class="form-label">Regulador</label>
                        <input type="number" value="0" class="form-control" name="Regulador" id="Regulador" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="Portatil" class="form-label">Portatil</label>
                        <input type="number" value="0" class="form-control" name="Portatil" id="Portatil" min="0">
                    </div>

                    <div class="col-md-2">
                        <label for="Concentrador" class="form-label">Concentrador</label>
                        <input type="number" value="0" class="form-control" name="Concentrador" id="Concentrador" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="Aspirador" class="form-label">Aspirador</label>
                        <input type="number" value="0" class="form-control" name="Aspirador" id="Aspirador" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="Cpac" class="form-label">Cpac</label>
                        <input type="number" value="0" class="form-control" name="Cpac" id="Cpac" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="Bipac" class="form-label">Bipac</label>
                        <input type="number" value="0" class="form-control" name="Bipac" id="Bipac" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="Agua" class="form-label">Agua</label>
                        <input type="number" value="0" class="form-control" name="Agua" id="Agua" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="PuntasN" class="form-label">Puntas n</label>
                        <input type="number" value="0" class="form-control" name="PuntasN" id="PuntasN" min="0">
                    </div>

                    <div class="col-md-2">
                        <label for="PuntasNeon" class="form-label">Puntas neo</label>
                        <input type="number" value="0" class="form-control" name="PuntasNeon" id="PuntasNeon" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="VasoBorb" class="form-label">Vaso borb</label>
                        <input type="number" value="0" class="form-control" name="VasoBorb" id="VasoBorb" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="Mascarilla" class="form-label">Mascarilla</label>
                        <input type="number" value="0" class="form-control" name="Mascarilla" id="Mascarilla" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="Canula" class="form-label">Canula</label>
                        <input type="number" value="0" class="form-control" name="Canula" id="Canula" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="RecTanque" class="form-label">Rec tanq</label>
                        <input type="number" value="0" class="form-control" name="RecTanque" id="RecTanque" min="0">
                    </div>

                    <div class="col-md-1">
                        <label for="RecAspi" class="form-label">Rec aspi</label>
                        <input type="number" value="0" class="form-control" name="RecAspi" id="RecAspi" min="0">
                    </div>

                    <div class="col-md-2">
                        <label for="RecConcent" class="form-label">Rec concent</label>
                        <input type="number" value="0" class="form-control" name="RecConcent" id="RecConcent" min="0    ">
                    </div>

                    <div class="col-md-5">
                        <label for="Nota" class="form-label">Nota</label>
                        <input type="text" value=" " class="form-control" name="Nota" id="Nota" placeholder="Block de notas">
                    </div>

                    <div class="col-md-3">
                        <label for="FechaEntrega" class="form-label">Fecha de entrega</label>
                        <input type="date" name="FechaEntrega" value="<?php echo date("Y-m-d"); ?>" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" href="<?php echo $url_base; ?>secciones/oxigeno/rutas/index.php" name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
</main>

<?php
include("../../../templates/footer.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    $(function() {
        $("#FechaEntrega").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0
        });
    });