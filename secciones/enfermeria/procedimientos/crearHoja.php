<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("./consultaHoja.php");
    include("./crearHojaADD.php");
    include("../hojaComplementaria/consulta.php");
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
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Procedimientos Realizados</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./crearHojaADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="pacientes" class="formulario__label">Nombre del paciente</label>
                        <select id="pacientes" name="pacientes" class="form-select">
                        <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($pacientes as $admin) { ?>
                                
                                <option value="<?php echo $admin['id_pacientes']; ?>">
                                <?php echo $admin['Nombres']; ?>
                                
                                <!-- <option <?php echo ($pacientes == $admin['id_pacientes']) ? "selected" : ""; ?> value="<?php echo $registro['id_pacientes']; ?>">
                                    <?php echo $admin['Nombres']; ?>
                                </option> -->

                            <?php } ?>
                        </select>
                    </div>

            <!--Aquí empieza lo de pacientes-->
                    <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="codigo_ICD" class="formulario__label">Código ICD:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $codigo_ICD; ?>" readonly class="formulario__input" name="codigo_ICD" id="codigo_ICD" placeholder="187.2 / 163">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="dx" class="formulario__label">DX: Insuficiencia Venosa / EVC</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $dx;?>" readonly class="formulario__input" name="dx" id="dx" placeholder="Insuficiencia Venosa / EVC">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="medico" class="formulario__label">Médico tratante</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $medico;?>" readonly class="formulario__input" name="medico" id="medico" placeholder="Alan Garcia">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                <!--Aquí termina lo de pacientes-->


                <div class="contenido col-md-3">
                        <label for="Nombre_admi" class="formulario__label">Administradora a la que
                            pertenece</label>
                        <select id="Nombre_admi" name="Nombre_admi"  class="form-select" onchange="actualizarCPT(this.value), actualizardes1(this.value), actualizarunidad(this.value)" >
                        <option value="0" selected disabled>Elija una administradora</option>
                            <?php foreach ($listaAdmi_enfer as $admin) { ?>
                                <option value="<?php echo $admin['id_admi_enfer']; ?>">
                                    <?php echo $admin['Nombre_admi']; ?> 
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                                <!--CPT-->
                    <div class="contenido col-md-2">
                        <label for="cpt_admi" class="formulario__label">cpt uno</label>
                        <div id="div">
                            <select id="cpt_admi" name="cpt_admi"  class="form-select" >
                                <option value="0" selected disabled>Elija una opción</option>
                            </select>
                        </div>
                    </div>
                                <!--Descripción-->
                    <div class="contenido col-md-4">
                        <label for="des1" class="formulario__label">Descripción</label>
                        <div id="div">
                            <select id="des1" name="des1" readonly class="form-select" >
                                <option value="0" selected disabled>Elija una opción</option>
                            </select>
                        </div>
                    </div>
                                <!--Unidad-->
                    <div class="contenido col-md-3">
                        <label for="unidad" class="formulario__label">unidad</label>
                        <div id="div">
                            <select id="unidad" name="unidad" class="form-select" >
                                <option value="0" selected disabled>Elija una opción</option>
                            </select>
                        </div>
                    </div>
                                <!--Unidad-->
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="fecha" class="formulario__label">Fecha</label>
                            <div class="formulario__grupo-input">
                                <input type="date" class="formulario__input" name="fecha" id="fecha">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <br>
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main> 
<script>
        function actualizarCPT(Nombre_admi) {
        console.log("Llamado a losCPT con Nombre_admi:", Nombre_admi);
        const cptselect = document.getElementById("cpt_admi");
        cptselect.innerHTML = '<option value="0" selected disabled>Cargando...</option>';

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./obtener_cpt.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                cptselect.innerHTML = '<option value="0" selected disabled>Elija una opción</option>';
                const data = JSON.parse(xhr.responseText);

                data.forEach(function(cpt_admi) {
                    const option = document.createElement("option");
                    option.value = cpt_admi.Nombre_admi;
                    option.textContent = cpt_admi.cpt_admi;
                    cptselect.appendChild(option);
                });

                data.forEach(function(cpt2) {
                    const option = document.createElement("option");
                    option.value = cpt2.Nombre_admi;
                    option.textContent = cpt2.cpt2;
                    cptselect.appendChild(option);
                });

                data.forEach(function(cpt3) {
                    const option = document.createElement("option");
                    option.value = cpt3.Nombre_admi;
                    option.textContent = cpt3.cpt3;
                    cptselect.appendChild(option);
                });

                data.forEach(function(cpt4) {
                    const option = document.createElement("option");
                    option.value = cpt4.Nombre_admi;
                    option.textContent = cpt4.cpt4;
                    cptselect.appendChild(option);
                });
                data.forEach(function(cpt5) {
                    const option = document.createElement("option");
                    option.value = cpt5.Nombre_admi;
                    option.textContent = cpt5.cpt5;
                    cptselect.appendChild(option);
                });
                data.forEach(function(cpt6) {
                    const option = document.createElement("option");
                    option.value = cpt6.Nombre_admi;
                    option.textContent = cpt6.cpt6;
                    cptselect.appendChild(option);
                });
               
            } else if (xhr.readyState === 4) {
                cptselect.innerHTML = '<option value="0" selected disabled>Error al cargar las aseguradoras</option>';
            }
        };
          console.log("Nombre_admi antes de enviar:", Nombre_admi);
        xhr.send("Nombre_admi=" + encodeURIComponent(Nombre_admi));
    }
