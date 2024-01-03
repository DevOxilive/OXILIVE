<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../../templates/header.php");

  include("consultaCreados.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <h1 style="text-align:center;">REGISTROS CLINICOS Y CUIDADOS GENERALES</h1>
    <div class="card-header" style="text-align: right;">
    </div>
    <div class="card">
        <div class="card-header">
        <a name="" id="" class="btn btn-outline-primary" href="../index.php" role="button"> <i
                    class="bi bi-award"></i> Crear Registro</a>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table border-dark table-hover" id="myTable" style="border: 1px solid black">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider">
                        <th scope="col">No.</th>    
                        <th scope="col">Nombre del Paciente</th>
                            <th scope="col">Familiar Responsable:</th>
                            <th scope="col">Nombre del Médico:</th>
                            <th scope="col">Nombre del Enfermero:</th>
                            <th scope="col">Diagnostico del Médico:</th>
                            <th scope="col">Opciones:</th>
                        </tr>
                    </thead>
                    <?php foreach($listaPapus as $registroPaps){ ?>
                    <tbody>
                      <td><?php echo $registroPaps['id_RC'] ?></td>
                      <td><?php echo $registroPaps['paciente'];?></td>
                      <td><?php echo $registroPaps['responsable'];?></td>
                      <td><?php echo $registroPaps['medico'];?></td>
                      <td><?php echo $registroPaps['enfermero'];?></td>
                      <td><?php echo $registroPaps['diagnoticoPaciente'];?></td>
                      <td>
                      <a name="" id="" class="btn btn-outline-info" href="../registro_pdf.php?btnId=<?php echo $registroPaps['id_RC']; ?>" role="button" style="font-size=10px;"><i class="bi bi-file-earmark-pdf"></i></a> |
                      </td>
                    </tbody>
                    <?php } ?>
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

    // Manejar clic en el botón de generación de PDF
    $('.btn-outline-info').click(function(e) {
        e.preventDefault();

        // Obtener la URL del enlace
        var pdfUrl = $(this).attr('href');

        // Abre una nueva ventana o pestaña con la URL del PDF
        window.open(pdfUrl, "_blank");
    });
});
</script>
<script src="../../../../js/tables.js"></script>
<?php
include("../../../../templates/footer.php");
?>