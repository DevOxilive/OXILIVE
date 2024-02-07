<!-- Módulo Oxígeno -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="<?php echo $url_base; ?>secciones/oxigeno/index.php">
        <i class="bi bi-clipboard2-pulse"></i><span>Oxigeno</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <!-- Apartado Rutas -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/oxigeno/rutas/index.php">
                <i class="bi bi-circle"></i><span>Rutas</span>
            </a>
        </li>
        <!-- Apartado Pacientes -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/oxigeno/pacientes/index.php">
                <i class="bi bi-circle"></i><span>Pacientes</span>
            </a>
        </li>
        <!-- Apartado Administradora -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/administradora/index.php">
                <i class="bi bi-circle"></i><span>Administradora</span>
            </a>
        </li>
        <!-- Apartado Bancos -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/bancos/index.php">
                <i class="bi bi-circle"></i><span>Bancos</span>
            </a>
        </li>
        <!-- Apartado Choferes -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/oxigeno/choferes/index.php">
                <i class="bi bi-circle"></i><span>Choferes</span>
            </a>
        </li>
        <!-- Apartado Carros -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/oxigeno/carros/index.php">
                <i class="bi bi-circle"></i><span>Carros</span>
            </a>
        </li>
        <!-- Apartado Equipo de Oxigeno -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/oxigeno/equipo/index.php">
                <i class="bi bi-circle"></i><span>Equipo de oxigeno</span>
            </a>
        </li>
        <!-- Apartado Insumos -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/oxigeno/insumos/index.php">
                <i class="bi bi-circle"></i><span>Insumos</span>
            </a>
        </li>
    </ul>
</li>
<!-- Módulo Almacén -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#alma-nav" data-bs-toggle="collapse" href="<?php echo $url_base; ?>secciones/catalogo/index.php">
        <i class="bi bi-house-lock-fill"></i><span>Almacen</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="alma-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <!-- Apartado Materiales y Recursos -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/almacen/materiales/index.php">
                <i class="bi bi-circle"></i><span>Materiales y Recursos</span>
            </a>
        </li>
        <!-- Apartado Gestión de Material -->
        <li>
            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#gestionMat" href="#">
                <i class="bi bi-circle"></i><span>Gestión de Material</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
            </a>
            <ul id="gestionMat" class="collapse">
                <li>
                    <a href="<?php echo $url_base; ?>secciones/almacen/pages/buscador.php">
                        <i class="bi bi-circle"></i><span>Entrada o Salida</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Historial</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#foliosAlma" href="#">
                <i class="bi bi-circle"></i><span>Folios</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
            </a>
            <ul id="foliosAlma" class="collapse">
                <li>
                    <a href="<?php echo $url_base; ?>secciones/folios/index.php">
                        <i class="bi bi-circle"></i><span>Existencias</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Historial</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<!-- Módulo Enfermeria -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-capsule"></i><span>Enfermeria</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <!-- Apartado Dar de Alta -->
    <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#alta" href="#">
                <i class="bi bi-circle"></i><span>Dar de Alta</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
            </a>
            <ul id="alta" class="collapse">
                <!-- Subapartado Código -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/enfermeria/alta/codigo_servicios/index.php">
                        <i class="bi bi-circle"></i><span>Código</span>
                    </a>
                </li>
                <!-- Subapartado CPTs -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/enfermeria/alta/cpts/index.php">
                        <i class="bi bi-circle"></i><span>Cpts</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Apartado Crear Proceso -->
        <li>
            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#crear" href="#">
                <i class="bi bi-circle"></i><span>Crear proceso</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
            </a>
            <ul id="crear" class="collapse">
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
                <!-- Subapartado Historial Aseguradoras -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/enfermeria/lectura/index.php">
                        <i class="bi bi-circle"></i><span>Historial Aseguradoras</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Apartado Servicios -->
        <li>
            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#services" href="#">
                <i class="bi bi-circle"></i><span>Servicios</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
            </a>
            <ul id="services" class="collapse">
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
        <li>
            <a href="<?php echo $url_base; ?>secciones/enfermeria/Bitacora_de_asistencias/admin/index.php">
                <i class="bi bi-circle"></i><span>Bitacora de asistencias</span>
            </a>
        </li>
        <!-- Apartado Enfermeros -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/enfermeria/enfermeros/index.php">
                <i class="bi bi-circle"></i><span>Enfermeros</span>
            </a>
        </li>
        <!-- Apartado Nómina -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/enfermeria/control_de_nomina/index.php">
                <i class="bi bi-circle"></i><span>Nómina</span>
            </a>
        </li>
    </ul>
</li>
<!-- Módulo Call Center -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-telephone-fill"></i><span> Call Center</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <!-- Apartado Pacientes -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/call_center/pacientes/index.php">
                <i class="bi bi-circle"></i><span>Pacientes</span>
            </a>
        </li>

        <!-- Apartado Arribo -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/call_center/arribo/index.php">
                <i class="bi bi-circle"></i><span>Arribo</span>
            </a>
        </li>
        <!-- Apartado Servicios -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/call_center/servicios/index.php">
                <i class="bi bi-circle"></i><span>Servicios</span>
            </a>
        </li>
        <!-- Apartado Generar Incidencias -->
        <li>
            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#alta" href="#"><i class="bi bi-circle"></i><span>Generar Incidencia</span><i class="bi bi-chevron-down ms-auto fs-6"></i></a>
            <ul id="alta" class="collapse">
                <!-- Subapartado Crear Evento -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/call_center/eventos/index.php">
                        <i class="bi bi-circle"></i><span>Crear Evento</span>
                    </a>
                </li>
                <!-- Subapartado Cancelar Evento -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/call_center/eventos/cancelar/cancelar.php">
                        <i class="bi bi-circle"></i><span>Cancelar Evento</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<!-- Módulo Capital Humano -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person-circle"></i><span>Capital Humano</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <!-- Apartado Empleados -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/Capital_humano/empleados/index.php">
                <i class="bi bi-circle"></i><span>Empleados</span>
            </a>
        </li>
        <!-- Apartado Choferes -->
        <!-- <li>
            <a href="<?php echo $url_base; ?>secciones/oxigeno/choferes/index.php">
                <i class="bi bi-circle"></i><span>Choferes</span>
            </a>
        </li>-->
    </ul>
</li>
<!-- Módulo Sistemas -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#systemas-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-pc-display-horizontal"></i><span>Sistemas</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="systemas-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <!-- Apartado Usuarios -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/sistemas/usuarios/index.php">
                <i class="bi bi-circle"></i><span>Usuarios</span>
            </a>
        </li>
        <!-- Apartado Puestos -->
        <li>
            <a href="<?php $url_base; ?>secciones/puestos/index.php">
                <i class="bi bi-circle"></i><span>Puestos</span>
            </a>
        </li>
        <!-- Apartado Entrada de Materiales y Recursos -->
        <li>
            <a href="<?php echo $url_base; ?>secciones/almacen/entradas/index.php">
                <i class="bi bi-box-arrow-right"></i><span>Entrada de Materiales y recursos</span>
            </a>
        </li>
    </ul>
</li>