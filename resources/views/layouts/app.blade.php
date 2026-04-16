<!DOCTYPE html>
<!--
Template Name: Stack - Stack - Bootstrap 4 Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/stack_admin
Renew Support: https://1.envato.market/stack_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<!-- Mirrored from demos.pixinvent.com/stack-html-admin-template/html/ltr/vertical-modern-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Sep 2024 11:39:54 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Laudzai</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon"
        href="https://demos.pixinvent.com/stack-html-admin-template/app-assets/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/card-statistics.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/vertical-timeline.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">


    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-lg-none mr-auto">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                            <i class="feather icon-menu font-large-1"></i>
                        </a>
                    </li>

                    <li class="nav-item mr-auto">
                        <a class="navbar-brand" href="#">
                            <img class="brand-logo" alt="logo"
                                src="../../../app-assets/images/logo/stack-logo-light.png">


                            <h2 class="brand-text" style="font-size: 16px;">
                                {{ $appConfig->name ?? 'Stack' }}
                            </h2>
                        </a>
                    </li>

                    <li class="nav-item d-lg-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">

                    <ul class="nav navbar-nav mr-auto float-left"></ul>

                    <ul class="nav navbar-nav float-right">

                        @php
                            $credit = auth()->user()->credit_score ?? 0;

                            $color = 'danger';
                            if ($credit >= 50) {
                                $color = 'success';
                            } elseif ($credit >= 20) {
                                $color = 'warning';
                            }
                        @endphp

                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">

                                <div class="avatar avatar-online">
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-1.png">
                                    <i></i>
                                </div>

                                <span class="user-name">
                                    {{ auth()->user()->name }}
                                    ({{ ucfirst(auth()->user()->role) }})

                                    @if (strtolower(auth()->user()->role) === 'peminjam')
                                        <span class="badge badge-{{ $color }} ml-1">
                                            <i class="fa fa-star"></i> {{ $credit }}
                                        </span>
                                    @endif
                                </span>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">
                                    <i class="feather icon-user"></i> Edit Profile
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="feather icon-power"></i> Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">

            @php
                $role = strtolower(auth()->user()->role);
            @endphp

            <ul class="navigation navigation-main">

                {{-- DASHBOARD (SEMUA ROLE) --}}
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-home"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                {{-- ================= ADMIN ================= --}}
                @if ($role === 'admin')
                    <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}">
                            <i class="fa fa-th-large"></i>
                            <span class="menu-title">Category</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('tools.*') ? 'active' : '' }}">
                        <a href="{{ route('tools.index') }}">
                            <i class="fa fa-wrench"></i>
                            <span class="menu-title">Tools</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('tool-units.*') ? 'active' : '' }}">
                        <a href="{{ route('tool-units.index') }}">
                            <i class="fa fa-cube"></i>
                            <span class="menu-title">Unit Tools</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('logs.*') ? 'active' : '' }}">
                        <a href="{{ route('logs.index') }}">
                            <i class="fa fa-history"></i>
                            <span class="menu-title">Log Aktivitas</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('appeals.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.appeals.index') }}">
                            <i class="fa fa-gavel"></i>
                            <span class="menu-title">Pengajuan Banding</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('config.*') ? 'active' : '' }}">
                        <a href="{{ route('config.index') }}">
                            <i class="fa fa-cog"></i>
                            <span class="menu-title">Konfigurasi</span>
                        </a>
                    </li>
                @endif


                {{-- ================= PEMINJAM ================= --}}
                @if ($role === 'peminjam')
                    <li class="{{ request()->routeIs('peminjam.tools.*') ? 'active' : '' }}">
                        <a href="{{ route('peminjam.tools.index') }}">
                            <i class="fa fa-box"></i>
                            <span class="menu-title">Daftar Alat</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('peminjam.peminjaman.*') ? 'active' : '' }}">
                        <a href="{{ route('peminjam.peminjaman.index') }}">
                            <i class="fa fa-exchange-alt"></i>
                            <span class="menu-title">Peminjaman</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('peminjam.pengembalian.*') ? 'active' : '' }}">
                        <a href="{{ route('peminjam.pengembalian.index') }}">
                            <i class="fa fa-undo"></i>
                            <span class="menu-title">Pengembalian</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('peminjam.appeals.*') ? 'active' : '' }}">
                        <a href="{{ route('peminjam.appeals.index') }}">
                            <i class="fa fa-gavel"></i>
                            <span class="menu-title">Pengajuan Banding</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('peminjam.history.*') ? 'active' : '' }}">
                        <a href="{{ route('peminjam.history.index') }}">
                            <i class="fa fa-history"></i>
                            <span class="menu-title">History</span>
                        </a>
                    </li>
                @endif

                @if ($role === 'petugas')
                    <li class="{{ request()->routeIs('petugas.peminjaman.*') ? 'active' : '' }}">
                        <a href="{{ route('petugas.peminjaman.index') }}">
                            <i class="fa fa-list"></i>
                            <span>Peminjaman</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('settlements.*') ? 'active' : '' }}">
                        <a href="{{ route('settlements.index') }}">
                            <i class="fa fa-money-bill"></i>
                            <span>Settlement</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <a href="{{ route('petugas.reports.index') }}">
                            <i class="fa fa-print"></i>
                            <span>Laporan</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('petugas.peminjaman.history') ? 'active' : '' }}">
                        <a href="{{ route('petugas.peminjaman.history') }}">
                            <i class="fa fa-history"></i>
                            <span>History</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <div class="app-content content">
        <div class="content-wrapper">

            <!-- spacing biar ga ketiban navbar -->
            <div class="content-header row"></div>

            <div class="content-body">

                {{-- Alert --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-2">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-2">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- ISI HALAMAN --}}
                @yield('content')

            </div>
        </div>
    </div>

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/charts/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.min.js"></script>
    <script src="../../../app-assets/js/core/app.min.js"></script>
    <script src="../../../app-assets/js/scripts/customizer.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/cards/card-statistics.min.js"></script>
    <!-- END: Page JS-->

    <script>
        @if (session('error'))
            alert({{ json_encode(session('error')) }});
        @endif
    </script>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>


</body>
<!-- END: Body-->

<!-- Mirrored from demos.pixinvent.com/stack-html-admin-template/html/ltr/vertical-modern-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Sep 2024 11:40:55 GMT -->

</html>
