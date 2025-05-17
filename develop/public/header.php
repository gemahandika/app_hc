<?php
if (!isset($_SESSION['admin_username'])) {
    header("location:../login/login.php");
}
include '../../../app/config/koneksi.php';
$user1 = $_SESSION['admin_username'];
$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user1'") or die(mysqli_error($koneksi));
$data1 = $sql->fetch_array();
$status = $data1["status"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard HC</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../../app/assets/img/JNE.png">

    <!-- Bootstrap & App Styles -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../../app/assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../../app/assets/css/custom.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> -->
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Dashboard HC</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $status ?> <i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li> -->
                    <li><a class="dropdown-item" href="../login/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">=====================</div>
                        <a class="nav-link" href="../home/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt me-1"></i></div>
                            Dashboard
                        </a>
                        <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                        <a class="nav-link" href="../karyawan/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Data Karyawan
                        </a>
                        <a class="nav-link" href="../karyawan_resign/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-times"></i></div>
                            Karyawan Resign
                        </a>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#submenuDatabase" aria-expanded="false" aria-controls="submenuDatabase">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-database me-1"></i>
                            </div>
                            Setting Database
                            <i class="fas fa-chevron-down ms-auto toggle-arrow"></i>
                        </a>

                        <div class="collapse" id="submenuDatabase">
                            <ul class="sb-sidenav-menu-nested nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="../tb_section/index.php">- Data Section</a>
                                </li>
                                <?php if (in_array("super_admin", $_SESSION['admin_akses'])) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">- Data Unit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">- Data Posisi</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if (in_array("super_admin", $_SESSION['admin_akses'])) { ?>
                            <a class="nav-link" href="../user_app/index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-gears"></i></div>
                                User App
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">