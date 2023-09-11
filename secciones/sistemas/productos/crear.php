<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo Producto</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./productosADD.PHP" method="POST" id="formulario" enctype="multipart/form-data"
                    class="formLogin row g-3 formcrear">
                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__nombre">
                            <label for="nombre" class="formulario__label">Nombre del producto</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="nombre"
                                    id="nombre" placeholder="Eje: AirFit N20">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__descripcion">
                            <label for="descripcion" class="formulario__label">Descripcion del producto</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="descripcion"
                                    id="descripcion" placeholder="Eje: Aparato concentrador de oxígeno">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2"> 
                        <div class="formulario__grupo" id="grupo__precio">
                            <label for="precio" class="formulario__label">Precio del producto</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="precio"
                                    id="precio" placeholder="Eje: $3449:00" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__cantidad">
                            <label for="cantidad" class="formulario__label">Cantidades en stock</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="formulario__input" name="cantidad"
                                    id="cantidad" placeholder="Eje: 2" min="0">
                            </div>
                        </div>
                    </div>  
                    <div class="contenido col-md-4"> 
                        <div class="formulario__grupo" id="grupo__imagen">
                            <label for="imagen" class="formulario__label">Imagen</label>
                            <div class="formulario__grupo-input">
                                <input type="file" class="formulario__input" name="imagen"
                                    id="imagen">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4"> 
                        <div class="formulario__grupo" id="grupo__disponible">
                            <label for="disponible" class="formulario__label">¿Esta Disponibe?</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="disponible"
                                    id="disponible" placeholder="Eje: Disponible/Agotado">
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer text-muted">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)"
                                role="button">Cancelar</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
</main>
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
                window.location.href = "<?php echo $url_base; ?>secciones/sistemas/productos/index.php";
            }
        });
    }
    
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.formcrear').addEventListener('submit', function (e) {
        e.preventDefault(); 
        
        var cantidad = document.querySelector('#cantidad').value;
        var precio = document.querySelector('#precio').value;
        if (cantidad >=0 && precio >1) {
            Swal.fire({
                title: 'Datos Guardados',
                text: 'Los datos han sido guardados correctamente.',
                icon: 'success',
            }).then(() => {
                e.target.submit();
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: 'La cantidad y el precio no pueden ser 0.',
                icon: 'error',
            });
        }
    });
});
</script>
<!-- ESTA ALERTA SIRVE PARA NO PERMITIR NINGUN CAMPO VACIO -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();
            // Verifica si los campos obligatorios están vacíos
            var nombre = document.getElementById('nombre').value;
            var descripcion = document.getElementById('descripcion').value;
            var precio = document.getElementById('precio').value;
            var cantidad = document.getElementById('cantidad').value;
            var disponible = document.getElementById('disponible').value;
            if (!nombre || !descripcion || !precio || !cantidad || !disponible) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos obligatorios.',
                });
            } else {
                this.submit();
            }
        });
    });
</script>
<?php
include("../../../templates/footer.php");
?>