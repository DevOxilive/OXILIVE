<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    // include("../../../connection/conexion.php");
    include("../../../model/enfermeros.php");
} else {
    echo "Error en el sistema";
}
?>

<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Enfermeros</h3>
                <hr>
                <div class="btn-box justify-content-first">
                    <a class="btn btn-outline-primary" href="crear.php" role="button">
                        <i class="bi bi-person-fill"></i> Registrar Enfermero
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                   <table class="table table-striped" id="myTable" >
                        <thead class="customers">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Estudio</th>
                                <th scope="col">Curp</th>
                                <th scope="col">Telèfono</th>
                                <th scope="col">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_enfermeros as $enfermeros) { ?>
                                    <tr>
                                        <td><?php echo $enfermeros['nombres_completo']; ?></td>
                                        <td><?php echo $enfermeros['estudio']; ?></td>
                                        <td><?php echo $enfermeros['curp']; ?></td>
                                        <td><?php echo $enfermeros['telefonoUno']; ?></td>
                                        <td style="text-align: center;"><a class="btn btn-outline-warning" href="editar.php?txtID=<?php echo $enfermeros['id_empleado']; ?>" role="button"><i class="bi bi-pencil-square"></i></a></td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</main>
<script src="../../../js/tables.js"></script>
<?php include("../../../templates/footer.php");?>
