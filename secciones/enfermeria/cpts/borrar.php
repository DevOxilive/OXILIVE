<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
    include("consulta.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
<h1 style="text-align:center;">CPTS</h1>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-outline-warning ml-auto" href="index.php" role="button"> <i class="bi bi-bookmark-x"></i> Regresar</a>
    </div>
</div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered  border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">CPT</th>
                            <th scope="col">Administradora</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($lista_delate as $borrar){ ?> 
                        
                        <tr class="">
                             <td>     
                                <?php echo $borrar['cpt'] ?> 
                            </td> 
                            <td>
                                <?php echo $borrar['Nombre_administradora'] ?>
                            </td>    

                            <td style="text-align: center;">
                                <a class="btn btn-outline-danger" onclick="deleteList(<?php echo $borrar['admi']; ?>)" role="button"><i class="bi bi-trash-fill"></i></a>
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
function deleteList(codigo) {
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
                window.location.href = "borrar.php";
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