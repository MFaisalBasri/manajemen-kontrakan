<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class=""></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin KOST</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= $title == 'Dashboard Admin' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            DATA MASTER
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseTwo" class="collapse <?= $title == 'Data Kamar' ? 'show' : ($title == 'Data User' ? 'show' : ($title == 'Data Admin' ? 'show' : '')); ?>
                    " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Master:</h6>
                    <a class="collapse-item <?= $title == 'Data Kamar' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>data-kamar">Data Kamar</a>
                    <a class="collapse-item <?= $title == 'Data User' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>data-user">Data User</a>
                    <a class="collapse-item <?= $title == 'Data Admin' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>data-admin">Data Admin</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item <?= $title == 'Data Penghuni' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>data-penghuni">
                <i class="fas fa-user fa-chart-area"></i>
                <span>Data Penghuni</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item <?= $title == 'Data Penyewaan' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>data-penyewaan">
                <i class="fas fa-fw fa-book"></i>
                <span>Data Penyewaan Kos</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item <?= $title == 'Data Tagihan' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>data-tagihan">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Tagihan</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item <?= $title == 'Data Pembayaran' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>data-pembayaran">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Pembayaran</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item <?= $title == 'Data Ajuan' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>data-ajuan">
                <i class="fas fa-fw fa-paper-plane"></i>
                <span>Ajuan</span></a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsLaporan" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-copy"></i>
                <span>Laporan</span>
            </a>
            <div id="collapsLaporan" class="collapse <?= $title == 'Laporan Penyewaan' ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Laporan:</h6>
                    <a class="collapse-item <?= $title == 'Laporan Penyewaan' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>laporan-penyewaan">Penyewaan</a>
                </div>
            </div>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                            <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>

            </nav>
            <!-- End of Topbar -->