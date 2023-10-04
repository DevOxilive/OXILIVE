<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("./consulta.php");
  
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <a class="btn btn-outline-dark" href="#" role="button"><i class="bi bi-printer-fill"></i></a>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="crear.php" role="button">
                    <i class="bi bi-person-workspace"></i> Registrar Administradora
                </a>

            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Núm</th>
                                <th scope="col">Administradora</th>
                                <th scope="col">CPT</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_administradora as $registro) { ?>
                            <tr class="">
                                <th scope="row">
                                    <?php echo $registro['id_admi_enfer']; ?>
                                </th>
                                <td>
                                    <?php echo $registro['Nombre_admi']; ?>

                                </td>
                                <td>
                                    <?php echo $registro['cpt_admi']; ?>
                                </td>
                                <td>
                                    <?php echo $registro['Fecha_registro']; ?>
                                </td>

                                <td style="text-align: center;">
                                    <a class="btn btn-outline-success" id="mostrarDiv"
                                        href="viewCPT.php?txtID=<?php echo $registro['id_admi_enfer']; ?>"
                                        role="button"><i class="bi bi-eye"></i></a>
                                    |
                                    <a class="btn btn-outline-warning"
                                        href="editar.php?txtID=<?php echo $registro['id_admi_enfer']; ?>"
                                        role="button"><i class="bi bi-pencil-square"></i></a>
                                    |
                                    <a class="btn btn-outline-danger"
                                        onclick="eliminar(<?php echo $registro['id_admi_enfer']; ?>)" role="button"><i
                                            class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-header" style="text-align: right;">
                <a class="btn btn-danger" href="./index.php">Cerrar <i
                        class="fa-regular fa-rectangle-xmark"></i></a><br>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1 style="text-align: center;">CPT 1</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered  border-dark table-hover" id="myTable">
                            <thead class="table-dark">
                                <tr class="table-active table-group-divider" style="text-align: center;">
                                    <th scope="col">Núm</th>
                                    <th scope="col">Admi</th>
                                    <th scope="col">CPT1</th>
                                    <th scope="col">Descrpcion</th>
                                    <th scope="col">Unidad</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cpts as $cpts) { ?>
                                <tr class="">
                                    <th scope="row">
                                        <?php echo $cpts['id_admi_enfer']; ?>
                                    </th>
                                    <td>
                                        <?php echo $cpts['Nombre_admi']; ?>

                                    </td>
                                    <td>
                                        <?php echo $cpts['cpt_admi']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['des1']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['unidad']; ?>
                                    </td>
                                   
                                    
                                </tr>
                              
                            </tbody>
                            <br>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    
            <div class="card">
                <div class="card-header">
                    <h1 style="text-align: center;">CPT 2 </h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered  border-dark table-hover" id="myTable">
                            <thead class="table-dark">
                                <tr class="table-active table-group-divider" style="text-align: center;">
                                    <th scope="col">Núm</th>
                                    <th scope="col">Admi</th>
                                    <th scope="col">CPT2</th>
                                    <th scope="col">Descrpcion 2</th>
                                    <th scope="col">Unidad</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr class="">
                                    <th scope="row">
                                        <?php echo $cpts['id_admi_enfer']; ?>
                                    </th>
                                    <td>
                                        <?php echo $cpts['Nombre_admi']; ?>

                                    </td>
                                    <td>
                                        <?php echo $cpts['cpt2']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['des2']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['unidad2']; ?>
                                    </td>
                                   
                                </tr>
                            </tbody>
                            <br>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
                <div class="card-header">
                    <h1 style="text-align: center;">CPT 3 </h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered  border-dark table-hover" id="myTable">
                            <thead class="table-dark">
                                <tr class="table-active table-group-divider" style="text-align: center;">
                                    <th scope="col">Núm</th>
                                    <th scope="col">Admi</th>
                                    <th scope="col">CPT3</th>
                                    <th scope="col">Descrpcion 3</th>
                                    <th scope="col">Unidad 3</th>

                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr class="">
                                    <th scope="row">
                                        <?php echo $cpts['id_admi_enfer']; ?>
                                    </th>
                                    <td>
                                        <?php echo $cpts['Nombre_admi']; ?>

                                    </td>
                                    <td>
                                        <?php echo $cpts['cpt3']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['des3']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['unidad3']; ?>
                                    </td>
                                </tr>
                               
                            </tbody>
                            <br>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
                <div class="card-header">
                    <h1 style="text-align: center;"> CPT 4 </h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered  border-dark table-hover" id="myTable">
                            <thead class="table-dark">
                                <tr class="table-active table-group-divider" style="text-align: center;">
                                    <th scope="col">Núm</th>
                                    <th scope="col">Admi</th>
                                    <th scope="col">CPT4</th>
                                    <th scope="col">Descripción 3</th>
                                    <th scope="col">Unidad 4</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr class="">
                                    <th scope="row">
                                        <?php echo $cpts['id_admi_enfer']; ?>
                                    </th>
                                    <td>
                                        <?php echo $cpts['Nombre_admi']; ?>

                                    </td>
                                   
                                    <td>
                                        <?php echo $cpts['cpt4']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['des4']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['unidad4']; ?>
                                    </td>
    
                                </tr>
                               
                            </tbody>
                            <br>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
                <div class="card-header">
                    <h1 style="text-align: center;">CPT 5 </h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered  border-dark table-hover" id="myTable">
                            <thead class="table-dark">
                                <tr class="table-active table-group-divider" style="text-align: center;">
                                    <th scope="col">Núm</th>
                                    <th scope="col">Admi</th>
                                    <th scope="col">CPT5</th>
                                    <th scope="col">Descripción 5</th>
                                    <th scope="col">Unidad 5</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr class="">
                                    <th scope="row">
                                        <?php echo $cpts['id_admi_enfer']; ?>
                                    </th>
                                    <td>
                                        <?php echo $cpts['Nombre_admi']; ?>

                                    </td>
                                   
                                    <td>
                                        <?php echo $cpts['cpt5']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['des5']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['unidad5']; ?>
                                    </td>
    
                                </tr>
                               
                            </tbody>
                            <br>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
                <div class="card-header">
                    <h1 style="text-align: center;">CPT 6 </h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered  border-dark table-hover" id="myTable">
                            <thead class="table-dark">
                                <tr class="table-active table-group-divider" style="text-align: center;">
                                    <th scope="col">Núm</th>
                                    <th scope="col">Admi</th>
                                    <th scope="col">CPT5</th>
                                    <th scope="col">Descripción 6</th>
                                    <th scope="col">Unidad 6</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr class="">
                                    <th scope="row">
                                        <?php echo $cpts['id_admi_enfer']; ?>
                                    </th>
                                    <td>
                                        <?php echo $cpts['Nombre_admi']; ?>

                                    </td>
                                   
                                    <td>
                                        <?php echo $cpts['cpt6']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['des6']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cpts['unidad6']; ?>
                                    </td>
    
                                </tr>
                                <?php } ?>
                            </tbody>
                            <br>

                        </table>
                    </div>
                </div>
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