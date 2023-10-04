<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("./consulta.php");
  
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <h1 style="text-align:center;">Administradora</h1>
        <div class="card-header" style="text-align: right;">
        
        </div>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="crear.php" role="button">
                    <i class="bi bi-person-workspace"></i> Registrar Administradora
                </a>

            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Núm</th>
                                <th scope="col">Administradora</th>
                                <th scope="col">CPT</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_administradora as $registro) { ?>
                            <tr class="">
                                <th scope="row">
                                    <?php echo $registro['id_admi_enfer']; ?>
                                </th>
                                <td>
                                    <?php echo $registro['Nombre_admi']; ?>

                                </td>
                                <td>
                                    <?php echo $registro['cpt_admi']; ?>
                                </td>
                                <td>
                                    <?php echo $registro['Fecha_registro']; ?>
                                </td>

                                <td style="text-align: center;">
                                <a class="btn btn-outline-success" id="mostrarDiv" href="viewCPT.php?txtID=<?php echo $registro['id_admi_enfer']; ?>" role="button"><i class="bi bi-eye"></i></a>
                                |
                                    <a class="btn btn-outline-warning"
                                        href="editar.php?txtID=<?php echo $registro['id_admi_enfer']; ?>"
                                        role="button"><i class="bi bi-pencil-square"></i></a>
                                    |
                                    <a class="btn btn-outline-danger"
                                        onclick="eliminar(<?php echo $registro['id_admi_enfer']; ?>)" role="button"><i
                                            class="bi bi-trash-fill"></i></a>
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


<!-- ESTO SIRVE PARA ELIMINAR LOS DATOS DESDE LAS ACCIONES DEL INDEX, SE BORRAN UNICAMENTE DESPUES DE CONFIRMAR -->
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
        beforeSend: function() {},
        success: function() {
            Swal.fire("Eliminado:", "Ha sido eliminado", "success").then((result) => {
                window.location.href = "index.php";
            });
        },
    });

}

// ESTO SIRVE PARA DAR ANIMACION Y EL PAGINADO A LAS TABLAS.
const rows = document.querySelectorAll(".animated-border");
rows.forEach(row => {
    row.addEventListener("mouseover", () => {
        row.classList.add("border-animation");
    });
    row.addEventListener("mouseout", () => {
        row.classList.remove("border-animation");
    });
});

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