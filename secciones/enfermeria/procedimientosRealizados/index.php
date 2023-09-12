<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
  include ("./consultaCPT.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <h1 style="text-align: center;">Procedimientos Realizados</h1>
    <div class="card-header" style="text-align: right;"></div>
    <div class="card">
        <div class="card-header">
            <a class="btn btn-outline-primary" href="./crearCPT.php" role="button"> <i
                    class="bi bi-person-fill-add"></i> Nuevo procedimiento</a>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered  border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Núm</th>
                            <th scope="col">CPT</th>
                            <th scope="col">descripción</th>
                            <th scope="col">unidades</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Operaciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cpt as $_cpt){ ?>
                        <tr>
                            <th scope="row"><?php echo $_cpt['id_cpt']; ?></th>
                            <td><?php echo $_cpt['cpt']; ?></td>
                            <td><?php echo $_cpt['descripcion']; ?></td>
                            <td><?php echo $_cpt['unidades']; ?></td>
                            <td><?php echo $_cpt['fecha']; ?></td>

                            <td>
                                <a name="" id="" class="btn btn-outline-info"
                                    href="pacientes.php?txtID=<?php echo $pacien['id_pacientes']; ?>" role="button"
                                    style="font-size:10px;"><i class="bi bi-printer-fill"></i></a> |

                                <a name="" id="" class="btn btn-outline-warning"
                                    href="editarCPT.php?txtID=<?php echo $_cpt['id_cpt']; ?>" role="button"><i
                                        class="bi bi-pencil-square"></i></a>

                                <a name="" id="" class="btn btn-outline-danger"
                                    onclick="eliminar(<?php echo $_cpt['id_cpt']; ?>)" role="button"
                                    style="font-size:10px;"><i class="bi bi-trash-fill"></i></a>
                            </td>

                        </tr>
                        <?php }?>
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
        url: "./eliminarCPT.php",
        type: "POST",
        beforeSend: function() {},
        success: function() {
            Swal.fire("Eliminado:", "Ha sido eliminado", "success").then((result) => {
                window.location.href = "index.php";
            });
        },

    });



    // Agrega la animación a los bordes de las filas
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
$(document).ready(function() {
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