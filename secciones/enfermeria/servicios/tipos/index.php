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
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tipos de Servicio</h3>
                <hr>
                <div class="btn-box justify-content-first">
                    <a class="btn btn-outline-primary" href="crear.php" role="button">
                        <i class="bi bi-heart-pulse"></i> Agregar Servicio
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table border-dark table-hover" id="myTable" style="border: 1px solid black">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Nombre del Servicio</th>
                                <th scope="col">Horas</th>
                                <th scope="col">Paga por unidad</th>
                                <th scope="col">Acciones</th>
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
                                            <a name="" class="btn btn-outline-danger" role="button" href="" onclick="del(event, <?php echo $tipos['id_tipoServicio']; ?>)">
                                                <i class="bi bi-trash-fill"></i>
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
<script>
    const rows = document.querySelectorAll(".animated-border");
    rows.forEach(row => {
        row.addEventListener("mouseover", () => {
            row.classList.add("border-animation");
        });
        row.addEventListener("mouseout", () => {
            row.classList.remove("border-animation");
        });
    });

    function del(e, id) {
        e.preventDefault();
        var $id = id;
        Swal.fire({
            title: '¿Seguro que quieres borrar este servicio?',
            text: 'Esta acción no se podrá deshacer una vez se realice',
            showCancelButton: true,
            width: 700,
            icon: "warning",
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
</script>
<script src="../../../../js/tables.js"></script>
<?php
include("../../../../templates/footer.php");
?>