<?php
    session_start();
?>
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>UCB | Sistema de Compras y Ventas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template"
            name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../public/images/favicon.ico">

        <link href="../public/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>

        <!-- DataTables -->
        <link href="../public/libs/datatables/dataTables.min.css" rel="stylesheet" type="text/css" />
        <!-- preloader css -->
        <link rel="stylesheet" href="../public/css/preloader.min.css"
            type="text/css" />

        <!-- Bootstrap Css -->
        <link href="../public/css/bootstrap.min.css" id="bootstrap-style"
            rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="../public/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        
        <!-- Icons Css -->
        <link href="../public/css/icons.min.css" rel="stylesheet" type="text/css"
            />
        <!-- App Css-->
        <link href="../public/css/app.min.css" id="app-style" rel="stylesheet"
            type="text/css" />
        <!-- Custom Css -->
        <link href="../public/css/custom.css" rel="stylesheet" type="text/css" />

        <link href="../public/css/main.css" rel="stylesheet"
    type="text/css" />
        <style type="text/css">
            .mayusculas{
                text-transform:uppercase;
            }	
            textarea {
                resize: none;
            }
        </style>
    </head>

    <body data-layout="horizontal">

        <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Arquitectura</span>
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Arquitectura</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item"
                                id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg
                                    layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg
                                    layout-mode-light"></i>
                            </button>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i data-feather="grid" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg
                                dropdown-menu-end">
                                <div class="p-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item"
                                                href="#">
                                                <img
                                                    src="../public/images/brands/github.png"
                                                    alt="Github">
                                                <span>GitHub</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item"
                                                href="#">
                                                <img
                                                    src="../public/images/brands/bitbucket.png"
                                                    alt="bitbucket">
                                                <span>Bitbucket</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item"
                                                href="#">
                                                <img
                                                    src="../public/images/brands/dribbble.png"
                                                    alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item"
                                                href="#">
                                                <img
                                                    src="../public/images/brands/dropbox.png"
                                                    alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item"
                                                href="#">
                                                <img
                                                    src="../public/images/brands/mail_chimp.png"
                                                    alt="mail_chimp">
                                                <span>Mail Chimp</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item"
                                                href="#">
                                                <img
                                                    src="../public/images/brands/slack.png"
                                                    alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item
                                noti-icon position-relative"
                                id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i data-feather="bell" class="icon-lg"></i>
                                <!--notificacion-->
                                <span id="nNotificaciones" class="badge bg-danger rounded-pill">3</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg
                                dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Movimientos </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small text-reset
                                                text-decoration-underline">
                                                Unread (3)</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#!" class="text-reset
                                        notification-item">
                                        <!---->
                                        <div id="nuevaNotificacion" class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img
                                                    src="../public/images/users/avatar-3.jpg"
                                                    class="rounded-circle
                                                    avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-13
                                                    text-muted">
                                                    <p class="mb-1">It will seem
                                                        like simplified English.</p>
                                                    <p class="mb-0"><i
                                                            class="mdi
                                                            mdi-clock-outline"></i>
                                                        <span>1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!---->
                                    </a>
                                    <a href="#!" class="text-reset
                                        notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm
                                                me-3">
                                                <span class="avatar-title
                                                    bg-primary rounded-circle
                                                    font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your order is
                                                    placed</h6>
                                                <div class="font-size-13
                                                    text-muted">
                                                    <p class="mb-1">If several
                                                        languages coalesce the
                                                        grammar</p>
                                                    <p class="mb-0"><i
                                                            class="mdi
                                                            mdi-clock-outline"></i>
                                                        <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset
                                        notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm
                                                me-3">
                                                <span class="avatar-title
                                                    bg-success rounded-circle
                                                    font-size-16">
                                                    <i class="bx
                                                        bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your item is
                                                    shipped</h6>
                                                <div class="font-size-13
                                                    text-muted">
                                                    <p class="mb-1">If several
                                                        languages coalesce the
                                                        grammar</p>
                                                    <p class="mb-0"><i
                                                            class="mdi
                                                            mdi-clock-outline"></i>
                                                        <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#!" class="text-reset
                                        notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img
                                                    src="../public/images/users/avatar-6.jpg"
                                                    class="rounded-circle
                                                    avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-13
                                                    text-muted">
                                                    <p class="mb-1">As a
                                                        skeptical Cambridge
                                                        friend of mine
                                                        occidental.</p>
                                                    <p class="mb-0"><i
                                                            class="mdi
                                                            mdi-clock-outline"></i>
                                                        <span>1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14
                                        text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle
                                            me-1"></i> <span>View More..</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item
                                bg-soft-light border-start border-end"
                                id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img class="rounded-circle header-profile-user"
                                        src="<?php if(empty($_SESSION["personaimagen"])){
                                                    echo "../files/imagen/default.png";
                                                    }
                                                    else{
                                                    echo "../file/usuarios/".$_SESSION["personaimagen"];
                                                    }    ?>"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1
                                    fw-medium"><?php echo $_SESSION["personanombre"];?></span>
                                <i class="mdi mdi-chevron-down d-none
                                    d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="mdi
                                        mdi-face-profile font-size-16
                                        align-middle me-1"></i> Ver Perfíl</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../ajax/usuario.php?op=7"><i class="mdi
                                        mdi-logout font-size-16 align-middle
                                        me-1"></i> Cerrar Sesión</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">

                                <?php
                                    if ($_SESSION['escritorio']==1){
                                        echo '<li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle arrow-none" href="escritorio.php">
                                                <i data-feather="home"></i>
                                                <span data-key="t-dashboard">Escritorio</span>
                                            </a>
                                        </li>';
                                    }
                                ?>
                                <?php
                                    if ($_SESSION['almacen'] == 1) {
                                        echo '<li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle arrow-none" href="javascript: void(0);" role="button">
                                                    <i data-feather="grid"></i>
                                                    <span data-key="t-apps">Almacén</span>
                                                </a>
                                                <div class="dropdown-menu" aria-expanded="false">
                                                    <a class="dropdown-item" target="_self" href="articulo.php"><i class="bx bx-circle"></i> Artículos</a>
                                                    <a class="dropdown-item" target="_self" href="categoria.php"><i class="bx bx-circle"></i> Categorías</a>
                                                </div>
                                            </li>';
                                    }
                                ?>
                                
                                <?php
                                    if ($_SESSION['acceso']==1){
                                        echo '<li class="nav-item dropdown"> 
                                                <a  class="nav-link dropdown-toggle arrow-none" href="javascript: void(0);" role="button">
                                                
                                                    <i data-feather="grid"></i>
                                                    <span data-key="t-authentication">Autenticación</span>
                                                </a>
                                                <div class="dropdown-menu" aria-expanded="false">
                                                    <a class="dropdown-item" target="_self" href="usuario.php"><i class="bx bx-circle"></i> Usuarios</a>
                                                    <a class="dropdown-item" target="_self" href="permiso.php"><i class="bx bx-circle"></i> Permisos</a>
                                                    <a class="dropdown-item" target="_self" href="rol.php"><i class="bx bx-circle"></i> Rol</a>
                                                </div>
                                            </li>';
                                    }
                                ?>                              
                                                

                                <li class="menu-title mt-2" data-key="t-components">Reportes</li>
                                <?php
                                if ($_SESSION['consulta_compras'] == 1) {
                                    echo '<li class="nav-item">
                                            <a href="javascript: void(0);" class="nav-link has-arrow">
                                                <i data-feather="users"></i>
                                                <span data-key="t-authentication">Consulta de Compras</span>
                                            </a>
                                            <div class="dropdown-menu" aria-expanded="false">
                                                <a class="dropdown-item" target="_self" href="ingreso_fecha.php"><i class="bx bx-circle"></i> Consulta Compras</a>
                                            </div>
                                        </li>';
                                }
                            ?>

                                <?php
                                    if ($_SESSION['compras'] == 1) {
                                        echo '<li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle arrow-none" href="javascript: void(0);" role="button">
                                                    <i data-feather="users"></i>
                                                    <span data-key="t-authentication">Compras</span>
                                                </a>
                                                <div class="dropdown-menu" aria-expanded="false">
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" target="_self"  href="ingreso.php"><i class="bx bx-circle"></i> Ingresos</a>
                                                        <a  class="dropdown-item" target="_self"  href="proveedor.php"><i class="bx bx-circle"></i> Proveedores</a>
                                                    </div>
                                                </div>
                                            </li>';
                                    }
                                ?>
                          
                                <?php
                                    if ($_SESSION['ventas'] == 1) {
                                        echo '<li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle arrow-none" href="javascript: void(0);" role="button">
                                                    <i data-feather="users"></i>
                                                    <span data-key="t-authentication">Ventas</span>
                                                </a>
                                                <div class="dropdown-menu" aria-expanded="false">
                                                    <a  class="dropdown-item" target="_self"  href="venta.php"><i class="bx bx-circle"></i> Ventas</a>
                                                    <a  class="dropdown-item" target="_self"  href="cliente.php"><i class="bx bx-circle"></i> Clientes</a>
                                                </div>
                                            </li>';
                                    }
                                ?>

                            <?php
                                if ($_SESSION['consulta_ventas'] == 1) {
                                    echo '<li class="nav-item">
                                            <a href="javascript: void(0);" class="nav-link has-arrow">
                                                <i data-feather="users"></i>
                                                <span data-key="t-authentication">Consulta de Ventas</span>
                                            </a>
                                            <div class="dropdown-menu" aria-expanded="false">
                                                <a  class="dropdown-item" target="_self"  href="venta_fecha_cliente.php"><i class="bx bx-circle"></i> Consulta Ventas</a>
                                            </div>
                                        </li>';
                                }
                            ?>

                            </ul>
                        </div>
                    </nav>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
        </div>
