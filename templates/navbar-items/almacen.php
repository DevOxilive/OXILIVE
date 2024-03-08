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
        <!--Apartado de Gestion de Insumos-->
        <li>
            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#gestionMat" href="#">
                <i class="bi bi-circle"></i><span>Vales</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
            </a>
            <ul id="gestionMat" class="collapse">
                <li>
                    <a href="<?php echo $url_base; ?>secciones/almacen/vales/insumos.php">
                        <i class="bi bi-circle"></i><span>Insumos</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/almacen/vales/oxigeno.php">
                        <i class="bi bi-circle"></i><span>Oxìgeno</span>
                    </a>
                </li>
            </ul>
        </li>
        <!--Apartado Gestión de Material-->
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
                    <a href="<?php echo $url_base; ?>secciones/folios/pages/historial.php">
                        <i class="bi bi-circle"></i><span>Historial</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/folios/archivo/archivoFolios.php">
                        <i class="bi bi-circle"></i><span>Archivo</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>