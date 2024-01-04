<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
}  elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../bancos/consulta.php");
}
else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
    <div class="card-header" style="text-align: right;">
                    <a class="btn btn-outline-dark" href="bancos.php" role="button"><i class="bi bi-printer-fill"></i></a>
            </div>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="crear.php" role="button"><i class="bi bi-bank2"></i>
                    Registrar un nuevo banco</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table border-dark table-hover" id="myTable" style="border: 2px solid black">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Núm</th>
                                <th scope="col">Nombre del Banco</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_bancos as $registro) { ?>
                                <tr class="">
                                    <th scope="row">
                                        <?php echo $registro['id_bancos']; ?>
                                    </th>
                                    <td>
                                        <?php echo $registro['Nombre_banco']; ?>
                                    </td>

                                    <td style="text-align: center;">
                                        <a class="btn btn-outline-warning" href="editar.php?txtID=<?php echo $registro['id_bancos']; ?>" role="button"><i class="bi bi-pencil-square"></i></a>
                                        |
                                        <a class="btn btn-outline-danger" onclick="eliminar(<?php echo $registro['id_bancos']; ?>)" role="button"><i class="bi bi-trash-fill"></i></a>
                                    </td>
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
</script>
<script src="../../js/tables.js"></script>
<?php
include("../../templates/footer.php");
?>