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
    <h1 style="text-align:center;">Procedimientos Realizados</h1>
    <div class="card-header" style="text-align: right;">
    <?php foreach($imprime as $imprimir){?>
    <a class="btn btn-outline-dark" href="PDF.php?txtID=<?php echo $imprimir['pacienteYnomina']; ?>" role="button"><i class="bi bi-printer-fill"></i></a>
    <?php } ?>
</div>
    <div class="card">
        <div class="card-header">
            <a name="" id="" class="btn btn btn-success" href="index.php" role="button"><i class="bi bi-backspace"></i> Regresar</a>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered  border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Medico</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">CPT</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($idLista as $lista) {?>
                        <tr class="">
                            <td><?php  echo $lista["Medico"]; ?></td>
                            <td><?php  echo $lista["Paciente"]; ?></td>
                            <td><?php  echo $lista["cpt"]; ?></td>
                            <td><?php  echo $lista["descripcion"]; ?></td>
                            <td><?php  echo $lista["unidad"]; ?></td>
                            <td>
                                <a class="btn btn-outline-warning" href="editar.php?txtID=<?php echo $lista['id_procedi']; ?>" role="button"><i class="bi bi-pencil-square"></i></a>
                                <a class="btn btn-outline-danger" onclick="eliminar(<?php echo $lista['id_procedi']; ?>)" role="button"><i class="bi bi-trash-fill"></i></a>                            
                            </td>
                       </tr>
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

const rows = document.querySelectorAll(".animated-border");
rows.forEach(row => {
    row.addEventListener("mouseover", () => {
        row.classList.add("border-animation");
    });
    row.addEventListener("mouseout", () => {
        row.classList.remove("border-animation");
    });
});

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