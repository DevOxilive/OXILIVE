<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("./consultaGen.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
        <div class="card-header" style="text-align: right;">
            <h1 style="text-align:center;">Historial Pacientes Aseguradora</h1>
        </div>
        <div class="card">
            <div class="card-header">
            <button id="mostrarOcultar" class="btn btn-success"><i class="bi bi-people"></i>  Ver pacientes</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr style="text-align: center;">
                                <th scope="col">SHF</th>
                                <th scope="col">BANCO DEL BIENESTAR</th>
                                <th scope="col">NAFIN</th>
                                <th scope="col">INDEP</th>
                                <th scope="col">JCLYFC</th>
                                <th scope="col">FONATUR</th>
                                <th scope="col">CONDUSEF</th>
                                <th scope="col">HSBC</th>
                                <th scope="col">SANTANDER</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">            
                            <td>
                                <a class="btn btn-outline-success" href="./ltr/shf.php" role="button">SHF</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="./ltr/bienestar.php" role="button">BANCO DEL
                                    BIENESTAR</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" href="./ltr/nafin.php" role="button">NAFIN</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-warning" href="./ltr/indep.php" role="button">INDEP</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-secondary" href="./ltr/jclyfc.php" role="button">JCLYFC</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-success" href="./ltr/fonatur.php" role="button">FONATUR</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" href="./ltr/condusef.php" role="button">CONDUSEF</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-warning" href="./ltr/hsbc.php" role="button">HSBC ACTIVOS</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-success" href="./ltr/santander.php" role="button">SANTANDER</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
<br>
 <!--Aqui va ir una lista general con todos-->


<script>
    $(document).ready(function() {
    $('#mostrarOcultar').click(function() {
        $('#miDiv').toggle();
    });
});

</script>
<div id="miDiv" style="display: none;">
 <div class="table-responsive-sm">
                    <table class="table table-bordered table-striped table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">No.P</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Aseguradora</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach($vistaLectura as $vista) {?>
                                <tr class="">
                                     <td>
                                        <?php echo $vista['id_pacientes']; ?>
                                    </td>
                                        
                                    <td>
                                    <?php echo $vista['Nombre']; ?>
                                    </td>
            
                                    <td>
                                    <?php echo $vista['Nombre_aseguradora']; ?>
                                    </td>
                                </tr>
                           <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
                <!--Aquí termina-->
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