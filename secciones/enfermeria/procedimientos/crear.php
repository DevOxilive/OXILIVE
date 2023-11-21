<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("consulta.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">
<style>.campo-invalido {border: 2px solid red !important;}
</style>
</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Procedimientos Realizados</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="crearADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3"
                    id="formulario">
                    <div class="contenido col-md-3">
                        <br>
                        <label for="paciente" class="formulario__label">Nombre del Paciente</label>
                        <select id="paciente" name="paciente" class="form-select">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($datosPacientes as $nomPaciente) { ?>
                            <option value="<?php echo $nomPaciente['id_pacientes']; ?>">
                                <?php echo $nomPaciente['paciente']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-3">
                        <br>
                        <label for="medico" class="formulario__label">Nombre del enfermero</label>
                        <select id="medico" name="medico" class="form-select">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($medico as $medicoT) { ?>
                            <option value="<?php echo $medicoT['id_usuarios']; ?>">
                                <?php echo $medicoT['medico']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="codigo_ICD" class="formulario__label">Código ICD:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" maxlength="15" class="formulario__input" name="codigo_ICD" id="codigo_ICD"
                                    placeholder="187.2 / 163">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="dx" class="formulario__label">DX: Insuficiencia Venosa / EVC</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="dx" id="dx"
                                    placeholder="Insuficiencia Venosa / EVC">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">

                        <label for="Nombre_admi" class="formulario__label" style="text-align:center">Administradora a la
                            que
                            pertenece</label>
                        <select id="Nombre_admi" name="Nombre_admi" class="form-select"
                            onchange="actualizarcodigo(this.value), actualizarDES(this.value),actualizarUnidad(this.value)">
                            <option value="0" selected disabled>Elija una administradora</option>
                            <?php foreach ($listaCodigo as $admin) { ?>
                            <option value="<?php echo $admin['id_administradora']; ?>">
                                <?php echo $admin['Nombre_administradora']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <br>
                        <label for="codigo" class="formulario__label">codigo de facturación</label>
                        <div id="div">
                            <select id="codigo" name="codigo" class="form-select">
                                <option value="0" selected disabled>Elija una opción</option>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <br>
                        <label for="descripcion" class="formulario__label">Descripción</label>
                        <div id="div">
                            <select id="descripcion" name="descripcion" readonly class="form-select">
                                <option value="0" selected disabled>Elija una opción</option>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <br>
                        <label for="unidad" class="formulario__label">Unidad</label>
                        <div id="div">
                            <select id="unidad" name="unidad" class="form-select">
                                <option value="0" selected disabled>Elija una opción</option>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <br>
                        <label for="fecha" class="formulario__label">Fecha</label>
                        <div id="div">
                            <input type="date" class="formulario__input" name="fecha" id="fecha">
                        </div>
                    </div>

                    <div class="contenido col-md-3">
                        <br>
                        <label for="cpt" class="formulario__label">CPT</label>
                        <select id="cpt" name="cpt" class="form-select">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($cpt_list as $cptA) { ?>
                            <option value="<?php echo $cptA['id_cpt']; ?>">
                                <?php echo $cptA['cpt']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#fecha').on('change', function() {
        var fechaInput = $('#fecha').val();
        var fechaSeleccionada = new Date(fechaInput);
        var anioMinimo = 2023;
        var anioIngresado = fechaSeleccionada.getFullYear();

        if (anioIngresado < anioMinimo) {
            alert('La fecha debe ser del año 2023 en adelante.');
            // Puedes añadir más acciones aquí si la fecha no es válida, como limpiar el campo de fecha.
            $('#fecha').val(''); // Limpia el campo de fecha
        }
    });
});
</script>

<script>
function actualizarcodigo(Nombre_admi) {
    console.log("Llamado a loscodigo con Nombre_admi:", Nombre_admi);
    const codigoselect = document.getElementById("codigo");
    codigoselect.innerHTML = '<option value="0" selected disabled>Cargando...</option>';

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./obtener_codigo.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            codigoselect.innerHTML = '<option value="0" selected disabled>Elija una opción</option>';
            const data = JSON.parse(xhr.responseText);

            data.forEach(function(codigo_admi) {
                const option = document.createElement("option");
                option.value = codigo_admi.id_codigo;
                option.textContent = codigo_admi.codigo;
                codigoselect.appendChild(option);
            });
        } else if (xhr.readyState === 4) {
            codigoselect.innerHTML = '<option value="0" selected disabled>Error al cargar las aseguradoras</option>';
        }
    };
    console.log("Nombre_admi antes de enviar:", Nombre_admi);
    xhr.send("Nombre_admi=" + encodeURIComponent(Nombre_admi));
}
</script>
<script>
function actualizarDES(Nombre_admi) {
    console.log("Llamado la descripción con Nombre_admi:", Nombre_admi);
    const descripcionSelect = document.getElementById("descripcion");
    descripcionSelect.innerHTML = '<option value="0" selected disabled>Cargando...</option>';

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./obtener_codigo.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            descripcionSelect.innerHTML = '<option value="0" selected disabled>Elija una opción</option>';
            const data = JSON.parse(xhr.responseText);

            data.forEach(function(descripcion) {
                const option = document.createElement("option");
                option.value = descripcion.Nombre_admi;
                option.textContent = descripcion.descripcion;
                descripcionSelect.appendChild(option);
            });
        } else if (xhr.readyState === 4) {
            descripcionSelect.innerHTML =
                '<option value="0" selected disabled>Error al cargar las aseguradoras</option>';
        }
    };
    console.log("Nombre_admi antes de enviar:", Nombre_admi);
    xhr.send("Nombre_admi=" + encodeURIComponent(Nombre_admi));
}
</script>
<script>
function actualizarUnidad(Nombre_admi) {
    console.log("Llamado la descripción con Nombre_admi:", Nombre_admi);
    const unidad_select = document.getElementById("unidad");
    unidad_select.innerHTML = '<option value="0" selected disabled>Cargando...</option>';

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./obtener_codigo.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            unidad_select.innerHTML = '<option value="0" selected disabled>Elija una opción</option>';
            const data = JSON.parse(xhr.responseText);

            data.forEach(function(unidad) {
                const option = document.createElement("option");
                option.value = unidad.Nombre_admi;
                option.textContent = unidad.unidad;
                unidad_select.appendChild(option);
            });

        } else if (xhr.readyState === 4) {
            unidad_select.innerHTML =
                '<option value="0" selected disabled>Error al cargar las aseguradoras</option>';
        }
    };
    console.log("Nombre_admi antes de enviar:", Nombre_admi);
    xhr.send("Nombre_admi=" + encodeURIComponent(Nombre_admi));
}
</script>
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
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/procedimientos/index.php";
        }
    });
}
</script>
<script src="js/validaciones.js">
    
</script>

<?php
include("../../../templates/footer.php");
?>