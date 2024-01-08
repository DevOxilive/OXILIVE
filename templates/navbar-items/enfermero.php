<!-- Apartado Pacientes -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/user/pages/indexPacientes.php">
        <i class="bi bi-person-fill"></i>
        <span>Pacientes</span>
    </a>
</li>
<!-- Apartado Horarios -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/user/pages/indexHorarios.php">
        <i class="bi bi-calendar3"></i>
        <span>Horarios</span>
    </a>
</li>
<!-- Apartado Asistencias -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/user/pages/indexAsistencias.php?id=<?php echo $_SESSION['idus']; ?>">
        <i class="bi bi-calendar2-check"></i>
        <span>Asistencias</span>
    </a>
</li>
<!--Implementación de apartado registros clínico y cuidados generales-->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/registroYcuidados/registrosClinicos/registrosCreados.php">
        <i class="bi bi-person-hearts"></i>
        <span>Registros Clinicos</span>
    </a>
</li>