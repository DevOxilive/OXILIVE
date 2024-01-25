<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
    include("../../../model/banco.php");   
    include("../../../model/genero.php");
    include("../../../secciones/puestos/consulta.php");
    include("./empleadosUPP.php");
} else {
    echo "Error en el sistema";
}
?>
<html lang="en">
<link rel="stylesheet" href="../../../assets/css/foto_editar.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Registrar Empleado</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./empleadosUPP.php" method="post" enctype="multipart/form-data" class="formEdit row g-3">
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                            id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="contenido contenido col-md-4">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombres">
                            <label for="Nombres" class="formulario-label">Nombres</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Nombres" id="Nombres" value="<?php echo $Nombres; ?>" 
                                    placeholder="Ejem: David Francisco" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido contenido col-md-4">
                        <br>
                        <div class="formulario__grupo" id="grupo__Apellidos">
                            <label for="Apellidos" class="formulario-label">Apellidos</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Apellidos" id="Apellidos" value="<?php echo $Apellidos; ?>" 
                                    placeholder="Ejem: Cordoba Lopez" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <br>
                        <div class="formulario__grupo" id="grupo__Edad">
                            <label for="Edad" class="formulario-label">Edad</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Edad" id="Edad" value="<?php echo $Edad; ?>" 
                                    placeholder="Ejem: 57" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="Genero" class="form-label">Género</label>
                        <select id="Genero" name="Genero" class="form-select">
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option <?php echo ($Genero == $genero['id_genero']) ? "selected" : ""; ?>
                                    value="<?php echo $genero['id_genero']; ?>">
                                    <?php echo $genero['genero']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__Fecha_nacimiento">
                            <label for="Fecha_nacimiento" class="formulario-label">Fecha de nacimiento</label>
                            <div class="formulario__grupo-input">
                                <input type="date" class="form-control" name="Fecha_nacimiento" value="<?php echo $Fecha_nacimiento; ?>" 
                                    id="Fecha_nacimiento" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__Telefono">
                            <label for="Telefono" class="formulario-label">Telefono</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Telefono" id="Telefono" value="<?php echo $Telefono; ?>" 
                                    placeholder="Ejem: 55 11223344" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__rfc">
                            <label for="rfc" class="formulario-label">RFC</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="rfc" id="rfc" value="<?php echo $rfc; ?>"
                                    placeholder="Eje: EJEM123456" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="Seguro_social" class="form-label">Comprobante de Seguro Social, Ver: <a href="../empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Seguro_social; ?>"> <i class="bi bi-eye-fill"></i></a></label>
                        <input class="form-control" type="file" value="../empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Seguro_social; ?>" name="Seguro_social" id="Seguro_social" >
                    </div>

                    <div class="col-md-3">
                        <label for="Acta_nacimiento" class="form-label">Acta de nacimiento, Ver:  <a href="../empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Acta_nacimiento; ?>"><i class="bi bi-eye-fill"></i></a></label>
                        <input class="form-control" type="file" name="Acta_nacimiento" id="Acta_nacimiento">
                    </div>
                    <div class="col-md-3">
                        <label for="Comprobante_domicilio" class="form-label">Comprobante de domicilio, Ver:  <a href="../../Capital_humano/empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Comprobante_domicilio; ?>"><i class="bi bi-eye-fill"></i></a> </label>
                        <input class="form-control" type="file" name="Comprobante_domicilio" id="Comprobante_domicilio" value="<?php echo $Comprobante_domicilio; ?>" >
                    </div>
                    <div class="col-md-3">
                        <label for="Curp" class="form-label">CURP, Ver:  <a href="../../Capital_humano/empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Curp; ?>"><i class="bi bi-eye-fill"></i></a> </label>
                        <input class="form-control" type="file" name="Curp" id="Curp" value="<?php echo $Curp; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="Titulo" class="form-label">Titulo, Ver:  <a href="../../Capital_humano/empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Titulo; ?>"><i class="bi bi-eye-fill"></i></a> </label>
                        <input class="form-control" type="file" name="Titulo" id="Titulo" value="<?php echo $Titulo; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="Cedula" class="form-label">Cédula, Ver:  <a href="../../Capital_humano/empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Cedula; ?>"><i class="bi bi-eye-fill"></i></a> </label>
                        <input class="form-control" type="file" name="Cedula" id="Cedula" value="<?php echo $Cedula; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="Carta_recomendacion1" class="form-label">Carta de recomendacion 1, Ver:  <a href="../../Capital_humano/empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Carta_recomendacion1; ?>"><i class="bi bi-eye-fill"></i></a> </label>
                        <input class="form-control" type="file" name="Carta_recomendacion1" value="<?php echo $Carta_recomendacion1; ?>"  id="Carta_recomendacion1"
                    >
                    </div>
                    <div class="col-md-3">
                        <label for="Carta_recomendacion2" class="form-label">Carta de recomendacion 2, Ver:  <a href="../../Capital_humano/empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $Carta_recomendacion2; ?>"><i class="bi bi-eye-fill"></i></a> </label>
                        <input class="form-control" type="file" name="Carta_recomendacion2" value="<?php echo $Carta_recomendacion2; ?>"  id="Carta_recomendacion2"
                    >
                    </div>
                    <div class="col-md-3">
                        <label for="ine" class="form-label">INE, Ver:  <a href="../../Capital_humano/empleados/EMPLEADOS/<?php echo $Apellidos."_".$Nombres?>/<?php echo $ine; ?>"><i class="bi bi-eye-fill"></i></a> </label>
                        <input class="form-control" type="file" name="ine" id="ine" value="<?php echo $ine; ?>">
                    </div>
                    <div class="contenido col-md-2">
                        <label for="Puesto" class="form-label">Puesto</label>
                        <select id="Puesto" name="Puesto" class="form-select">
                            <?php foreach ($lista_puestos as $puesto) { ?>
                                <option <?php echo ($Puesto == $puesto['id_puestos']) ? "selected" : ""; ?> value="<?php echo $puesto['id_puestos']; ?>"><?php echo $puesto['Nombre_puestos']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="Banco" class="form-label">Banco</label>
                        <select id="Banco" name="Banco" class="form-select">
                            <?php foreach ($lista_bancos as $ban) { ?>
                                <option <?php echo ($Banco == $ban['id_bancos']) ? "selected" : ""; ?> value="<?php echo $ban['id_bancos']; ?>"><?php echo $ban['Nombre_banco']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__No_cuenta">
                            <label for="No_cuenta" class="formulario-label">No. de cuenta</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="No_cuenta" id="No_cuenta" value="<?php echo $No_cuenta; ?>" 
                                    placeholder="Eje: 1234567891" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="guardar" class="btn btn-outline-primary">Guardar</button>
                        <a role="button"onclick="mostrarAlertaCancelar()" 
                            name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main>
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
                window.location.href = '<?php echo $url_base; ?>secciones/Capital_humano/empleados/index.php';
            }
        })
    }
</script>
<?php
include("../../../templates/footer.php");
?>