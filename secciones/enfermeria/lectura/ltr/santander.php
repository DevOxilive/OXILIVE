<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
}  elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("./consulta.php");
}
else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
    <h1 style="text-align:center;">Esta en HSBC</h1>
    <div class="card-header" style="text-align: left;">
    <a class="btn btn-outline-dark" href="../index.php" role="button"><i class="bi bi-bank"></i> Salir</a>
        </div>
        <div class="card">
            <div class="card-header">        
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">No.P</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($id_lectS as $ltrS) { ?>
                                <tr class="">
                                     <td>
                                        <?php echo $ltrS['id_pacientes']; ?>
                                    </td>

                                    <td>
                                        <?php echo $ltrS['Nombres']; ?>
                                    </td>

                                    <td style="text-align: center;">
                                    <a class="btn btn-info" id="mostrarDiv" href="../historialPaciente.php?txtID=<?php echo $ltrS['id_pacientes']; ?>" role="button"><i class="bi bi-link"></i></a>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
include("../../../../templates/footer.php");
?>