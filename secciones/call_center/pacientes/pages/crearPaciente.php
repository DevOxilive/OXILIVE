<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../../../../module/genero.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../../assets/css/edit.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo Paciente</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF">
                <form action="" method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                    <div class="contenido col-md-12">
                        <br>
                        <h2>Datos Generales</h2>
                    </div>
                    <div class="contenido col-md-5">
                        
                        <label for="nombre" class="form-label">Nombre(s):</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el/los nombre(s)">
                    </div>
                    <div class="contenido col-md-5">
                        
                        <label for="nombre" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa los apellidos">
                    </div>
                    <div class="contenido col-md-2">
                       
                        <label for="nombre" class="form-label">Género</label>
                        <select name="genero" id="genero" class="form-select">
                            <option value="" selected>Selecciona el género</option>
                            <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="text" class="form-control" name="edad" id="edad" placeholder="Ingresa la edad">
                    </div>
                    <div class="contenido col-md-12">
                        <hr>
                        <h2>Domicilio</h2>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="cp" class="form-label">Código Postal:</label>
                        <input type="text" maxlength="5" class="form-control" id="cp">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="colonia" class="form-label">Colonia:</label>
                        <select name="colonia" id="colonia" class="form-select">
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="delMun">Delegación/Municipio:</label>
                        <select name="delMun" id="delMun">
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="estadoDir">Estado:</label>
                        <select name="estadoDir" id="estadoDir">
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <br>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<script src="../js/domicilio.js"></script>

</html>
<?php
include("../../../../templates/footer.php");
?>