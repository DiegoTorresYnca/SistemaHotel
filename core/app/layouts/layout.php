<?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
<?php $validarSesion = true; ?>
<?php
$modulos = ModulosData::obtenerModuloPadre();
$habilitados = RolesModulosData::obtenerRolesModulos($_SESSION["rol_id"]);
$notificaciones = NotificacionesData::obtenerNotificaciones($_SESSION["user_id"]);

$total_notificaciones = count($notificaciones);

$url_modulo = "?" . $_SERVER['QUERY_STRING'];
if ($url_modulo == "?view=perfil" || $url_modulo == "?view=proceso-pago") {
    $permitido = 1;
} else {
    $modulo = ModulosData::obtenerIdModulo($url_modulo);
    $id_modulo = $modulo->id;

    $permitido = 0;
    if (count($habilitados)>0) {
        foreach($habilitados as $elemento) {
            $modulo_habilitado = $elemento->id_modulo_usuario;

            if ($id_modulo == $modulo_habilitado) {
                $permitido = 1;
            }
        }           
    }

}

if ($permitido == 0) {
    header("Location: /index.php?view=seguridad");
}
?>
<?php else:?>
<?php $validarSesion = false; ?>
<?php endif;?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Creamos Marca">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <!-- <link rel="shortcut icon" href="./images/favicon.png"> -->
    <!-- Page Title  -->
    <title>Sistema Hotelero</title>
    <!-- StyleSheets  -->
    
    <link rel="stylesheet" href="assets/css/fontawesome/all.css">
    <link rel="stylesheet" href="assets/css/fontawesome/brands.css">
    <link rel="stylesheet" href="assets/css/fontawesome/solid.css">

    <link rel="stylesheet" href="assets/css/dashlite.css?ver=2.2.0">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=2.2.0">

    <link rel="stylesheet" href="assets/css/custom.css?ver=2.2.0">

    <style>
        .fc-toolbar-title{
            text-transform: capitalize !important;
        }
        .cursor-default{
            cursor:default !important;
        }
        .cursor-pointer{
            cursor:pointer !important;
        }
        .h-350{
            height:350px !important;
        }
    </style>

</head>

<?php  
    if(!$validarSesion):    
