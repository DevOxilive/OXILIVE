<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include_once './consulta.php';
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
    <div class="card-header" style="text-align: left;">
                    <a class="btn btn-info" href="#" role="button">Total de Tanques INFRA:           <?php echo $canti ?></a>
                    <a class="btn btn-success" href="#" role="button">Total de Tanques VERDES:          <?php echo $canti2 ?></a>
                    <a class="btn btn-success" href="#" role="button">Total de Tanques Oxilive:          <?php echo $cantiOxi ?></a>
                    <a class="btn btn-success" href="#" role="button">Total de Tanques AEMEH:          <?php echo $cantiAE ?></a>
                    <a class="btn btn-success" href="#" role="button">Total de concentradores:          <?php echo $cantiCON ?></a>

            </div>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="crear.php" role="button"> <i class="bi bi-usb-drive-fill"></i>
                    Agregar Equipo</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table   border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Núm</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_tanques as $tanque) { ?>
                            <tr style="text-align: center;">
                                <th scope="row">
                                    <?php echo $tanque['id_tanques']; ?>
                                </th>
                                <td>
                                    <?php echo $tanque['mar']; ?>
                                </td>
                                <td>
                                    <?php echo $tanque['cantidad']; ?>
                                </td>
                                <td>
                                    <?php echo $tanque['esta']; ?>
                                </td>
                                <td>
                                    <a class="btn btn-outline-warning"
                                        href="editar.php?txtID=<?php echo $tanque['id_tanques']; ?>" role="button"><i
                                            class="bi bi-pencil-square"></i></a> |
                                    <a class="btn btn-outline-danger"
                                        onclick="eliminar(<?php echo $tanque['id_tanques']; ?>)" role="button"><i
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