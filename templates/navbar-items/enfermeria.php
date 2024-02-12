<!-- Apartado Dar de Alta -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#alta" href="#">
        <i class="bi bi-box-arrow-in-up"></i><span>Dar de Alta</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
    </a>
    <ul id="alta" class="nav-content collapse">
        <!-- Subapartado Código -->
        <li>
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/alta/codigo_servicios/index.php">
                <i class="bi bi-circle"></i><span>Código</span>
            </a>
        </li>
        <!-- Subapartado CPTs -->
        <li>
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/alta/cpts/index.php">
                <i class="bi bi-circle"></i><span>Cpts</span>
            </a>
        </li>
        <!-- Subapartado Administradora -->
        <!-- <li>
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/alta/administradora/index.php">
                <i class="bi bi-circle"></i><span>Administradora</span>
            </a>
        </li> -->
    </ul>
</li>
<!-- Apartado Crear Proceso -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#crear" href="#">
        <i class="bi bi-clipboard-plus"></i><span>Crear proceso</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
    </a>
    <ul id="crear" class="nav-content collapse">
        <!-- Subapartado Pacientes -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/enfermeria/hojaComplementaria/index.php">
                <i class="bi bi-circle"></i><span>Pacientes</span>
            </a>
        </li>
        <!-- Subapartado Procedimientos -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/enfermeria/procedimientos/index.php">
                <i class="bi bi-circle"></i><span>Procedimientos</span>
            </a>
        </li>
    </ul>
</li>
<!-- Apartado Servicios -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#services" href="#">
        <i class=""></i><span>Servicios</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
    </a>
    <ul id="services" class="nav-content collapse">
        <!-- Subapartado Horarios -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/enfermeria/servicios/horarios/index.php">
                <i class="bi bi-circle"></i><span>Horarios</span>
            </a>
        </li>
        <!-- Subapartado Tipos de Servicios -->
        <li>
            <a href="<?php echo $url_base ?>secciones/enfermeria/servicios/tipos/index.php">
                <i class="bi bi-circle"></i><span>Tipos de Servicios</span>
            </a>
        </li>
    </ul>
</li>
<!-- Apartado Bitacora de asistencias -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/Bitacora_de_asistencias/admin/index.php">
        <i class="bi bi-clipboard-check"></i><span>Bitacora de asistencias</span>
    </a>
</li>
<!-- Apartado Enfermeros -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/enfermerosss/index.php">
        <i class="bi bi-circle"></i><span>Enfermeros</span>
    </a>
</li>
<!-- Apartado Nómina -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/control_de_nomina/index.php">
        <i class="bi bi-cash-coin"></i><span>Nómina</span>
    </a>
</li>