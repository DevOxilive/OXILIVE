<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
  include_once("../../../model/empleados.php");
} else {
  echo "Error en el sistema";
}
?>

<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Empleados</h3>
                <hr>
                <?php if ($_SESSION['puesto'] == 1 || $_SESSION['puesto'] == 7) { ?>
                <div class="btn-box justify-content-first">
                    <a class="btn btn-outline-primary" href="crear.php" role="button">
                        <i class="bi bi-person-fill-add"></i> Nuevo Empleado
                    </a>
                </div>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped" id="myTable">
                        <thead class="customers">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Nombre</th>
                                <th scope="col">Area</th>
                                <th scope="col">Contrato</th>
                                <th scope="col">Fecha de Alta</th>
                                <?php if ($_SESSION['puesto'] == 1 || $_SESSION['puesto'] == 7) { ?>
                                <th scope="col">Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach($listadoEmpleados as $listado){ ?>
                            <tr class="" style="text-align: center; ">
                                <td><?php echo $listado['nombres'];?></td>
                                <td><?php echo $listado['Nombre_puestos']; ?></td>
                                <td>
                                    <span
                                        class="badge text-bg-success <?php echo ($listado['contrato'] == 'SI CONTRATADO') ? 'success' :'text-bg-danger'; ?> fs-6">
                                        <?php echo $listado['contrato']; ?>
                                    </span>
                                </td>
                                <td><?php echo $listado['fechaRegistro'] ?></td>
                                <td><a class="btn btn-outline-warning"
                                        href="editar.php?txtID=<?php echo $listado['id_empleado']; ?>" role="button"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-outline-success" href="empleados.php?txtID=<?php echo $listado['id_empleado']; ?>" role="button">
                                    <i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </section>
</main>
<script src="../../../js/tables.js"></script>
<?php
include("../../../templates/footer.php");
?>