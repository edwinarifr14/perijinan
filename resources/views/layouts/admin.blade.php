<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

    <link href="{{ url('/assets/plugins/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ url('/assets/css/sb-admin.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ url('/assets/js/Chart.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>
    @yield('heads')
</head>

<body id="page-top" class="{{ requesturl() === url('/admin/login') ? 'bg-dark' : '' }}">
    @if (requesturl() !== url('/admin/login'))
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="{{ url('/admin') }}">Perijinan</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto mr-0 mr-md-3">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                    Halo, {{ session('login')['nama'] }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <!-- <a class="dropdown-item" href="{{ url('/admin/settings') }}">Settings</a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span>
                </a>
            </li>
            @if(session('login')['level'] === 1)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="admin-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-users"></i>
                    <span>Admin</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="admin-dropdown">
                    <a class="dropdown-item" href="{{ url('/admin/registeradmin') }}">Register Admin</a>
                    <a class="dropdown-item" href="{{ url('/admin/dataadmin') }}">Data Admin</a>
                </div>
            </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pelanggan-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-users"></i>
                    <span>Permohonan</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pelanggan-dropdown">
                    <a class="dropdown-item" href="{{ url('/admin/datapermohonan') }}">Data Permohonan</a>
                    @if(session('login')['level'] === 3)
                    <a class="dropdown-item" href="{{ url('/admin/tambahpermohonan') }}">Tambah Permohonan</a>
                    @endif
                </div>


            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="admin-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-table"></i>
                    <span>Produk</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="admin-dropdown">
                    <a class="dropdown-item" href="{{ url('/admin/kategori/add') }}">Tambah Kategori</a>
                    <a class="dropdown-item" href="{{ url('/admin/kemasan/add') }}">Tambah Kemasan</a>
                     <a class="dropdown-item" href="{{ url('/admin/produk/add') }}">Tambah Produk</a> 
                    <a class="dropdown-item" href="{{ url('/admin/kategori') }}">Data Kategori</a>
                    <a class="dropdown-item" href="{{ url('/admin/kemasan') }}">Data Kemasan</a>
                    <a class="dropdown-item" href="{{ url('/admin/produk') }}">Data Produk</a>
                </div>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin/laporan') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="admin-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" onclick="event.preventDefault(); alert('Belum'.toLocaleUpperCase());">
                    <i class="fa fa-table"></i>
                    <span>Pesanan</span>
                </a>
                {{-- <div class="dropdown-menu" aria-labelledby="admin-dropdown">
                    <a class="dropdown-item" href="{{ url('/admin/pesanan') }}">List Pesanan</a>
                    <a class="dropdown-item" href="{{ url('/admin/pesanan/rekap') }}">Rekap Pesanan</a>
                </div> --}}
            </li> -->
        </ul>

        <div id="content-wrapper">

            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol> -->

                @if(session('msg'))
                    <div class="alert alert-@if(session('msg')['success']){{ 'success' }}@else{{ 'danger' }}@endif">
                        {{ session('msg')['msg'] }}
                    </div>
                @endif

                @yield('content')
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © FASILKOM UNIVERSITAS JEMBER 2021</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
    @else
    @yield('content')
    @endif

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Sesi anda akan hilang ketika logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ url('/logout/admin') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    @include('templates.script')
    
    
    
    


    <script src="{{ url('/assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ url('/assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ url('/assets/js/sb-admin.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/Chart.js') }}"></script>
    @yield('scripts')
</body>
</html>
