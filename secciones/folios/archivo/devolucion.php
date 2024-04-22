<?php
session_start();
if (!isset($_SESSION['us'])) {
    session_start();
    session_destroy();
    header('Location: ../../login.php');
} elseif(isset($_SESSION['us'])){
    include ("../../../templates/header.php");
    include ("../../../connection/conexion.php");
    include_once("./consultaFolios.php");
    include_once("./devolucionADD.php");
}else{
    echo "Error en el sistema";
}
?>
<html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo Banco</H4>
            </div>

            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="devolucionADD.php" method="POST" class="formLogin row g-3" id="formulario">
                   <!--Motivo de la devolución-->
                    <div class="contenido col-md-4">
                        <label for="estatus" class="formulario__label">Motivo de Devolución</label>
                        <select id="estatus" name="estatus" class="form-select">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($listMotivos as $motivo) { ?>
                            <option value="<?php echo $motivo['id_estatus']; ?>">
                                <?php echo $motivo['estatus']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!--Aqui va ir la lista de los folios-->
                    <div class="contenido col-md-3">
                        <label for="banco" class="formulario__label">Banco</label>
                        <select id="banco" name="banco" class="form-select">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php 
                             if ($listafolio !== false && !empty($listafolio)) {
                                 foreach ($listafolio as $folio) { ?>
                            <option value="<?php echo $folio['bancoFolio']; ?>">
                                <?php echo $folio['bancoFolio']; ?>
                            </option>
                            <?php 
                                    } 
                                }
                                ?>
                        </select>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="foliosB" class="formulario__label">Numero de folio</label>
                        <select id="foliosB" name="foliosB" class="form-select">
                            <option value="0" selected disabled>Eliga el banco</option>
                        </select>
                    </div>
                    <input type="hidden" id="id_folio" name="id_folio">

                                
                <!--Aquí va ir el id correspondiente-->
                <div class="contenido col-md-1">
                        <label for="Nombre_administradora" class="formulario__label"></label>
                            <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                                id="txtID" aria-describedby="helpId" style="display: none;"></div>


                    <div class="contenido col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmCancel(event) {
    event.preventDefault();
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Si cancelas, se perderán los datos ingresados.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo $url_base; ?>secciones/folios/archivo/archivoFolios.php";
        }
    });
}
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectorFolios = document.getElementById("foliosB");
        var idFolioInput = document.getElementById("id_folio");
        var txtIDInput = document.getElementById("txtID");

        selectorFolios.addEventListener("change", function() {
            var selectedFolioId = selectorFolios.value;
            idFolioInput.value = selectedFolioId;
            txtIDInput.value = selectedFolioId; // Aquí asignamos el valor también al campo txtID
            console.log(selectedFolioId);
        });
    });
</script>
<script src="./js/ajaxFolios.js"></script>
<?php
include("../../../templates/footer.php");
?>