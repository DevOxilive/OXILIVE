<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../module/enfermeros.php");
} else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Enfermeros</h3>
                <hr>
                <div class="btn-box justify-content-first">
                    <a class="btn btn-outline-primary" href="crear.php" role="button">
                        <i class="bi bi-person-fill"></i> Registrar Enfermero
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table border-dark table-hover" id="myTable" style="border: 2px solid black">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Nombre(s)</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_enfermeros as $enfermeros) { ?>
                                <tr>
                                    <td><?php echo $enfermeros['Nombres']; ?></td>
                                    <td><?php echo $enfermeros['Apellidos']; ?></td>
                                    <td>
                                        <span id="status<?php echo $enfermeros['id_usuarios']; ?>"></span>
                                    </td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-warning" href="editar.php?txtID=<?php echo $enfermeros['id_usuarios']; ?>" role="button">
                                            <i class="bi bi-pencil-square"></i>
                                        </a> |
                                        <a name="" id="" class="btn btn-outline-danger" onclick="eliminar(<?php echo $enfermeros['id_usuarios']; ?>)" role="button">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</main><!-- End #main -->
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
            url: "eliminar.php",
            type: "POST",
            beforeSend: function() {},
            success: function() {
                Swal.fire("Eliminado:", "Ha sido eliminado", "success").then((result) => {
                    window.location.href = "index.php";


                });
            },

        });
    }
    // Agrega la animación a los bordes de las filas
    const rows = document.querySelectorAll(".animated-border");
    rows.forEach(row => {
        row.addEventListener("mouseover", () => {
            row.classList.add("border-animation");
        });
        row.addEventListener("mouseout", () => {
            row.classList.remove("border-animation");
        });
    });

    function getStatus() {
        fetch("model/status.php", {
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(datos => {
                datos.forEach(dato => {
                    let status = document.getElementById("status" + dato.id_usuarios);
                    status.classList = "";
                    status.textContent = "";
                    if (dato.Estado == 1) {
                        status.classList.add("badge", "bg-success", "fs-6");
                    } else if (dato.Estado == 5) {
                        status.classList.add("badge", "bg-info", "fs-6");
                    }
                    status.textContent = dato.Nombre_estado;

                })
            });
    }
    getStatus();
    setInterval(getStatus, 2000);
</script>
<script src="../../../js/tables.js"></script>
<?php
include("../../../templates/footer.php");
?>