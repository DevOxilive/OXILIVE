<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../model/horarios.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Lista de Horarios</h1>
        <br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Horario</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered  border-dark table-hover" id="myTable">
                <thead class="table-dark">
                    <tr class="table-active table-group-divider" style="text-align: center;">
                        <th>Paciente</th>
                        <th>Horario</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableCont">
                </tbody>
            </table>
            <input type="hidden" id="idUs" value="<?php echo $_SESSION['idus']; ?>">
        </div>
    </div>
</main>

</html>
<script>
    $(document).ready(function() {
        $.noConflict();
        $('#myTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            "order": [],
        });
    });
</script>
<script src="../js/indexHorario.js"></script>
<script src="../js/statusHorario.js"></script>

<?php
include("../../../../templates/footer.php");
?>