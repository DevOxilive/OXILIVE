<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} else if (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("administradoraUP.php");
    include("consulta.php");
    $txtID = $_GET['txtID'];
    //$administradora = (isset($_GET['adminis$administradora'])) ? $_GET['adminis$administradora'] : "";
    //$Nombre_banco = (isset($_GET['Nombre_banco'])) ? $_GET['Nombre_banco'] : "";
    $sentencia = $con->prepare("SELECT * FROM bancos WHERE id_bancos=:bancos");
    $sentencia->bindParam(':bancos', $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetchAll(PDO::FETCH_ASSOC);

} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar administradora</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./administradoraUP.php" method="POST" class="row g-3 formEdit">
                    <?php foreach($registro as $reg) { ?>
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                            id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="contenido col-md-3"> <br>
                        <label for="administradora" class="form-label">Administradora</label>
                        <select id="administradora" name="administradora" class="form-select">
                            <?php foreach ($lista_administradora as $admi) { ?>
                            <option <?php echo ($admi['id_administradora'] == $reg['admi']) ? "selected" : ""; ?>
                                value="<?php echo $admi['id_administradora']; ?>">
                                <?php echo $admi['Nombre_administradora']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-3"> <br>
                        <label for="Nombre_banco" class="form-label">Banco</label>
                        <input type="text" id="Nombre_banco" name="Nombre_banco" class="form-control"
                            value="<?php echo $reg['Nombre_banco']; ?>" readonly>
                    </div>


                    <!-- <div class="contenido col-md-3"> <br>
                        <label for="Nombre_banco" class="form-label">Banco</label>
                        <select id="Nombre_banco" name="Nombre_banco" class="form-select">
                            <?php foreach ($listaGeneral as $banco) { ?>
                                <option <?php echo ($banco['Nombre_banco'] == $reg['Nombre_banco']) ?  "selected" : ""; ?>
                                    value="<?php echo $banco['id_bancos']; ?>">
                                    <?php echo $banco['Nombre_banco']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div> -->

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar"
                            class="btn btn-outline-danger"> Cancelar</a>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
</main>
<!-- CANCELA LA OPERACION SIEMPRE Y CUANDO SE CONFIRME LA ACCION -->
<script>
function mostrarAlertaCancelar() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Los cambios no se guardarán',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?php echo $url_base; ?>secciones/enfermeria/alta/administradora/index.php';
        }
    })
}
</script>
<?php
include("../../../../templates/footer.php");
?>