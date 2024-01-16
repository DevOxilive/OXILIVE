<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
    include("../../../model/genero.php");
    include("../../../model/banco.php");
    include("../../../secciones/puestos/consulta.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
  <link rel="stylesheet" href="../../../assets/css/foto_perfil.css">
  <link rel="stylesheet" href="../../../assets/css/edit.css">
</head>
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
            <form action="./empleadosADD.php" method="post" enctype="multipart/form-data" class="formLogin row g-3">
            <div class="contenido col-md-4">
                    <br>
                    <div class="formulario__grupo" id="grupo__Nombres">
                        <label for="Nombres" class="formulario-label">Nombres</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="Nombres" id="Nombres"
                                placeholder="Ejem: David Francisco" >
                        </div>
                    </div>
                </div>
                <div class="contenido col-md-4">
                    <br>
                    <div class="formulario__grupo" id="grupo__Apellidos">
                        <label for="Apellidos" class="formulario-label">Apellidos</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="Apellidos" id="Apellidos"
                                placeholder="Ejem: Cordoba Lopez" >
                        </div>
                    </div>
                </div>
                <div class="contenido col-md-2">
                    <br>
                    <div class="formulario__grupo" id="grupo__Edad">
                        <label for="Edad" class="formulario-label">Edad</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="Edad" id="Edad"
                                placeholder="Ejem: 57" >
                        </div>
                    </div>
                </div>
                <div class="contenido col-md-2"> <br>
                    <label for="Genero" class="form-label">Género</label>

                    <select id="Genero" name="Genero" class="form-select">
                    <option value="0" selected disabled>Elija una opcion</option>
                        <?php foreach ($lista_genero as $genero) { ?>
                            <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>
                <div class="contenido col-md-3">
                    <div class="formulario__grupo" id="grupo__Fecha_nacimiento">
                        <label for="Fecha_nacimiento" class="formulario-label">Fecha de nacimiento</label>
                        <div class="formulario__grupo-input">
                            <input type="date" class="form-control" name="Fecha_nacimiento" id="Fecha_nacimiento" >
                        </div>
                    </div>
                </div>
                <div class="contenido col-md-3">
                    <div class="formulario__grupo" id="grupo__Telefono">
                        <label for="Telefono" class="formulario-label">Telefono</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="Telefono" id="Telefono"
                                placeholder="Ejem: 55 11223344" >
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="Seguro_social" class="form-label">Comprobante de Seguro Social</label>
                    <input class="form-control" type="file" name="Seguro_social" id="Seguro_social" accept="application/pdf" >
                </div>
                <div class="contenido col-md-2">
                    <div class="formulario__grupo" id="grupo__rfc">
                        <label for="rfc" class="formulario-label">RFC</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="rfc" id="rfc" placeholder="Eje: EJEM123456" >
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="Acta_nacimiento" class="form-label">Acta de nacimiento</label>
                    <input class="form-control" type="file" name="Acta_nacimiento" id="Acta_nacimiento" >
                </div>
                <div class="col-md-3">
                    <label for="Comprobante_domicilio" class="form-label">Comprobante de domicilio</label>
                    <input class="form-control" type="file" name="Comprobante_domicilio" id="Comprobante_domicilio" >
                </div>
                <div class="col-md-3">
                    <label for="Curp" class="form-label">CURP</label>
                    <input class="form-control" type="file" name="Curp" id="Curp" >
                </div>
                <div class="col-md-3">
                    <label for="Titulo" class="form-label">Titulo</label>
                    <input class="form-control" type="file" name="Titulo" id="Titulo" >
                </div>
                <div class="col-md-3">
                    <label for="Cedula" class="form-label">Cédula</label>
                    <input class="form-control" type="file" name="Cedula" id="Cedula" >
                </div>
                <div class="col-md-3">
                    <label for="Carta_recomendacion1" class="form-label">Carta de recomendacion 1</label>
                    <input class="form-control" type="file" name="Carta_recomendacion1" id="Carta_recomendacion1" >
                </div>
                <div class="col-md-3">
                    <label for="Carta_recomendacion2" class="form-label">Carta de recomendacion 2</label>
                    <input class="form-control" type="file" name="Carta_recomendacion2" id="Carta_recomendacion2" >
                </div>
                <div class="col-md-3">
                    <label for="ine" class="form-label">INE</label>
                    <input class="form-control" type="file" name="ine" id="ine" >
                </div>
                <div class="contenido col-md-2">
                    <label for="Puesto" class="form-label">Puesto</label>
                    <select id="Puesto" name="Puesto" class="form-select">
                    <option value="0" selected disabled>Elija una opcion</option>
                        <?php foreach ($lista_puestos as $puesto) { ?>
                            <option value="<?php echo $puesto['id_puestos']; ?>"><?php echo $puesto['Nombre_puestos']; ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>
                <div class="contenido col-md-2">
                    <label for="Banco" class="form-label">Banco</label>
                    <select id="Banco" name="Banco" class="form-select">
                    <option value="0" selected disabled>Elija una opcion</option>
                        <?php foreach ($lista_bancos as $ban) { ?>
                            <option value="<?php echo $ban['id_bancos']; ?>"><?php echo $ban['Nombre_banco']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="contenido col-md-3">
                    <div class="formulario__grupo" id="grupo__No_cuenta">
                        <label for="No_cuenta" class="formulario-label">No. de cuenta</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="form-control" name="No_cuenta" id="No_cuenta" placeholder="Eje: 1234567891" >
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" name="guardar" class="btn btn-outline-primary">Guardar</button>
                    <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
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
            window.location.href = "<?php echo $url_base; ?>secciones/Capital_humano/empleados/index.php";
        }
    });
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();

            // Verifica si los campos obligatorios están vacíos
            var Nombres = document.getElementById('Nombres').value;
            var Apellidos = document.getElementById('Apellidos').value;
            var Fecha_nacimiento = document.getElementById('Fecha_nacimiento').value;
            var rfc = document.getElementById('rfc').value;

            if (!Nombres || !Apellidos || !Fecha_nacimiento || !rfc) {
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