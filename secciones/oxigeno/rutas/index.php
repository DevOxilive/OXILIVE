<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../cerrar.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../rutas/consulta.php");
} else {
    echo "Error en el sistema";
}
?>

<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="Buscar.php" role="button">
                    <i class="bi bi-truck-front-fill"></i> Generar ruta
                </a>
                <a class="btn btn-outline-primary" href="../rutas/reportes.php" role="button">
                    <i class="bi bi-file-text"></i> Reporte General
                </a>
            </div>
            <div class="card-body">
                <h3>Rutas </h3>
                <div class="table-responsive-sm">
                    <table class="table  border-dark table-hover" id="rutasProcesoTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Num</th>
                                
                                <th scope="col">Fecha ruta</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $ultima_fecha="";
                            foreach ($pacientes as $registro) {
                                if ($registro['estado'] != 3) {
                                    $fecha_actual = $registro['Fecha_agenda'];
                                    if ($fecha_actual != $ultima_fecha) {
                            ?>
                                    <tr class="ruta-row" data-fecha="<?php echo $registro['Fecha_agenda']; ?>">
                                        <th scope="row"><?php echo $registro['id_ruta']; ?></th>
                                        <td><?php echo $fecha_actual; ?></td>
                                        <td>
                                        <a class="btn btn-outline-warning" href="editar.php?txtID=<?php echo $registro['id_ruta']; ?>" role="button"><i class="bi bi-pencil-square custom-outline"></i></a>
                                            </a> |
                                             <a name="" id="" class="btn btn-outline-danger" onclick="eliminar(<?php echo $registro['id_ruta']; ?>)" role="button">
                                             <i class="bi bi-trash-fill"></i></a>
                                             |
                                            <a name="" id="" class="btn btn-outline-success btn-imprimir" href="reporte_pdf.php?fecha=<?php echo $fecha_actual; ?>">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                                $ultima_fecha = $fecha_actual; // Actualizar la variable auxiliar con la nueva fecha
                            }
                        }
                            ?>
                        </tbody>
                    </table>
                </div>

                
            </div>


            <div class="card-body">
                <h3>TERMINADO   </h3>
                <div class="table-responsive-sm">
                    <table class="table  border-dark table-hover" id="rutasProcesoTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Num</th>
                                
                                <th scope="col">Fecha ruta</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $ultima_fecha="";
                            foreach ($lista_ruta as $registro) {
                                if ($registro['estado'] == 3) {
                                    $fecha_actual = $registro['Fecha_agenda'];
                                    if ($fecha_actual != $ultima_fecha) {
                            ?>
                                    <tr class="ruta-row" data-fecha="<?php echo $registro['Fecha_agenda']; ?>">
                                        <th scope="row"><?php echo $registro['id_ruta']; ?></th>
                                        <td><?php echo $fecha_actual; ?></td>
                                        <td>
                                        <a class="btn btn-outline-warning" href="editar.php?txtID=<?php echo $registro['id_ruta']; ?>" role="button"><i class="bi bi-pencil-square custom-outline"></i></a>
                                            </a> |
                                             <a name="" id="" class="btn btn-outline-danger" onclick="eliminar(<?php echo $registro['id_ruta']; ?>)" role="button">
                                             <i class="bi bi-trash-fill"></i>                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                                $ultima_fecha = $fecha_actual; // Actualizar la variable auxiliar con la nueva fecha
                            }
                        }
                            ?>
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
            title: '¿Estás seguro?',
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
            beforeSend: function() {},
            success: function() {
                Swal.fire("Eliminado:", "Ha sido eliminado", "success").then((result) => {
                    window.location.href = "index.php";
                });
            },
        });
    }

    $(document).ready(function() {
        $.noConflict();

        $('#rutasProcesoTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });

        $('#rutasTerminadasTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });
    });




</script>

<?php
include("../../../templates/footer.php");



?>
