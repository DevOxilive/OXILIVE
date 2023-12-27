<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../consulta.php");
} else {
    echo "Error en el sistema";
}
?>

<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-body"> <br>
                <h3>MIS RUTAS </h3>
                <div class="table-responsive-sm">
                    <table class="table  border-dark table-hover" id="rutasProcesoTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Num</th>

                                <th scope="col">Fecha ruta</th>
                                <th scope="col">Nombre Paciente</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
    $fecha_actual = date('Y-m-d'); 

    foreach ($pacientes as $paciente) {
        if ($paciente['estado'] != 3 && $paciente['Fecha_agenda'] == $fecha_actual) {
    ?>
            <tr>
                <td><?php echo $paciente['id_ruta']; ?></td>
                <td><?php echo $paciente['Fecha_agenda']; ?></td>
                <td><?php echo $paciente['Paciente']; ?></td>
                <td>
                    <form method="post" action="actualizar_estado.php">
                        <input type="hidden" name="ruta_id" value="<?php echo $paciente['id_ruta']; ?>">
                        <select id="cbestado" name="cbestado" class="form-select" style="color: <?php
                                                                                                if ($paciente['estado'] == 2) {
                                                                                                    echo 'blue';
                                                                                                } elseif ($paciente['estado'] == 1) {
                                                                                                    echo 'orange';
                                                                                                } elseif ($paciente['estado'] == 3) {
                                                                                                    echo 'red';
                                                                                                } else {
                                                                                                    echo 'black'; // Color por defecto si el estado no coincide con ninguna condición
                                                                                                }
                                                                                                ?>">
                            <?php foreach ($lista_estado_entrega as $registro) { ?>
                                <option <?php echo ($paciente['estado'] == $registro['id_estado']) ? "selected" : ""; ?> value="<?php echo $registro['id_estado']; ?>">
                                    <?php echo $registro['estado']; ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Cambiar">
                    </form>
                </td>
            </tr>
    <?php
        }
    }
    ?>
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body"> <br>
                <h3>MIS RUTAS ANTERIORES </h3>
                <div class="table-responsive-sm">
                    <table class="table  border-dark table-hover" id="rutasProcesoTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Num</th>

                                <th scope="col">Fecha ruta</th>
                                <th scope="col">Nombre Paciente</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pacientes as $paciente) { ?>
                                <?php if ($paciente['estado'] == 3) { ?>
                                    <tr>
                                        <td><?php echo $paciente['id_ruta']; ?></td>
                                        <td><?php echo $paciente['Fecha_agenda']; ?></td>
                                        <td><?php echo $paciente['Paciente']; ?></td>
                                        <td style="color: <?php
                                                            if ($paciente['estado'] == 2) {
                                                                echo 'blue';
                                                            } elseif ($paciente['estado'] == 1) {
                                                                echo 'orange';
                                                            } elseif ($paciente['estado'] == 3) {
                                                                echo 'red';
                                                            } else {
                                                                echo 'black'; // Color por defecto si el estado no coincide con ninguna condición
                                                            }
                                                            ?>">
                                            <?php echo $paciente['nombre_estado']; ?>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
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