?>
    <body class="nk-body bg-white npc-general pg-auth">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- wrap @s -->
                <div class="nk-wrap nk-wrap-nosidebar">
                    <!-- content @s -->
                    <div class="nk-content ">
                        <div class="nk-split nk-split-page nk-split-md">
                            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                                <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                    <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                                </div>
                                <div class="nk-block nk-block-middle nk-auth-body">                                
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title text-center">Gestion Hotel</h3>                                 
                                        </div>
                                    </div>
                                    <form role="form" action="./?action=login" method="post">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="usuario">Usuario</label>
                                                <a class="link link-primary link-sm" tabindex="-1" href="#">¿Necesitas ayuda?</a>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" id="usuario" name="usuario" required="" placeholder="Escribe tu nombre de usuario">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="password">Contraseña</label>
                                                <a class="link link-primary link-sm" tabindex="-1" href="">¿Olvidaste tu contraseña?</a>
                                            </div>
                                            <div class="form-control-wrap">
                                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                </a>
                                                <input type="password" class="form-control form-control-lg" id="password" name="password" required="" placeholder="Escribe tu contraseña">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary btn-block">Iniciar sesión</button>
                                        </div>
                                    </form>
                                </div>                            
                                <div class="nk-block nk-auth-footer"> 
                                    <div class="mt-3">
                                        <p><a href="https://creamos-marca.com/" target="_blank">&copy; <?php echo date("Y")?> Creamos Marca.</a> Todos los derechos reservados.</p>
                                    </div>
                                </div>                             
                            </div>
                            <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                                <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                                    <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                                        <div class="slider-item">
                                            <div class="nk-feature nk-feature-center">
                                                <div class="nk-feature-img">
                                                    <img class="round" src="https://scontent.ftru2-2.fna.fbcdn.net/v/t1.0-9/128523902_207835764248149_3355373996271832319_o.jpg?_nc_cat=110&ccb=2&_nc_sid=8bfeb9&_nc_eui2=AeH0Z5oxo2KpZFw8DT871rb2uuXCpKZuDxe65cKkpm4PFzCK_Wg7YES5MVpRO-qa4ycWInnq6BAMG6qe2wXik9-H&_nc_ohc=vo26OjYokMwAX_FyWc0&_nc_ht=scontent.ftru2-2.fna&oh=12d6cc4ae70f94dc9377df5374aa68ec&oe=5FF7B9D8" srcset="./images/slides/promo-a2x.png 2x" alt="">
                                                </div>
                                                <div class="nk-feature-content py-4 p-sm-5">
                                                    <h4>Motor de Reservas</h4>
                                                    <p>El mejor lugar para reservar una habitación, debe ser la web de tu hotel.</p>
                                                </div>
                                            </div>
                                        </div><!-- .slider-item -->
                                        <div class="slider-item">
                                            <div class="nk-feature nk-feature-center">
                                                <div class="nk-feature-img">
                                                    <img class="round" src="https://scontent.ftru2-2.fna.fbcdn.net/v/t1.0-9/128523902_207835764248149_3355373996271832319_o.jpg?_nc_cat=110&ccb=2&_nc_sid=8bfeb9&_nc_eui2=AeH0Z5oxo2KpZFw8DT871rb2uuXCpKZuDxe65cKkpm4PFzCK_Wg7YES5MVpRO-qa4ycWInnq6BAMG6qe2wXik9-H&_nc_ohc=vo26OjYokMwAX_FyWc0&_nc_ht=scontent.ftru2-2.fna&oh=12d6cc4ae70f94dc9377df5374aa68ec&oe=5FF7B9D8" srcset="./images/slides/promo-b2x.png 2x" alt="">
                                                </div>
                                                <div class="nk-feature-content py-4 p-sm-5">
                                                    <h4>Página web</h4>
                                                    <p>Enamorá a tus futuros clientes (y a Google) con un diseño de alto rendimiento y autogéstion de promociones.</p>
                                                </div>
                                            </div>
                                        </div><!-- .slider-item -->
                                        <div class="slider-item">
                                            <div class="nk-feature nk-feature-center">
                                                <div class="nk-feature-img">
                                                    <img class="round" src="https://scontent.ftru2-2.fna.fbcdn.net/v/t1.0-9/128523902_207835764248149_3355373996271832319_o.jpg?_nc_cat=110&ccb=2&_nc_sid=8bfeb9&_nc_eui2=AeH0Z5oxo2KpZFw8DT871rb2uuXCpKZuDxe65cKkpm4PFzCK_Wg7YES5MVpRO-qa4ycWInnq6BAMG6qe2wXik9-H&_nc_ohc=vo26OjYokMwAX_FyWc0&_nc_ht=scontent.ftru2-2.fna&oh=12d6cc4ae70f94dc9377df5374aa68ec&oe=5FF7B9D8" srcset="./images/slides/promo-c2x.png 2x" alt="">
                                                </div>
                                                <div class="nk-feature-content py-4 p-sm-5">
                                                    <h4>Gestión de Hotel Creamos Marca</h4>
                                                    <p>La forma más sencilla de visualizar tus reservas, cargar consumos y administrar tu hotel.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-dots"></div>
                                    <div class="slider-arrows"></div>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>           
            </div>        
        </div>        
    </body>
