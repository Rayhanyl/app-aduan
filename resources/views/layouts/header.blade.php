<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Aplikasi Pengaduan Keluhan Warga</title>
    <link rel="shortcut icon" type="image/png" href="{{ secure_asset('app-aduan/assets/images/logos/favicon2.png') }}" />
    <link rel="stylesheet" href="{{ secure_asset('app-aduan/assets/css/styles.min.css') }}" />
    <link
        href="https://cdn.datatables.net/v/bs5/dt-2.0.6/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.2/datatables.min.css"
        rel="stylesheet">
</head>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="{{ route('view.main.page') }}" class="text-nowrap logo-img">
                    <img style="width:75%;" src="{{ asset('app-aduan/assets/images/logos/swamedia.png') }}" alt="" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    {{-- <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./index.html" aria-expanded="false">
                            <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                            <span class="hide-menu">Home</span>
                        </a>
                    </li> --}}
                    <li>
                        <span class="sidebar-divider lg"></span>
                    </li>
                    <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">MENU</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('view.create.page') }}" aria-expanded="false">
                            <iconify-icon icon="solar:clipboard-add-linear"></iconify-icon>
                            <span class="hide-menu">Buat Keluhan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('view.list.page') }}" aria-expanded="false">
                            <iconify-icon icon="solar:clipboard-list-linear"></iconify-icon>
                            <span class="hide-menu">List Keluhan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('view.monitoring.page') }}" aria-expanded="false">
                            <iconify-icon icon="solar:monitor-outline"></iconify-icon>
                            <span class="hide-menu">Monitoring Keluhan</span>
                        </a>
                    </li>
                    <div class="fixed-bottom px-5">
                        <p>PT. Swamedia Informatika</p>
                        <p>All Rights Reserved.</p>
                    </div>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="javascript:void(0)">
                            {{-- <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon> --}}
                            {{-- <div class="notification bg-primary rounded-circle"></div> --}}
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item dropdown">
                            <a href="#">
                                <p class="fw-bold fs-5 my-auto">Sistem Aplikasi Pengaduan Keluhan Warga</p>
                            </a>
                            {{-- <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="../assets/images/profile/user-1.jpg" alt="" width="35"
                                    height="35" class="rounded-circle">
                            </a> --}}
                            {{-- <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-mail fs-6"></i>
                                        <p class="mb-0 fs-3">My Account</p>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-list-check fs-6"></i>
                                        <p class="mb-0 fs-3">My Task</p>
                                    </a>
                                    <a href="./authentication-login.html"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div> --}}
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--  Header End -->

        <body>
            <div class="body-wrapper-inner">
