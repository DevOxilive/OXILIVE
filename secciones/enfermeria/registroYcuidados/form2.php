<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
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
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4 style="text-align:center;
            color: #ffff;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                Formulario parte 2
            </h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form class="formLogin form-inline" id="formulario">
                <div class="col-md-4 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="solucion" class="form-label">SOLUCION</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="solucion" id="solucion">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="fecha" class="form-label">FECHA</label>
                        <div class="formulario__grupo-input">
                            <input type="date" class="form-control" name="fecha" id="fecha">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="cantidad" class="form-label">CANT.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="cantidad" id="cantidad">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="goteo" class="form-label">GOT.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="goteo" id="goteo">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="frecuencia" class="form-label">FREC.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="frecuencia" id="frecuencia">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="inicia" class="form-label">INICIA</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="form-control" name="inicia" id="inicia">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="termina" class="form-label">TERMINA</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="form-control" name="termina" id="termina">
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <button id="btnAnterior" class="btn btn-secondary" onclick="mostrarAlerta()">Anterior</button>
            <button id="btnSiguiente" class="btn btn-primary" type="submit" form="formulario">Siguiente</button>
        </div>
        </form>
    </div>
    </div>
</main>
<script type="text/javascript">
    function mostrarAlerta() {
        Swal.fire({
            icon: 'question',
            title: '¿Estás seguro de ir atrás?',
            text: 'Los datos no se guardarán',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'form1.php'; // Cambia aquí para redirigir a 'index.php'
            }
        });
    }
</script>
<script src="js/valiform2.js"></script>

<?php
include("../../../templates/footer.php");
?>