<?php else:?>
    <body class="nk-body bg-lighter npc-general has-sidebar ">
        <div class="nk-app-root">
            <div class="nk-main ">
                <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                    <!--Header-->
                    <div class="nk-sidebar-element nk-sidebar-head">
                        <div class="nk-sidebar-brand">
                            <a href="#" class="logo-link nk-sidebar-logo">
                                <img class="logo-light logo-img" src="assets/images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="assets/images/logo.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="nk-menu-trigger mr-n2">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                    <!--End Header-->
                    <!--Sidebar-->
                    <div class="nk-sidebar-element">
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu" data-simplebar>
                                <ul class="nk-menu">                                   

                                    <?php
                                    foreach($modulos as $item) {
                                        $activo = 0;
                                        $codigo_modulo = $item->id;
                                        $nombre_modulo = $item->nombre_modulo;
                                        $url_modulo = $item->url_modulo;
                                        $icono_modulo = $item->icono_modulo;

                                        if (count($habilitados)>0) {
                                            foreach($habilitados as $element) {
                                                $codigo_habilitado = $element->id_modulo_usuario;

                                                if ($codigo_modulo == $codigo_habilitado) {
                                                    $activo = 1;
                                                }
                                            }           
                                        }

                                        $hijos = ModulosData::obtenerModuloHijo($codigo_modulo);

                                        $tiene_hijos = count($hijos);

                                        if ($activo == 1) {

                                            if ($tiene_hijos == 0) {
                                    ?>
                                    <li class="nk-menu-item">
                                        <a href="index.php<?php echo $url_modulo; ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="<?php echo $icono_modulo; ?>"></em></span>
                                            <span class="nk-menu-text"><?php echo $nombre_modulo; ?></span>
                                        </a>
                                    </li>
                                    <?php
                                            } else {
                                    ?>
                                    <li class="nk-menu-item has-sub">
                                        <a href="index.php<?php echo $url_modulo; ?>" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="<?php echo $icono_modulo; ?>"></em></span>
                                            <span class="nk-menu-text"><?php echo $nombre_modulo; ?></span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <?php
                                            foreach($hijos as $item_h) {
                                                $activo_h = 0;
                                                $codigo_modulo_h = $item_h->id;
                                                $nombre_modulo_h = $item_h->nombre_modulo;
                                                $url_modulo_h = $item_h->url_modulo;
                                                $icono_modulo_h = $item_h->icono_modulo;

                                                if (count($habilitados)>0) {
                                                    foreach($habilitados as $element) {
                                                        $codigo_habilitado = $element->id_modulo_usuario;

                                                        if ($codigo_modulo_h == $codigo_habilitado) {
                                                            $activo_h = 1;
                                                        }
                                                    }           
                                                }

                                                if ($activo_h == 1) {
                                            ?>
                                            <li class="nk-menu-item">
                                                <a href="index.php<?php echo $url_modulo_h; ?>" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="<?php echo $icono_modulo_h; ?>"></em></span>
                                                    <span class="nk-menu-text"><?php echo $nombre_modulo_h; ?></span>
                                                </a>
                                            </li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php       
                                            }
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Sidebar-->
                </div>
        <!---->

        <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="assets/images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="assets/images/logo.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li>
                                        <p class="text-primary badge cursor-default">Beta</p>
                                    </li>
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status"><?php echo $_SESSION["rol_nombre"]; ?></div>
                                                    <div class="user-name dropdown-indicator"><?php echo $_SESSION["user_nombre"]; ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?php echo $_SESSION["user_nombre"]; ?></span>
                                                        <span class="sub-text"><?php echo $_SESSION["user_correo"]; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="/index.php?view=perfil"><em class="icon ni ni-user-alt"></em><span>Perfil</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Configuración</span></a></li>
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Fondo oscuro</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="./logout.php"><em class="icon ni ni-signout"></em><span>Cerrar sesión</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->                                    
                                    <?php if ($total_notificaciones == 0) { ?>
                                    <li class="dropdown notification-dropdown mr-n1">                                        
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon">
                                            <div class=""><em class="icon ni ni-bell"></em></div>
                                        </a>
                                    </li><!-- .dropdown -->
                                    <?php } else { ?>
                                    <li class="dropdown notification-dropdown mr-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notificaciones</span>
                                                <a href="#">Marcar todas leidas</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    <?php
                                                    $n = 0;
                                                    foreach($notificaciones as $notificacion) {
                                                        $n++;

                                                        if ($n <= 3) {
                                                            $notificacion_resumen = $notificacion->resumen;
                                                            $notificacion_fecha = $notificacion->fecha;
                                                    ?>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text"><?php echo $notificacion_resumen; ?></div>
                                                            <div class="nk-notification-time"><?php echo $notificacion_fecha; ?></div>
                                                        </div>
                                                    </div> 
                                                    <?php
                                                        }
                                                    }
                                                    ?> 
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="#">Ver todos</a>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                    <?php } ?>
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">

                                <?php View::load("reservas");?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> <a href="https://creamos-marca.com/" target="_blank">&copy; <?php echo date("Y")?> Creamos Marca.</a> Todos los derechos reservados.
                            </div>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#">Terminos y condiciones</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Privacidad</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Ayuda</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!---->


            </div>
        </div>
    </body>    
<?php endif; ?>
    <!-- ============================================
    ============== Custom JavaScripts ===============
    ============================================= -->
    <script src="./assets/js/bundle.js?ver=2.2.0"></script>
    <script src="./assets/js/scripts.js?ver=2.2.0"></script>
    <script src="./assets/js/custom.js?ver=2.2.0"></script>
    
    <?php if (isset($_GET['view'])) { ?>

    <?php if ($_GET['view'] == "dashboard")  { ?>
        <script src="assets/js/page/dashboard/dashboard.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "reservas")  { ?>
    <script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.js'></script>
    <script src="assets/js/page/reservas/reservas.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "calendario")  { ?>
    <script src="./assets/js/libs/fullcalendar.js?ver=2.2.0"></script>
    <script src="./assets/js/libs/locales/es.js?ver=2.2.0"></script>  
    <script src="./assets/js/apps/calendar.js?ver=2.2.2"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "reporte-reserva")  { ?>
    <!-- DataTable-->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <!--DataTable Button-->
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

    <script src="assets/js/page/reportes/mis-reservas.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "clientes")  { ?>
        <script src="assets/js/page/clientes/clientes.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "feriados")  { ?>
        <script src="assets/js/page/feriados/feriados.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "documentos")  { ?>
        <script src="assets/js/page/documentos/documentos.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "roles")  { ?>
        <script src="assets/js/page/roles/roles.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "modulos")  { ?>
        <script src="assets/js/page/modulos/modulos.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "usuarios")  { ?>
        <script src="assets/js/page/usuarios/usuarios.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "tarifas")  { ?>
        <script src="assets/js/page/tarifas/tarifas.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "categorias")  { ?>
        <script src="assets/js/page/categorias/categorias.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "habitaciones")  { ?>
        <script src="assets/js/page/habitaciones/habitaciones.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "notificaciones")  { ?>
        <script src="assets/js/page/notificaciones/notificaciones.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "tipo-moneda")  { ?>
        <script src="assets/js/page/monedas/monedas.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "agregados")  { ?>
        <script src="assets/js/page/agregados/agregados.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "promociones")  { ?>
        <script src="assets/js/page/promociones/promociones.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "estado-pago")  { ?>
        <script src="assets/js/page/pagos/pagos.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "referidos")  { ?>
        <script src="assets/js/page/referidos/referidos.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "perfil")  { ?>
        <script src="assets/js/page/perfil/perfil.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "caja")  { ?>
        <script src="assets/js/page/caja/caja.js"></script>
    <?php } ?>

    <?php if ($_GET['view'] == "reporte-reserva-detallado" || $_GET['view'] == "ver-tarifas")  { ?>
    <!-- DataTable-->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <!--DataTable Button-->
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

    <script src="assets/js/page/reportes/reserva-detallado.js"></script>
    <script src="assets/js/page/tarifas/tarifas.js"></script>
    <?php } ?>
    
    <?php } ?>

</html>