</script>
<script>
        function actualizardes1(Nombre_admi) {
        console.log("Llamado la descripción con Nombre_admi:", Nombre_admi);
        const des1_select = document.getElementById("des1");
        des1_select.innerHTML = '<option value="0" selected disabled>Cargando...</option>';

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./obtener_cpt.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                des1_select.innerHTML = '<option value="0" selected disabled>Elija una opción</option>';
                const data = JSON.parse(xhr.responseText);

                data.forEach(function(des1) {
                    const option = document.createElement("option");
                    option.value = des1.Nombre_admi;
                    option.textContent = des1.des1;
                    des1_select.appendChild(option);
                });

                data.forEach(function(des2) {
                    const option = document.createElement("option");
                    option.value = des2.Nombre_admi;
                    option.textContent = des2.des2;
                    des1_select.appendChild(option);
                });
               
                data.forEach(function(des3) {
                    const option = document.createElement("option");
                    option.value = des3.Nombre_admi;
                    option.textContent = des3.des3;
                    des1_select.appendChild(option);
                });

                data.forEach(function(des4) {
                    const option = document.createElement("option");
                    option.value = des4.Nombre_admi;
                    option.textContent = des4.des4;
                    des1_select.appendChild(option);
                });

                data.forEach(function(des5) {
                    const option = document.createElement("option");
                    option.value = des5.Nombre_admi;
                    option.textContent = des5.des5;
                    des1_select.appendChild(option);
                });

                data.forEach(function(des6) {
                    const option = document.createElement("option");
                    option.value = des6.Nombre_admi;
                    option.textContent = des6.des6;
                    des1_select.appendChild(option);
                });
            } else if (xhr.readyState === 4) {
                des1_select.innerHTML = '<option value="0" selected disabled>Error al cargar las aseguradoras</option>';
            }
        };
        console.log("Nombre_admi antes de enviar:", Nombre_admi);
        xhr.send("Nombre_admi=" + encodeURIComponent(Nombre_admi));
    }
</script>
<script>
        function actualizarunidad(Nombre_admi) {
        console.log("Llamado la descripción con Nombre_admi:", Nombre_admi);
        const unidad_select = document.getElementById("unidad");
        unidad_select.innerHTML = '<option value="0" selected disabled>Cargando...</option>';

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./obtener_cpt.php", true);
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
                data.forEach(function(unidad2) {
                    const option = document.createElement("option");
                    option.value = unidad2.Nombre_admi;
                    option.textContent = unidad2.unidad2;
                    unidad_select.appendChild(option);
                });

                data.forEach(function(unidad3) {
                    const option = document.createElement("option");
                    option.value = unidad3.Nombre_admi;
                    option.textContent = unidad3.unidad3;
                    unidad_select.appendChild(option);
                });

                data.forEach(function(unidad4) {
                    const option = document.createElement("option");
                    option.value = unidad4.Nombre_admi;
                    option.textContent = unidad4.unidad4;
                    unidad_select.appendChild(option);
                });

                data.forEach(function(unidad5) {
                    const option = document.createElement("option");
                    option.value = unidad5.Nombre_admi;
                    option.textContent = unidad5.unidad5;
                    unidad_select.appendChild(option);
                });

                data.forEach(function(unidad6) {
                    const option = document.createElement("option");
                    option.value = unidad6.Nombre_admi;
                    option.textContent = unidad6.unidad6;
                    unidad_select.appendChild(option);
                });
               
            } else if (xhr.readyState === 4) {
                unidad_select.innerHTML = '<option value="0" selected disabled>Error al cargar las aseguradoras</option>';
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
<?php
include("../../../templates/footer.php");
?>