<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../connection/conexion.php");
    include("../../../../templates/header.php");
    include("model/tipos.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $url_base ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4 style="text-align: center;
                        color: #fff;
                        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                Registro de nuevo servicio
            </h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form action="<?php echo $url_base ?>secciones/enfermeria/servicios/tipos/model/nuevoTServicio.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3">
                <?php foreach($lista_tipos as $tipos){ ?>
                <div class="contenido col-md-8">
                    <br>
                    <label for="nombreServicio" class="form-label">Nombre del Servicio:</label>
                    <input type="text" class="form-control" name="nombreServicio" id="nombreServicio" placeholder="Ingresa el nombre del servicio" value="<?php echo $tipos['nombreServicio']; ?>" required>
                </div>
                <div class="col-md-4"></div>
                <div class="contenido col-md-4">
                    <label for="horasServicio" class="form-label">Horas del Servicio:</label>
                    <select name="horasServicio" id="horasServicio" class="form-select" required>
                        <option value="">Seleccione una duración</option>
                        <option value="08" <?php if($tipos['horasServicio']==8){ echo 'selected';} ?>>8 horas</option>
                        <option value="12" <?php if($tipos['horasServicio']==12){ echo 'selected';} ?>>12 horas</option>
                        <option value="24" <?php if($tipos['horasServicio']==24){ echo 'selected';} ?>>24 horas</option>
                    </select>
                </div>
                <div class="contenido col-md-2">
                    <label for="sueldo" class="form-label">Sueldo:</label>
                    <div class="input-group">
                        <span class="input-group-text span-comp">$</span>
                        <input type="text" class="form-control" name="sueldo" id="sueldo" placeholder="Ingresa el monto" value="<?php echo $tipos['sueldo']; ?>" required>
                    </div>
                </div>
                <div class="col-12">
                <?php } ?>
                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                    <button type="cancel" class="btn btn-outline-danger" onclick="confirmCancel(event)">Cancelar</button>
                </div>
                <input type="hidden" id="id" value="<?php echo $id; ?>">
            </form>
        </div>
    </div>
</main>

</html>
<script>
    $(document).ready(function() {
        $("form").submit(function(event) {
            var formData = {
                nomServ: $("#nombreServicio").val(),
                horasServ: $("#horasServicio").val(),
                sueldo: $("#sueldo").val(),
                id: $("#id").val(),
            };
            $.ajax({
                type: "POST",
                url: "model/actualizarTServicio.php",
                data: formData,
                success: function() {
                    Swal.fire({
                        title: "Actualizado",
                        text: "Registro actualizado correctamente",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.replace('index.php');
                    });
                }
            });
            event.preventDefault();

        });
    });

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
                // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
                window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/servicios/tipos/index.php";
            }
        });
    }
</script>
<?php
include('../../../../templates/footer.php');
?>