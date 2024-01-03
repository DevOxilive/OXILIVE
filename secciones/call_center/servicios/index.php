<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
  include("../servicios/model/consultaServicios.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <!--botón en caso de que se desee agregar un servicio nuevo-->
                <a class="btn btn-outline-primary" href="crearServicio.php" role="button"><i
                        class="fas fa-user-plus"></i>
                    Registrar Servicio</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table border-dark table-hover" id="myTable" style="border: 1px solid black">
                        <thead class="table-dark">
                            <!--títulos de las columnas-->
                            <tr class="table-active table-group-divider">
                                <th scope="col">No</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--$servicioCallcenter trae los datos a través de consultaServicio.php-->
                            <?php foreach ($serviciosCallcenter as $registro) { ?>
                            <!-- El foreach asigna cada valor a la tabla-->
                            <tr class="">
                                <th scope="row">
                                    <?php echo $registro['idServicio']; ?>
                                </th>
                                <th scope="row">
                                    <?php echo $registro['nombreServicio']; ?>
                                </th>
                                <th scope="row">
                                    <?php echo $registro['descripcionServicio']; ?>
                                </th>

                                <td style="text-align: center;">
                                    <!--a través del idServicio se realiza la acción de editar-->
                                    <a class="btn btn-outline-warning"
                                        href="editarServicio.php?txtID=<?php echo $registro['idServicio']; ?>"
                                        role="button"><i class="bi bi-pencil-square"></i></a>
                                    <!--a través del idServicio se realiza la acción de eliminar-->
                                    <a class="btn btn-outline-danger"
                                        onclick="eliminar(<?php echo $registro['idServicio']; ?>)" role="button"><i
                                            class="bi bi-trash-fill"></i></a>
                                </td>
                                <?php } ?>
                        </tbody>
                    </table>
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
        url: "./eliminarServicio.php",
        type: "POST",
        beforeSend: function() {},
        success: function() {
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