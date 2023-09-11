<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include_once '../materiales/consulta.php';
} else {
    echo "Error en el sistema";
}
?>
<style>
    .rojo {
        color: red;
    }

    .orange {
        color: orange;
    }

    .verde {
        color: green;
    }
</style>
<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <a class="btn btn-outline-dark" href="materiales.php" role="button"><i class="bi bi-printer-fill"></i></a>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="crear.php" role="button"><i
                        class="bi bi-file-earmark-plus-fill"></i>
                    Registrar nuevo Material / Producto</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Núm</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Tipo de material</th>
                                <th scope="col">Fecha de entrada</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_almacen as $alma) { ?>

                                <tr class="">

                                    <th scope="row">
                                        <?php echo $alma['id_almacen']; ?>
                                    </th>
                                    <th scope="row">
                                        <?php echo $alma['nombre']; ?>
                                    </th>
                                    <th scope="row">
                                        <?php echo $alma['tipo']; ?>
                                    </th>
                                    <th scope="row">
                                        <?php echo $alma['fecha_entrada']; ?>
                                    </th>
                                    <td style="text-align: center;">
                                        <?php
                                        $cantidad = $alma['cantidad'];
                                        $clase_color = '';

                                        if ($cantidad < $alma['cantidad_adecuada'] * 0.25) {
                                            $clase_color = 'rojo';
                                        } elseif ($cantidad >= $alma['cantidad_adecuada'] * 0.25 && $cantidad <= $alma['cantidad_adecuada'] * 0.74) {
                                            $clase_color = 'orange';
                                        } else {
                                            $clase_color = 'verde';
                                        }
                                        ?>

                                        <span class="<?php echo $clase_color; ?>"><?php echo $cantidad; ?></span>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-outline-warning"
                                            href="editar.php?txtID=<?php echo $alma['id_almacen']; ?>" role="button"><i
                                                class="bi bi-pencil-square"></i></a>
                                        |
                                        <a class="btn btn-outline-danger"
                                            onclick="eliminar(<?php echo $alma['id_almacen']; ?>)" role="button"><i
                                                class="bi bi-trash-fill"></i></a>
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

    $(document).ready(function () {
        $.noConflict();

        $('#myTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });
    });
</script>
<?php
include("../../../templates/footer.php");
?>