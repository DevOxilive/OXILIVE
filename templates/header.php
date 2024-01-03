<?php
$url_base = "http://localhost:8080/OXILIVE/";
include_once ('C:\laragon\www\OXILIVE\connection/conexion.php');
include_once ('C:\laragon\www\OXILIVE\module/puestos.php');
include_once ('C:\laragon\www\OXILIVE\module/foto.php');
include_once ('C:\laragon\www\OXILIVE\secciones/notificaciones/consulta.php');
//$url_base = "https://swoe.oxilive.com.mx/";
//include_once ($url_base . 'connection/conexion.php');
//include_once ($url_base . 'module/puestos.php');
//include_once ($url_base . 'module/foto.php');
//include_once ($url_base . 'secciones/notificaciones/consulta.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicons -->
    <link href="<?php echo $url_base; ?>img/OXILIVE.ico" rel="icon">
    <link href="<?php echo $url_base; ?>img/OXILIVE.ico" rel="apple-touch-icon">
    <!-- Bootstrap 5.3.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- SweetAlert2 11.10.1 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons 1.11.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Datatables 1.13.7 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- Estilos del template -->
    <link href="<?php echo $url_base; ?>assets/css/style.css" rel="stylesheet">
    <title>OXILIVE S.A de C.V</title>
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
                <!-- aqui empiesan las secciones paracada nivel de usuario -->
                <li class="nav-item dropdown pe-3">
                    <!-- linea 129 header.php --> <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?php echo $_SESSION['foto'] ?>" id="fot" alt="Foto de perfil" style="width: 40px; height: 40px;" class="rounded-circle">
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
            <!-- Módulo Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Módulo Chat General -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo $url_base; ?>secciones/chatNotifica/index.php">
                    <i class="bi bi-chat-square-text"></i>
                    <span>Chat General</span>
                </a>
            </li>
            <?php switch ($_SESSION['puesto']) {
                //Administrador
                case 1:
                    include("navbar-items/admin.php");
                break;
                //Administradora POR CHECAR
                case 2:
                break;
                //Sistemas
                case 3:
                    include("navbar-items/sistemas.php");
                break;
                //Oxígeno
                case 4:
                    include("navbar-items/oxigeno.php");
                break;
                //Call Center
                case 5:
                    include("navbar-items/call-center.php");
                break;
                //Enfermeria
                case 6:
                    include("navbar-items/enfermeria.php");
                break;
                //Capital Humano
                case 7:
                    include("navbar-items/capital-humano.php");
                break;
                //Almacén
                case 8:
                    include("navbar-items/almacen.php");
                break;
                //Chofer
                case 9:
                break;
                //Cliente POR CHECAR
                case 10:
                break;
                //Enfermero
                case 11:
                    include("navbar-items/enfermeria.php");
                break;
                //Médico
                case 12:
                break;
            } ?>
            <!--?if ($_SESSION['puesto'] === 2) { ?>
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
            ?php }
            if ($_SESSION['puesto'] === 9) { ?>
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
            ?php } ?>-->
        </ul>
    </aside>
    <!-- JQuery 3.7.1 JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Función para actualizar el estatus
        function actualizarEstatus() {
            $.ajax({
                url: "<?php echo $url_base; ?>templates/get_estatus.php", // URL del servidor para obtener el estatus
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
    <!-- Datatables 1.13.7 JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- Template Main JS File -->
    <script defer src="<?php echo $url_base; ?>assets/js/main.js"></script>
    <!-- Bootstrap 5.3.2 JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- SweetAlert2 11.10.1 JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>