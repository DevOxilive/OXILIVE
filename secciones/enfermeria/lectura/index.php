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
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Historial de pacientes</h3>
                <hr>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table border-dark table-hover" id="myTable" style="border: 1px black">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Paciente</th>
                                <th scope="col">Lo atendio el medico:</th>
                                <th scope="col">Administradora</th>
                                <th scope="col">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $previousPaciente = null;
                            foreach ($listaProce as $lista) {
                                if ($lista['Paciente'] != $previousPaciente) {
                                    $contadorFilas = 1; ?>
                                    <tr class="">
                                        <td> <?php echo $lista['Paciente']; ?></td>
                                        <td><?php echo $lista["Medico"]; ?></td>
                                        <td> <?php echo $lista['Nombre_administradora']; ?></td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-outline-success" href="pacienteP.php?txtID=<?php echo $lista['pacienteYnomina']; ?>" role="button"><i class="bi bi-eye"></i></a>
                                            |
                                        </td>
                                    </tr>
                                <?php $previousPaciente = $lista['Paciente'];
                                } elseif ($contadorFilas < 1) {
                                    $contadorFilas++; ?>
                                    <tr class="">
                                        <td></td>
                                        <td><?php echo $lista['Paciente']; ?></td>
                                        <td><?php echo $lista["Medico"]; ?></td>
                                        <td> <?php echo $lista['Nombre_administradora']; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
</script>
<script src="../../../js/tables.js"></script>
<?php
include("../../../templates/footer.php");
?>