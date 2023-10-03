<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../connection/conexion.php");
    include("../../../../templates/header.php");
    include("model/tipos.php");
} else {
    echo "Error en el sistema";
}

?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<main id="main" class="main">
    <div class="pagetitle">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-outline-primary" href="crear.php" role="button">
                        <i class="bi bi-heart-pulse"></i>
                        Agregar Servicio
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered  border-dark table-hover" id="myTable">
                            <thead class="table-dark">
                                <tr class="table-active table-group-divider" style="text-align: center;">
                                    <th scope="col">Nombre del Servicio</th>
                                    <th scope="col">Horas</th>
                                    <th scope="col">Paga por unidad</th>
                                    <th scope="col">Acciones</th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lista_tipos as $tipos) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $tipos['nombreServicio']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $tipos['horasServicio']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            $<?php echo $tipos['sueldo'] ?>
                                        </td>
                                        <td>
                                            <center>
                                                <a name="" id="" class="btn btn-outline-primary" href="editar.php?id=<?php echo $tipos['id_tipoServicio']; ?>" role="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a> |
                                                <a name="" class="btn btn-outline-danger delete" role="button" onclick="del(<?php echo $tipos['id_tipoServicio']; ?>)">
                                                    <i class="bi bi-trash-fill"></i>
                                                    <input type="hidden" id="del">
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
            }
        });
    });

    function del(id) {
        var $id = id;
        Swal.fire({
            title: '¿Seguro que quieres borrar este servicio?',
            text: 'Esta acción no se podrá deshacer una vez se realice',
            showCancelButton: true,
            width: 700,
            confirmButtonText: 'Borrar',
            confirmButtonColor: '#3085d6',
            cancelButtonText: `Cancelar`,
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "model/delete.php",
                    data: {
                        id: $id
                    },
                    success: function() {
                        Swal.fire({
                            position: 'top-end',
                            title: "Servicio borrado correctamente",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            window.location.replace('index.php');
                        });
                    }
                })
            }
        })
    }
    const rows = document.querySelectorAll(".animated-border");
    rows.forEach(row => {
        row.addEventListener("mouseover", () => {
            row.classList.add("border-animation");
        });
        row.addEventListener("mouseout", () => {
            row.classList.remove("border-animation");
        });
    });
</script>
<?php
include("../../../../templates/footer.php");
?>