<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>E-Bike Polinema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta name="author" content="Themesberg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description"
        content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
    <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="og:title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta property="og:description"
        content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="og:image"
        content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="twitter:title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta property="twitter:description"
        content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="twitter:image"
        content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/logo.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('img/logo.svg') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('img/logo.svg') }}">
    <link rel="manifest" href="{{ asset('volt/src/assets/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('volt/src/assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('volt/html&css/vendor/sweetalert2/dist/sweetalert2.min.css') }}"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Notyf -->
    <link type="text/css" href="{{ asset('volt/html&css/vendor/notyf/notyf.min.css') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('volt/html&css/css/volt.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
       
    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    @yield('css')
</head>

<body>

    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="../../index.html">
            <img class="navbar-brand-dark" src="{{ asset('img/logo.svg') }}"
                alt="Volt logo" /> <img class="navbar-brand-light"
                src="{{ asset('volt/html&css/assets/img/brand/dark.svg') }}" alt="Volt logo" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <nav id="sidebarMenu" class="sidebar d-lg-block  text-white collapse" style="background-color: #1e3a8a" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img class="avatar rounded-circle" alt="Image placeholder"
                        src="{{ asset('volt/html&css/assets/img/team/profile-picture-3.jpg') }}">
                    </div>
                    <div class="d-block">
                        <h2 class="h5 mb-3">Hi, Admin</h2>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Sign Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!--SIDEBAR NAV-->
            <ul class="nav flex-column pt-3 pt-md-0">

                <li class="nav-item">
                    <a href="#" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="{{ asset('img/logo.svg') }}" height="20"
                                width="20" alt="Volt Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">E-Bike Polinema</span>
                    </a>
                </li>

                <!--SIDEBAR MENU-->
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.index') }}">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-components">
                       
                            <span>
                                <span class="sidebar-icon">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                <span class="sidebar-text">Riwayat</span>
                            </span>
                      
                    </span> 
                 </a>
                </li>
                
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.bike') }}">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-components">
                       
                            <span>
                                <span class="sidebar-icon">
                                    <i class="far fa-list-alt"></i>
                                </span>
                                <span class="sidebar-text">E-Bike</span>
                            </span>
                      
                    </span> 
                 </a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.minimum') }}">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-components">
                       
                            <span>
                                <span class="sidebar-icon">
                                    <i class="fas fa-money-check-alt"></i>
                                </span>
                                <span class="sidebar-text">Minimum Saldo</span>
                            </span>
                        
                    </span></a>
                </li>
               
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.maps') }}">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-components">
                       
                            <span>
                                <span class="sidebar-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <span class="sidebar-text">Maps</span>
                            </span>
                       
                    </span> </a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.pengguna') }}">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-components">
                       
                            <span>
                                <span class="sidebar-icon">
                                    <i class="fas fa-user-alt"></i>
                                </span>
                                <span class="sidebar-text">Pengguna</span>
                            </span>
                    
                    </span>    </a>
                </li>
                <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
            </ul>
            <!--HEADER NAV-->

        </div>
    </nav>

    <main class="content">

        <!--HEADER NAV-->
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                        <!-- Search form -->
                        <form class="navbar-search form-inline" id="navbar-search-main">
                            <div class="input-group input-group-merge search-bar">


                            </div>
                        </form>
                        <!-- / Search form -->
                    </div>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center">

                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="media d-flex align-items-center">
                                    <img class="avatar rounded-circle" alt="Image placeholder"
                                        src="{{ asset('volt/html&css/assets/img/team/profile-picture-3.jpg') }}">
                                    <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                        <span class="mb-0 font-small fw-bold text-gray-900">Admin</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">

                                <div role="separator" class="dropdown-divider my-1"></div>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                                    <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--HEADER NAV-->



        <!--DISPLAY CONTENT-->
        <div class="row">

            @yield('content')
        </div>
        <!--DISPLAY CONTENT-->
        <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="createpointModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createpointModalLabel"><i class="bi bi-geo-alt-fill"></i>
                        Create Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create-point') }}" method="Post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill in the name" required>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-point" class="form-label">Geometry WKT</label>
                            <textarea class="form-control" id="geometry-point" name="geometry-point" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle-fill"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                        Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Polyline -->
    <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="createpolylineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createpolylineModalLabel"><i class="bi bi-slash-lg"></i>
                        Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create-polyline') }}" method="Post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill in the name" required>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-polyline" class="form-label">Geometry WKT</label>
                            <textarea class="form-control" id="geometry-polyline" name="geometry-polyline" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle-fill"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                        Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Polygon -->
    <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="createpolygonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createpolygonModalLabel"><i class="bi bi-pentagon-fill"></i>
                        Create Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create-polygon') }}" method="Post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill in the name" required>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-polygon" class="form-label">Geometry WKT</label>
                            <textarea class="form-control" id="geometry-polygon" name="geometry-polygon" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle-fill"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                        Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Point -->
    <div class="modal fade" id="editpointModal" tabindex="-1" aria-labelledby="editpointModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editpointModalLabel"><i class="bi bi-geo-alt-fill"></i> Edit
                        Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="Post" id="form-update-point">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="name-edit-point" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name-edit-point"
                                name="name-edit-point" placeholder="Fill in the name" required>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-edit-point" class="form-label">Geometry WKT</label>
                            <textarea class="form-control" id="geometry-edit-point" name="geometry-edit-point" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle-fill"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                        Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Polyline -->
    <div class="modal fade" id="editpolylineModal" tabindex="-1" aria-labelledby="editpolylineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editpolylineModalLabel"><i class="bi bi-geo-alt-fill"></i>
                        Edit Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="Post" id="form-update-polyline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="name-edit-polyline" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name-edit-polyline"
                                name="name-edit-polyline" placeholder="Fill in the name" required>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-edit-polyline" class="form-label">Geometry WKT</label>
                            <textarea class="form-control" id="geometry-edit-polyline" name="geometry-edit-polyline" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle-fill"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                        Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Polygon -->
    <div class="modal fade" id="editpolygonModal" tabindex="-1" aria-labelledby="editpolygonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editpolygonModalLabel"><i class="bi bi-geo-alt-fill"></i>
                        Edit Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="Post" id="form-update-polygon">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="name-edit-polygon" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name-edit-polygon"
                                name="name-edit-polygon" placeholder="Fill in the name" required>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-edit-polygon" class="form-label">Geometry WKT</label>
                            <textarea class="form-control" id="geometry-edit-polygon" name="geometry-edit-polygon" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle-fill"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                        Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1000; margin-bottom: 20px;">
            <div id="liveToastSuccess" class="toast align-items-center text-bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
        <script>
            var toastLive = document.getElementById('liveToastSuccess')
            var toast = new bootstrap.Toast(toastLive)

            toast.show()
        </script>
       
  @elseif (session('error')) :

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1000; margin-bottom: 20px;">
            <div id="liveToastError" class="toast align-items-center text-bg-danger border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
        <script>
            var toastLive = document.getElementById('liveToastError')
            var toast = new bootstrap.Toast(toastLive)

            toast.show()
        </script>
        @endif



        <footer class="footer bg-white rounded shadow p-5 mb-4 mt-4">
            <div class="row">
                <div class="col-12 col-md-4 col-xl-6 mb-4 mb-md-0">
                    <p class="mb-0 text-center text-lg-start">© 2024-<span class="current-year"></span> <a
                            class="text-primary fw-normal" target="_blank">E-Bike Polinema</a></p>
                </div>
            </div>
        </footer>
    </main>

    <!-- Core -->
    <script src="{{ asset('volt/html&css/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('volt/html&css/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('volt/html&css/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('volt/html&css/vendor/nouislider/dist/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('volt/html&css/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Charts -->


    <!-- Datepicker -->
    <script src="{{ asset('volt/html&css/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('volt/html&css/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Vanilla JS Datepicker -->
    <script src="{{ asset('volt/html&css/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Notyf -->
    <script src="{{ asset('volt/html&css/vendor/notyf/notyf.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('volt/html&css/vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/fontawesome.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove()
            })
        }, 3000);
    </script>
    @stack('javascript')
    <!-- Volt JS -->
    {{-- <script src="{{ asset('volt/hmtl&css/assets/js/volt.js') }}"></script> --}}


</body>

</html>
