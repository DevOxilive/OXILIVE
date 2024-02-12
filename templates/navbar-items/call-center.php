<!-- Apartado Pacientes -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/call_center/pacientes/index.php">
        <i class="bi bi-person-rolodex"></i><span>Pacientes</span>
    </a>
</li>
<!-- Apartado Arribo -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/call_center/arribo/index.php">
        <i class="bi bi-box-arrow-in-right"></i><span>Arribo</span>
    </a>
</li>
<!-- Apartado Servicios -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/call_center/servicios/index.php">
        <i class="bi bi-circle"></i><span>Servicios</span>
    </a>
</li>
<!-- Apartado Generar Incidencia -->
<li class="nav-item">
    <a class="nav-link collapsed" class="nav-link" data-bs-toggle="collapse" data-bs-target="#alta" href="#"><i class="bi bi-circle"></i><span>Generar Incidencia</span><i class="bi bi-chevron-down ms-auto fs-6"></i></a>
    <ul id="alta" class="nav-content collapse">
        <!-- Subapartado Crear Evento -->
        <li>
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/call_center/eventos/index.php">
                <i class="bi bi-circle"></i><span>Crear Evento</span>
            </a>
        </li>
        <!-- Subapartado Cancelar Evento -->
        <li>
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/call_center/eventos/cancelar/cancelar.php">
                <i class="bi bi-circle"></i><span>Cancelar Evento</span>
            </a>
        </li>
    </ul>
</li>
