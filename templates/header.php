<?php
$url_base = "http://localhost:8080/OXILIVE/";
include_once 'C:\laragon\www\OXILIVE\connection/conexion.php';
include_once 'C:\laragon\www\OXILIVE\module/puestos.php';
include_once 'C:\laragon\www\OXILIVE\module/foto.php';
include_once 'C:\laragon\www\OXILIVE\secciones/notificaciones/consulta.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>OXILIVE S.A de C.V</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicons -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>img/OXILIVE.ico" rel="icon">
    <link href="<?php echo $url_base; ?>img/OXILIVE.ico" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="<?php echo $url_base; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="<?php echo $url_base; ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--Librerias de despliegue iconos-->




    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Template Main CSS File -->
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo $url_base ?>index.php" class="logo d-flex align-items-center">
                <img src="<?php echo $url_base; ?>img/LOGO_OXILIVE.jpg" alt="">
                <span class="d-none d-lg-block">OXILIVE</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <?php if ($_SESSION['puesto'] != 2) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon" href="../secciones/oxigeno/rutas/index.php" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-primary badge-number">
                                <?php echo $totalNoti ?>
                            </span>
                        </a><!-- End Notification Icon -->
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="max-height: 300px; overflow-y: auto;">
                            <li class="dropdown-header">
                                Tienes
                                <?php echo $totalNoti ?> nueva(s)
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php
                            // Ordenar las notificaciones por fecha (de la más reciente a la más antigua)
                            usort($notificaciones, function ($a, $b) {
                                return strtotime($b['fecha']) - strtotime($a['fecha']);
                            });
                            $count = 0;
                            foreach ($notificaciones as $arre) {
                                if ($count < 3) { // Mostrar solo las últimas tres notificaciones
                            ?>
                                    <li class="notification-item">
                                        <i class="bi bi-bell-fill"></i>
                                        <div>
                                            <h4 style="width: 400px;">
                                                <?php echo $arre['asunto']; ?>
                                            </h4>
                                            <p>
                                                <?php echo $arre['mensaje']; ?>
                                            </p>
                                            <p>
                                                <?php echo $arre['fecha']; ?>
                                            </p>
                                        </div>
                                    </li>
                            <?php
                                    $count++;
                                } else {
                                    break;
                                }
                            } ?>
                        </ul><!-- End Notification Dropdown Items -->
                    </li><!-- End Notification Nav -->

                <?php endif; ?>
                <li class="nav-item dropdown pe-3">


                    <!-- linea 129 header.php --> <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="data:image/jpg/png;base64,<?php echo base64_encode($_SESSION['foto']) ?>" id="fot" alt="Foto de perfil" style="width: 40px; height: 40px;" class="rounded-circle">

                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $_SESSION['us'] ?>
                        </span>
                    </a> <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <span>
                                <?php echo $datos['Nombre_puestos'] ?>
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php if ($_SESSION['puesto'] != 2) : ?>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="<?php echo $url_base; ?>secciones/perfil/account.php">
                                    <i class="bi bi-gear"></i>
                                    <span>Configuración</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        <?php endif; ?>
                        <?php if ($_SESSION['puesto'] == 10) : ?>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="<?php echo $url_base; ?>secciones/perfil/help.php">
                                    <i class="bi bi-question-circle"></i>
                                    <span>¿Necesitas ayuda?</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        <?php endif; ?>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" onclick="cerrar(this.value)">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Cerrar sesión</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <?php if ($_SESSION['puesto'] == 1) : ?>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo $url_base; ?>index.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->
            <?php endif; ?>
            <?php if ($_SESSION['puesto'] === 4 || $_SESSION['puesto'] === 1) : ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="<?php echo $url_base; ?>secciones/oxigeno/index.php">
                        <i class="bi bi-clipboard2-pulse"></i><span>Oxigeno</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <!--class="active"-->
                            <a href="<?php echo $url_base; ?>secciones/oxigeno/rutas/index.php">
                                <i class="bi bi-pin-map-fill"></i><span>Rutas</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/oxigeno/pacientes/index.php">
                                <i class="bi bi-person-rolodex"></i></i><span>Pacientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/administradora/index.php">
                                <i class="bi bi-person-workspace"></i><span>Administradora</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/aseguradoras/index.php">
                                <i class="bi bi-hospital-fill"></i><span>Aseguradora</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/bancos/index.php">
                                <i class="bi bi-bank2"></i><span>Bancos</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/oxigeno/choferes/index.php">
                                <i class="bi bi-truck-front-fill"></i><span>Choferes</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/oxigeno/carros/index.php">
                                <i class="bi bi-truck-front-fill"></i><span>Carros</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/oxigeno/equipo/index.php">
                                <i class="bi bi-usb-drive-fill"></i><span>Equipo de oxigeno</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/oxigeno/insumos/index.php">
                                <i class="bi bi-usb-drive-fill"></i><span>Insumos</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- <?php if ($_SESSION['puesto'] === 1) : ?> 
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#cata-nav" data-bs-toggle="collapse"
                    href="<?php echo $url_base; ?>secciones/call_center/index.php">
                    <i class="bi bi-book-half"></i><span>Call Center</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="cata-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?php echo $url_base; ?>secciones/call_center/medicos/index.php">
                            <i class="bi bi-circle"></i><span>Asistencias</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $url_base; ?>secciones/call_center/camara/camara.php">
                            <i class="bi bi-circle"></i><span>Scanner</span>
                        </a>
                    </li>
                </ul>
            </li>

            <?php endif; ?> -->
            <?php if ($_SESSION['puesto'] == 9) : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#cata-nav" data-bs-toggle="collapse" href="<?php echo $url_base; ?>secciones/Pchofer/index.php">
                        <i class="bi bi-book-half"></i><span>Mis rutas</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="cata-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/Pchofer/misrutas/index.php">
                                <i class="bi bi-circle"></i><span>En proceso</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['puesto'] == 2) : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#pa-nav" data-bs-toggle="collapse" href="<?php echo $url_base; ?>secciones/Padministradora/index.php">
                        <i class="bi bi-file-person-fill"></i><span>Mis pacientes</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="pa-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/Padministradora/pacientes/index.php">
                                <i class="bi bi-circle"></i><span>Pacientes</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#rua-nav" data-bs-toggle="collapse" href="<?php echo $url_base; ?>secciones/Padministradora/index.php">
                        <i class="bi bi-pin-map-fill"></i><span>Generar ruta</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="rua-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/Padministradora/rutas/index.php">
                                <i class="bi bi-circle"></i><span>Rutas pacientes</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['puesto'] == 8 || $_SESSION['puesto'] === 1) : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#alma-nav" data-bs-toggle="collapse" href="<?php echo $url_base; ?>secciones/catalogo/index.php">
                        <i class="bi bi-house-lock-fill"></i><span>Almacen</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="alma-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/almacen/materiales/index.php">
                                <i class="bi bi-bookmark-check-fill"></i><span>Materiales y recursos</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/almacen/salidas/index.php">
                                <i class="bi bi-escape"></i><span>Salida de Materiales y recursos</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/almacen/entradas/index.php">
                                <i class="bi bi-box-arrow-right"></i><span>Entrada de Materiales y recursos</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- Inicio apartado enfermeria -->
            <?php if ($_SESSION['puesto'] === 1 || $_SESSION['puesto'] === 6) : ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-capsule"></i><span>Enfermeria</span><i class="bi bi-chevron-down ms-auto"></i>

                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#alta" href="#"><i class="bi bi-circle"></i><span>Dar de Alta</span><i class="bi bi-chevron-down ms-auto fs-6"></i></a>
                            <ul id="alta" class="collapse">
                                <li><a href="<?php echo $url_base; ?>secciones/enfermeria/alta/codigo_servicios/index.php"><i class="bi bi-circle"></i><span>Código</span></a></li>
                                <li><a href="<?php echo $url_base; ?>secciones/enfermeria/alta/cpts/index.php"><i class="bi bi-circle"></i><span>Cpts</a></li>
                                <li><a href="<?php echo $url_base; ?>secciones/enfermeria/alta/administradora/index.php"><i class="bi bi-circle"></i><span>Administradora</a></li>
                            </ul>
                        </li>
                        <!--Aquí vamos a crear los procesos a realizar-->
                        <li><a class="nav-link" data-bs-toggle="collapse" data-bs-target="#crear" href="#"><i class="bi bi-circle"></i><span>Crear proceso</span><i class="bi bi-chevron-down ms-auto fs-6"></i></a>
                            <ul id="crear" class="collapse">
                                <li><a href="<?php echo $url_base; ?>secciones/enfermeria/hojaComplementaria/index.php"><i class="bi bi-circle"></i><span>Pacientes</span></a></li>
                                <li><a href="<?php echo $url_base; ?>secciones/enfermeria/procedimientos/index.php"><i class="bi bi-circle"></i>Procedimientos</span></a></li>
                                <li><a href="<?php echo $url_base; ?>secciones/enfermeria/lectura/index.php"><i class="bi bi-circle"></i>Historial Aseguradoras</span></a></li>
                        </li>
                    </ul>
                    <!--Chat-->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/enfermeria/Chat_/index.php"><i class="bi bi-circle"></i><span>Chat General</span></a>
                </li>

                <!-- Módulo de Servicios -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#services" href="#">
                        <i class="bi bi-circle"></i><span>Servicios</span><i class="bi bi-chevron-down ms-auto fs-6"></i>
                    </a>
                    <ul id="services" class="collapse">
                        <li>
                            <a href="<?php echo $url_base; ?>secciones/enfermeria/servicios/horarios/index.php">
                                <i class="bi bi-circle"></i><span>Horarios</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url_base ?>secciones/enfermeria/servicios/tipos/index.php">
                                <i class="bi bi-circle"></i><span>Tipos de Servicios</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Módulo de Bitacora de asistencias -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/enfermeria/Bitacora_de_asistencias/admin/index.php">
                        <i class="bi bi-circle"></i><span>Bitacora de asistencias</span>
                    </a>
                </li>
                <!-- Módulo de Enfermeros -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/enfermeria/enfermeros/index.php">
                        <i class="bi bi-circle"></i><span>Enfermeros</span>
                    </a>
                </li>
                <!-- Módulo de nomina -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/enfermeria/control_de_nómina/index.php">
                        <i class="bi bi-circle"></i><span>Nómina</span>
                    </a>
                </li>
                <!--Aquí termina-->

        </ul>
        </li><!-- End Forms Nav -->
    <?php endif; ?>

    <?php if ($_SESSION['puesto'] === 11) : ?>
        <!-- Apartado de bloque de departamento de enfermeria -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/Chat_/index.php">
                <i class="bi bi-wechat"></i>
                <span>Chat General</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/user/pages/indexPacientes.php">
                <i class="bi bi-person-fill"></i>
                <span>Pacientes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/user/pages/indexHorarios.php">
                <i class="bi bi-calendar3"></i>
                <span>Horarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/enfermeria/user/pages/indexAsistencias.php">
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
        <!--Aquí termina-->
        <!-- End Forms Nav -->
    <?php endif; ?>
    <?php if ($_SESSION['puesto'] === 5 || $_SESSION['puesto'] === 1 || $_SESSION['puesto'] == 12) : ?>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-telephone-fill"></i><span> Call Center</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo $url_base; ?>secciones/call_center/chatNotifica/index.php">
                        <i class="bi bi-circle"></i><span>Chat call center</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/call_center/camara/camara.php">
                        <i class="bi bi-circle"></i><span>Scanner</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/call_center/pacientes/index.php">
                        <i class="bi bi-circle"></i><span>Pacientes</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/aseguradoras/index.php">
                        <i class="bi bi-circle"></i><span>Aseguradoras</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/call_center/arribo/index.php">
                        <i class="bi bi-circle"></i><span>Arribo</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/call_center/servicios/index.php">
                        <i class="bi bi-circle"></i><span>Servicios</span>
                    </a>
                </li>
                <!--Aquí voy agregar el menu desplegable -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#alta" href="#"><i class="bi bi-circle"></i><span>Generar Incidencia</span><i class="bi bi-chevron-down ms-auto fs-6"></i></a>
                    <ul id="alta" class="collapse">
                        <li><a href="<?php echo $url_base; ?>secciones/call_center/eventos/index.php"><i class="bi bi-circle"></i><span>Crear Evento</span></a></li>
                        <li><a href="<?php echo $url_base; ?>secciones/call_center/eventos/cancelar/cancelar.php"><i class="bi bi-circle"></i><span>Cancelar Evento</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/call_center/medicos/index.php">
                        <i class="bi bi-circle"></i><span>Incidencia Médica</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->
    <?php endif; ?>
    <?php if ($_SESSION['puesto'] === 7 || $_SESSION['puesto'] === 1) : ?>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-circle"></i><span>Capital Humano</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo $url_base; ?>secciones/Capital_humano/empleados/index.php">
                        <i class="bi bi-circle"></i><span>Empleados</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/aseguradoras/index.php">
                        <i class="bi bi-circle"></i><span>Aseguradoras</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/oxigeno/choferes/index.php">
                        <i class="bi bi-circle"></i><span>Choferes</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/oxigeno/carros/index.php">
                        <i class="bi bi-circle"></i><span>Carros</span>
                    </a>
                </li>
            </ul>

        </li>

    <?php endif; ?>
    <?php if ($_SESSION['puesto'] === 3 || $_SESSION['puesto'] === 1) : ?>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#systemas-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-pc-display-horizontal"></i><span>Sistemas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="systemas-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo $url_base; ?>secciones/usuarios/index.php">
                        <i class="bi bi-circle"></i><span>Usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/puestos/index.php">
                        <i class="bi bi-circle"></i><span>Puestos</span>
                    </a>
                </li>
                <!-- <li>
              <a href="<?php echo $url_base; ?>secciones/sistemas/equipos/index.php">
                <i class="bi bi-circle"></i><span>Equipos</span>
              </a>
            </li> -->
                <li>
                    <a href="<?php echo $url_base; ?>secciones/sistemas/productos/index.php">
                        <i class="bi bi-circle"></i><span>Productos</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $url_base; ?>secciones/sistemas/logeo.php">
                        <i class="bi bi-circle"></i><span>Logeos</span>
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
    </ul>
    </aside><!-- End Sidebar-->
    <script>
        // Función para actualizar el estatus
        function actualizarEstatus() {
            $.ajax({
                url: "<?php echo $url_base; ?>/templates/get_estatus.php", // URL del servidor para obtener el estatus
                type: "POST",
            });
        }
        setInterval(actualizarEstatus, 1000);

        $(document).ready(function() {
            var url = window.location;

        });
    </script>

    <script>
        function mostrarImagen(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var fot = document.getElementById("fot");
                    fot.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        function cerrar(codigo) {
            Swal.fire({
                title: '¿Estas seguro de cerrar sesión?',
                cancelButtonText: 'Cancelar',
                icon: 'warning',
                buttons: true,
                showCancelButton: true,
                dangerMode: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    cerr(codigo)
                }
            })
        }

        function cerr(codigo) {
            parametros = {
                id: codigo
            };
            $.ajax({
                data: parametros,
                url: "<?php echo $url_base; ?>cerrar.php",
                type: "POST",
                beforeSend: function() {},
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se cerro la sesión',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(function() {
                        window.location = '<?php echo $url_base; ?>login.php';
                    });
                },
            });
        }
    </script>
    <script>
        var verMasBtn = document.getElementById('verMasBtn');
        verMasBtn.addEventListener('click', function(event) {
            event.preventDefault();
            var notificacionesOcultas = document.querySelectorAll('.notification-item.hidden');
            notificacionesOcultas.forEach(function(item) {
                item.classList.remove('hidden');
            });
            verMasBtn.style.display = 'none'; // Oculta el botón "Ver más"
        });
    </script>