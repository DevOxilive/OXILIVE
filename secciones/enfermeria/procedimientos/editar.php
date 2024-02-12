<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include('../../../connection/conexion.php');
    $txtID = $_GET['txtID'];
    $stmt = $con->prepare("SELECT * FROM procedimientos WHERE id_procedi = :idus");
    $stmt->bindParam(':idus',$txtID);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include("./consulta.php");
    include("./editarUP.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">

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
                <form action="editarUP.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                    <?php foreach($result as $proce){?>
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                            id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="contenido col-md-3"> <br>
                        <label for="paciente" class="form-label">Nombre del paciente</label>
                        <select id="paciente" name="paciente" class="form-select">

                            <?php foreach($datosPacientes as $pac){?>
                            <?php $select_paciente = ($pac['id_pacientes']==$proce['pacienteYnomina']) ? "selected" : ""; ?>
                            <option <?php echo $select_paciente;?> value="<?php echo $pac['id_pacientes'];?>">
                                <?php echo $pac['paciente'];?>
                            </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="medico" class="form-label">Nombre del medico</label>
                        <select id="medico" name="medico" class="form-select">
                            <?php foreach ($medico as $nomMedico) { ?>
                            <?php $select_medico = ($proce['medico'] == $nomMedico['id_usuarios']) ? "selected" : ""; ?>
                            <option <?php echo $select_medico; ?> value="<?php echo $nomMedico['id_usuarios']; ?>">
                                <?php echo $nomMedico['medico']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="icd">
                            <label for="icd" class="form-label">Código ICD:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $proce['icd']; ?>" class="form-control"
                                    name="icd" id="icd">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="dx">
                            <label for="dx" class="form-label">DX: Insuficiencia Venosa / EVC</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="dx"
                                    value="<?php echo $proce['dx']; ?>">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <br>
                        <div class="formulario__grupo" id="Nombre_admi">
                            <label for="administradora" class="form-label">Administradora</label>
                            <div class="formulario__grupo-input">
                                <select id="Nombre_admi" name="Nombre_admi" class="form-select"
                                    onchange="actualizarcodigo(this.value), actualizarDES(this.value),actualizarUnidad(this.value)">
                                    <?php foreach ($listaCodigo as $registro) { ?>
                                    <option
                                        <?php echo ($proce['codigo'] == $registro['id_administradora']) ? "selected" : ""; ?>
                                        value="<?php echo $registro['id_administradora']; ?>">
                                        <?php echo $registro['Nombre_administradora']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-2">
                        <br>
                        <label for="codigo" class="form-label">Código</label>
                        <select id="codigo" name="codigo" class="form-select">
                            <?php foreach ($codigoLista as $select_codigo) { ?>
                            <option value="<?php echo $select_codigo['id_codigo']; ?>"><?php echo $select_codigo['codigo']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <div id="div">
                            <select id="descripcion" name="descripcion" readonly class="form-select">
                                <?php foreach ($codigoLista as $select_descripcion) { ?>
                                <option value="<?php echo $select_descripcion['id_codigo']; ?>">
                                    <?php echo $select_descripcion['descripcion']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">

                        <label for="unidad" class="form-label">Unidad</label>
                        <div id="div">
                            <select id="unidad" name="unidad" class="form-select">
                                <?php foreach ($codigoLista as $select_unidad) { ?>
                                <option value="<?php echo $select_unidad['id_codigo']; ?>">
                                    <?php echo $select_unidad['unidad']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <div id="div">
                            <input type="date" value="<?php echo $proce['fecha']; ?>" class="form-control"
                                name="fecha" id="fecha">
                        </div>
                    </div>

                  
                    <div class="contenido col-md-3">
                    <label for="cpt" class="form-label">CPT</label>
                        <select id="cpt" name="cpt" class="form-select">
                            <?php foreach ($cpt_list as $cpt) { ?>
                            <?php $select_cpt = ($proce['cpt'] == $cpt['id_cpt']) ? "selected" : ""; ?>
                            <option <?php echo $select_cpt; ?> value="<?php echo $cpt['id_cpt']; ?>">
                                <?php echo $cpt['cpt']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
</main>
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

            data.forEach(function(codigo) {
                const option = document.createElement("option");
                option.value = codigo.id_codigo;
                option.textContent = codigo.codigo;
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
<script>
document.getElementById("formulario").addEventListener("submit", function(event) {
    const paciente = document.getElementById("paciente").value;
    const medico = document.getElementById("medico").value;
    const codigo_ICD = document.getElementById("codigo_ICD").value;
    const dx = document.getElementById("dx").value;
    const Nombre_admi = document.getElementById("Nombre_admi").value;
    const codigo = document.getElementById("codigo").value;
    const descripcion = document.getElementById("descripcion").value;
    const unidad = document.getElementById("unidad").value;
    const fecha = document.getElementById("fecha").value;

    if (!paciente || !medico || !codigo_ICD || !dx || !Nombre_admi || !codigo || !descripcion || !unidad || !
        fecha) {
        // Al menos un campo está vacío, muestra una alerta y evita el envío del formulario
        event.preventDefault();
        Swal.fire({
            title: 'Campos Vacíos',
            text: 'Por favor, complete todos los campos antes de enviar el formulario.',
            icon: 'error'
        });
    }
});
</script>

<?php
include("../../../templates/footer.php");
?>