<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../templates/header.php");
  include("./consulta.php");
} else {
  echo "Error en el sistema";
}
?>

<style>
  #customers th {
  text-align: center;
  background-color: #005880;
  color: white;
}
  </style>

<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <h1 style="text-align: center; color:black">Administradoras</h1>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="crear.php" role="button"><i class="bi bi-person-workspace"></i>Registrar Administradora</a>
            </div>
            <div class="espacio-linea"></div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped" id="myTable">
                        <thead id="customers">
                            <tr class="table-active table-group-divider">
                               <th scope="col">Administradora</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_administradora as $registro) { ?>
                            <tr class="" style="text-align: center; ">
                                <td><?php echo $registro['Nombre_administradora']; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn btn-outline-warning"
                                        href="editarAdmin.php?txtID=<?php echo $registro['id_administradora']; ?>" role="button"><i
                                            class="bi bi-pencil-square"></i></a>
                                    |
                                    <a class="btn btn-outline-danger"
                                        onclick="eliminar(<?php echo $registro['id_administradora']; ?>)" role="button"><i
                                            class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
</script>
<script src="../../../js/tables.js"></script>
<?php
include("../../templates/footer.php");
?>