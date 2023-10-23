<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("consulta.php");
} else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="index.php" role="button"><i class="bi bi-person-fill"></i>Regresar</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                         <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Incidencia</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Paciente</th>
                            </tr>
                         </thead>
                         <?php foreach($lista as $consulta){ ?>
                            <tbody>
                                    <tr>
                                        <td><?php echo $consulta['Nombres']; ?></td>
                                        <td><?php echo $consulta['fecha']; ?></td>
                                        <td><?php echo $consulta['moti_consulta']?></td>
                                    </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include("../../../templates/footer.php"); ?>