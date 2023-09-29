<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("./consultaHoja.php");
    include("./consultaProce.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="card-header" style="text-align: right;">
    <?php foreach ($cpts as $pc) { ?>   
                 <a class="btn btn-outline-dark" href="procePDF.php?txtID=<?php echo $pc['id_proce']; ?>" role="button"><i class="bi bi-printer-fill"></i>Imprimir</a>
        <?php }?>
    </div>
    <div class="card">
        <div class="card-header">
            <a name="" id="" class="btn btn-outline-primary"
            <?php foreach ($cpts as $pc) { ?>
                href="./crearHoja.php?txtID=<?php echo $pc['id_proce']; ?>" role="button"> <i class="bi bi-award"></i> Crear Hoja</a>
            <?php }?>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered  border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">No.</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">CPT</th> 
                            <th scope="col">Descripción</th>
                            <th scope="col">fecha</th>
                            <th scope="col">Unidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cpts as $pc) { ?>   
                            <tr class="">
                                <th scope="row">
                                    <?php echo $pc['id_proce']  ?>
                                </th>
                            <th>
                                <?php echo $pc['pc']  ?>
                            </th>
                            <th>
                                <?php echo $pc['cpt']  ?>
                            </th>
                            <th>
                                <?php echo $pc['descripcion']  ?>
                            </th>
                            <th>
                                <?php echo $pc['unidad']  ?>
                            </th>
                            <th>
                            <?php echo $pc['fecha']  ?>
                            </th>
                            <!--Aquí termina-->
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