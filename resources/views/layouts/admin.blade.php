<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Carga Académica</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ secure_asset('dist/css/adminlte.min.css')}}">

    <!--Iconos de Bootstraps-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="{{ secure_asset('plugins/jquery/jquery.min.js') }}"></script>

    <!--DATATABLE-->
    <link rel="stylesheet" href={{ secure_asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ secure_asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ secure_asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{  url('/admin')}}" class="nav-link">Sistema de carga académica</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{  url('/admin')}}" class="brand-link">
                <img src="{{ url('dist/img/images.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ESEN</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src={{ url('dist/img/avatar3.png') }} class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-person-badge-fill"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href={{ url('admin/usuarios/create') }} class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creacion de Usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ url('admin/usuarios') }} class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!---secretariaaas-->
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi-person-badge-fill"></i>
                                <p>
                                    Docentes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href={{ url('admin/docentes/create') }} class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creacion de Docentes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ url('admin/docentes') }} class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Docentes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-----CURSOS-->

                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi-person-badge-fill"></i>
                                <p>
                                    Cursos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href={{ url('admin/cursos/create') }} class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creacion de Cursos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ url('admin/cursos') }} class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Cursos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-----CARGA ACADEMICA-->

                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi-person-badge-fill"></i>
                                <p>
                                    Carga Académica
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href={{ url('admin/cargas/create') }} class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asignar Carga académica</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ url('admin/cargas') }} class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Carga académica</p>
                                    </a>
                                </li>
                            </ul>
                        </li>




                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link w-100 text-left" style="background-color:#a9200e">
                                    <i class="nav-icon bi bi-door-closed-fill"></i>
                                    <p class="d-inline">Cerrar Sesión</p>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <div class="content-wrapper">
            <div class="container">
                <br>
                @yield('content')
            </div>
        </div>

        @if((($message = Session::get('mensaje')) && ($icono = Session::get('icono'))))
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "{{$icono}}",
                    title: "{{$message}}",
                    showConfirmButton: false,
                    timer: 4500
                });
            </script>
        @endif


        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->

            <!-- Default to the left -->
            <strong>Copyright &copy; 2025 - FrancisMj21 </strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- Bootstrap 4 -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!----->
    <script src={{url('plugins/datatables/jquery.dataTables.min.js')}}></script>
    <script src={{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
    <script src={{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}></script>
    <script src={{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}></script>
    <script src={{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}></script>
    <script src={{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}></script>
    <script src={{url('plugins/jszip/jszip.min.js')}}></script>
    <script src={{url('plugins/pdfmake/pdfmake.min.js')}}></script>
    <script src={{url('plugins/pdfmake/vfs_fonts.js')}}></script>
    <script src={{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}></script>
    <script src={{url('plugins/datatables-buttons/js/buttons.print.min.js')}}></script>
    <script src={{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}></script>
    <!-- AdminLTE App -->
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
</body>

</html>