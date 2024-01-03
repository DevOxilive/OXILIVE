<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
    include("consulta.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
<?php if (!empty($idLista)) { ?>
    <h1 style="text-align:center;">Historial de <?php echo $idLista[0]['Paciente'];?></h1>
    <div class="card-header" style="text-align: right;">
    <a class="btn btn-outline-dark" href="PDF.php?txtID=<?php echo $idLista[0]['pacienteYnomina']; ?>" role="button"><i class="bi bi-printer-fill"></i></a>
<?php } ?>

</div>
    <div class="card">
        <div class="card-header">
            <a name="" id="" class="btn btn btn-success" href="index.php" role="button"><i class="bi bi-backspace"></i> Regresar</a>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table   border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Lo atendio el medico</th>
                            <th scope="col">Fecha de consulta</th>
                            <th scope="col">Edad</th>
                            <!-- <th scope="col">Municipio</th> -->
                            <th scope="col">colonia</th>
                            <th scope="col">RFC</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($idLista as $lista) {?>
                        <tr class="">
                            <td><?php  echo $lista["Medico"]; ?></td>
                            <td><?php  echo $lista["Fecha_registro"]; ?></td>
                            <td><?php  echo $lista["Edad"]; ?></td>
                            <!-- <td><?php  echo $lista["municipio"]; ?></td> -->
                            <td><?php  echo $lista["colonia"]; ?></td>
                            <td><?php  echo $lista["rfc"]; ?></td>
                       </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
include("../../../templates/footer.php");
?>