<?php
session_start();

if (!isset($_SESSION['us']) ||$_SESSION['puesto'] != 2) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us']) && $_SESSION['puesto'] == 2) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("./consulta_estado_entrega.php");
    include("../../../secciones/oxigeno/rutas/rutaUP.php");
    include("../rutas/consulta.php");
} else {
    echo "Error en el sistema";
}


?>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar ruta</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;"> <br>
                <form action="./rutaUP.php" method="POST" id="formulario" class="row g-3">
                    <label for="Buscar_pacientes" class="form-label">Nombre de paciente</label>
                    <div class="input-group mb-3">

                        <input type="text" value="<?php echo $Paciente; ?>" readonly class="form-control"
                            id="Buscar_pacientes" name="Buscar_pacientes">
                    </div>

                    <div class="contenido col-md-1">
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                            id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="col-md-5">
                        <label for="Direccion" class="form-label">Direccion</label>
                        <input type="text" value="<?php echo $Direccion; ?>" readonly class="form-control"
                            name="Direccion" id="Direccion" placeholder="Direccion">
                    </div>

                    <div class="col-md-3">
                        <label for="Alcaldia" class="form-label">Alcaldia</label>
                        <input type="text" value="<?php echo $Alcaldia; ?>" readonly class="form-control"
                            name="Alcaldia" id="Alcaldia" placeholder="Alcaldia">
                    </div>

                    <div class="col-md-3">
                        <label for="Aseguradora" class="form-label">Aseguradora</label>
                        <input type="text" value="<?php echo $aseguradora ?>" readonly class="form-control"
                            name="Aseguradora" id="Aseguradora" placeholder="Aseguradora">
                    </div>

                    <div class="col-md-2">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="phone" value="<?php echo $Telefono; ?>" readonly class="form-control"
                            name="telefono" id="telefono" placeholder="Telefono">
                    </div>
                    <div class="col-md-1">
                        <label for="Tanque" class="form-label">Tanque</label>
                        <input type="number" value="<?php echo $Tanque; ?>" class="form-control" name="Tanque"
                            id="Tanque">
                    </div>

                    <div class="col-md-2">
                        <label for="Regulador" class="form-label">Regulador</label>
                        <input type="number" value="<?php echo $Regulador; ?>" class="form-control" name="Regulador"
                            id="Regulador">
                    </div>

                    <div class="col-md-1">
                        <label for="Portatil" class="form-label">Portatil</label>
                        <input type="number" value="<?php echo $Portatil; ?>" class="form-control" name="Portatil"
                            id="Portatil">
                    </div>

                    <div class="col-md-2">
                        <label for="Concentrador" class="form-label">Concentrador</label>
                        <input type="number" value="<?php echo $Concentrador; ?>" class="form-control"
                            name="Concentrador" id="Concentrador">
                    </div>

                    <div class="col-md-1">
                        <label for="Aspirador" class="form-label">Aspirador</label>
                        <input type="number" value="<?php echo $Aspirador; ?>" class="form-control" name="Aspirador"
                            id="Aspirador">
                    </div>

                    <div class="col-md-1">
                        <label for="Cpac" class="form-label">Cpac</label>
                        <input type="number" value="<?php echo $Cpac; ?>" class="form-control" name="Cpac" id="Cpac">
                    </div>

                    <div class="col-md-1">
                        <label for="Bipac" class="form-label">Bipac</label>
                        <input type="number" value="<?php echo $Bipac; ?>" class="form-control" name="Bipac" id="Bipac">
                    </div>

                    <div class="col-md-1">
                        <label for="Agua" class="form-label">Agua</label>
                        <input type="number" value="<?php echo $Agua; ?>" class="form-control" name="Agua" id="Agua">
                    </div>

                    <div class="col-md-1">
                        <label for="PuntasN" class="form-label">Puntas n</label>
                        <input type="number" value="<?php echo $Puntas_n; ?>" class="form-control" name="PuntasN"
                            id="PuntasN">
                    </div>

                    <div class="col-md-2">
                        <label for="PuntasNeon" class="form-label">Puntas neon</label>
                        <input type="number" value="<?php echo $Puntas_neon; ?>" class="form-control" name="PuntasNeon"
                            id="PuntasNeon">
                    </div>

                    <div class="col-md-1">
                        <label for="VasoBorb" class="form-label">Vaso borb</label>
                        <input type="number" value="<?php echo $Vaso_borb; ?>" class="form-control" name="VasoBorb"
                            id="VasoBorb">
                    </div>

                    <div class="col-md-1">
                        <label for="Mascarilla" class="form-label">Mascarilla</label>
                        <input type="number" value="<?php echo $Mascarilla; ?>" class="form-control" name="Mascarilla"
                            id="Mascarilla">
                    </div>

                    <div class="col-md-1">
                        <label for="Canula" class="form-label">Canula</label>
                        <input type="number" value="<?php echo $Canula; ?>" class="form-control" name="Canula"
                            id="Canula">
                    </div>

                    <div class="col-md-1">
                        <label for="RecTanque" class="form-label">Rec tanq</label>
                        <input type="number" value="<?php echo $Recoleccion_tanque; ?>" class="form-control"
                            name="RecTanque" id="RecTanque">
                    </div>

                    <div class="col-md-1">
                        <label for="RecAspi" class="form-label">Rec aspi</label>
                        <input type="number" value="<?php echo $Recoleccion_aspi; ?>" class="form-control"
                            name="RecAspi" id="RecAspi">
                    </div>

                    <div class="col-md-2">
                        <label for="RecConcent" class="form-label">Rec concent</label>
                        <input type="number" value="<?php echo $Recoleccion_concentrador; ?>" class="form-control"
                            name="RecConcent" id="RecConcent">
                    </div>

                    <div class="col-md-5">
                        <label for="Nota" class="form-label">Nota</label>
                        <input type="text" value=" <?php echo $Nota; ?>" class="form-control" name="Nota" id="Nota"
                            placeholder="Block de notas">
                    </div>

                    <div class="col-md-3">
                        <label for="FechaEntrega" class="form-label">Fecha de entrega</label>
                        <input type="date" value="<?php echo $Fechaagenda; ?>" required name="FechaEntrega"
                            id="FechaEntrega" class="form-control">
                    </div>

                    <div class="contenido col-md-2">
                        <label for="cbestatus" class="form-label">Estado</label>
                        <select id="cbestatus" name="cbestatus" class="form-select">
                            <?php foreach ($lista_estado_entrega as $registro) { ?>
                                <option <?php echo ($cbestatus == $registro['id_estado']) ? "selected" : ""; ?>
                                    value="<?php echo $registro['id_estado']; ?>">
                                    <?php echo $registro['estado']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="card">
                    <div class="card-header">
                            <p class="btn btn-outline-success"><i class="bi bi-calendar-week-fill"></i> Rutas en proceso
                            </p>
                        </div>
                        <div class="card-body">
                            <table class="table table-success-border-subtle table-striped-columns ">
                                <thead>
                                    <tr>
                                        <th scope="col">PACIENTE</th>
                                        <th scope="col">ASEGURADORA</th>
                                        <th scope="col">TELEFONO</th>
                                        <th scope="col">TANQUE</th>
                                        <th scope="col">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $fechaSeleccionada = $Fechaagenda;
                                    $sentencia = $con->prepare(" SELECT ad.Nombre_administradora AS Nombre_Usuario, rd.*
                                    FROM ruta_diaria_oxigeno rd
                                    JOIN aseguradoras a ON rd.Aseguradora = a.id_aseguradora
                                    JOIN administradora ad ON a.administradora = ad.id_administradora
                                    WHERE ad.Nombre_administradora = :us
                                    AND rd.Fecha_agenda = :fecha
                                    AND rd.estado != 3");
                                    $sentencia->bindParam(":us", $us);
                                    $sentencia->bindParam(':fecha', $fechaSeleccionada);
                                    $sentencia->execute();
                                    $lista_fecha = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                                    if ($sentencia) {
                                        foreach ($lista_fecha as $registro) {
                                            $paciente = $registro['Paciente'];
                                            $aseguradora = $registro['Aseguradora'];
                                            $telefono = $registro['Telefono'];
                                            $tanque = $registro['Tanque'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $paciente; ?>
                                                </td>
                                                <td>
                                                    <?php echo $aseguradora; ?>
                                                </td>
                                                <td>
                                                    <?php echo $telefono ?>
                                                </td>
                                                <td>
                                                    <?php echo $tanque ?>
                                                </td>
                                                <td>
                                                    <a name="" id="" class="btn btn-outline-warning"
                                                        href="editar.php?txtID=<?php echo $registro['id_ruta']; ?>"
                                                        role="button"><i class="bi bi-pencil-square"></i> </a> |
                                                    <a name="" id="" class="btn btn-outline-danger"
                                                        href="rutaDEL.php?txtID=<?php echo $txtID; ?>&eliminar=<?php echo $txtID; ?>"
                                                        role="button"><i class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <p class="btn btn-outline-dark"><i class="bi bi-calendar-check-fill"></i> Rutas terminadas
                            </p>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">PACIENTE</th>
                                        <th scope="col">ASEGURADORA</th>
                                        <th scope="col">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $fechaSeleccionada = $Fechaagenda;
                                    $sentencia = $con->prepare("SELECT * FROM ruta_diaria_oxigeno WHERE Fecha_agenda = :fecha and estado = 3");
                                    $sentencia->bindParam(':fecha', $fechaSeleccionada);
                                    $sentencia->execute();
                                    $lista_fecha = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                                    if ($sentencia) {
                                        foreach ($lista_fecha as $registro) {
                                            $paciente = $registro['Paciente'];
                                            $aseguradora = $registro['Aseguradora'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $paciente; ?>
                                                </td>
                                                <td>
                                                    <?php echo $aseguradora; ?>
                                                </td>
                                                <td>
                                                    <a name="" id="" class="btn btn-outline-danger"
                                                        href="rutaDEL.php?txtID=<?php echo $txtID; ?>&eliminar=<?php echo $txtID; ?>"
                                                        role="button"><i class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-primary" onclick="guardarDatos()">Guardar</button>
                                <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
                            </div>
                        </div>
                    </div>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>

    function mostrarAlertaCancelar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Los cambios no se guardarán',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Remunicipioar a la página de inicio o realizar alguna acción adicional
                window.location.href = '<?php echo $url_base; ?>secciones/Padministradora/rutas/index.php';
            }
        })
    }
</script>
<?php
include("../../../templates/footer.php");
?>