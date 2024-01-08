<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include_once '../salidas/consulta.php';
} else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <a class="btn btn-outline-dark" href="salidas.php" role="button"><i class="bi bi-printer-fill"></i></a>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="buscar.php" role="button"><i class="bi bi-escape"></i>
                    Dar salida a un Material</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table border-dark table-hover" id="myTable" style="border: 2px solid black">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Núm</th>
                                <th scope="col">Nombre del material</th>
                                <th scope="col">Fecha de salida</th>
                                <th scope="col">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_salida as $salida) { ?>

                                <tr class="">

                                    <th scope="row">
                                        <?php echo $salida['id_salida']; ?>
                                    </th>
                                    <th scope="row">
                                        <?php echo $salida['nombre_matesali']; ?>
                                    </th>
                                    <th scope="row">
                                        <?php echo $salida['fecha_salida']; ?>
                                    </th>
                                    <td style="text-align: center;">
                                    <?php echo $salida['cantidad_salida']; ?>
                                    </td>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function eliminar(codigo) {
        Swal.fire({
            title: '¿Estas seguro?',
            text: "No podrás recuperar los datos",
            cancelButtonText: 'Cancelar',
            icon: 'warning',
            buttons: true,
            showCancelButton: true,
            dangerMode: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                mandar(codigo)
            }
        })
    }

    function mandar(codigo) {
        parametros = {
            id: codigo
        };
        $.ajax({
            data: parametros,
            url: "./eliminar.php",
            type: "POST",
            beforeSend: function () { },
            success: function () {
                Swal.fire("Eliminado:", "Ha sido eliminado", "success").then((result) => {
                    window.location.href = "index.php";
                });
            },
        });

        const rows = document.querySelectorAll(".animated-border");
        rows.forEach(row => {
            row.addEventListener("mouseover", () => {
                row.classList.add("border-animation");
            });
            row.addEventListener("mouseout", () => {
                row.classList.remove("border-animation");
            });
        });
    }
</script>
<script src="../../../js/tables.js"></script>
<?php
include("../../../templates/footer.php");
?>