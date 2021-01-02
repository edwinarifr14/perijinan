<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.head')
    <title>@yield('title') | Taniku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/plugins/owlcarousel/assets/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ url('/assets/plugins/niceselect/nice-select.css') }}">
	<link rel="stylesheet" href="{{ url('/assets/plugins/nouislider/nouislider.min.css') }}">
	<link rel="stylesheet" href="{{ url('/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/agency.min.css') }}">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <style>
        section { padding: 0 }
    </style>
    @yield('heads')
</head>
<body>
    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ url('/') }}"><img src="{{ url('/assets/img/taniku3.jpg') }}" alt="Logo Taniku"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/produk') }}">Produk</a></li>
                            @unless (isset(session('login')['pelanggan']))
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false">Akun</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                                    </ul>
                                </li>
                            @endunless
                            <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Kontak Kami</a></li>
                            @if (isset(session('login')['pelanggan']))
                                <li class="nav-item">
                                    <a href="{{ url('/user/keranjang') }}" class="nav-link">
                                        <span class="ti-bag"></span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                        <span class="ti-user"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{ url('/user/saldo') }}">Saldo</a>
                                        <a class="dropdown-item" href="{{ url('/user/profil') }}">Profil Saya</a>
                                        <a class="dropdown-item" href="{{ url('/user/pesanan') }}">Pesanan Saya</a>
                                        <a class="dropdown-item" href="{{ url('/user/penjualan') }}">Penjualan Saya</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between" method="GET" action="{{ url('/produk') }}">
                    <input type="text" name="search-key" class="form-control" id="search_input" placeholder="Cari Produk ...">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>@yield('title')</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <div style="margin: 20px; 0">
        @yield('content')
    </div>

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
                    <a class="btn btn-primary" href="{{ url('/logout/user') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    @if (isset(session('login')['pelanggan']))
        <div class="modal fade" id="cart-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tentukan Stok</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="add-cart" method="POST" action="#">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="cart-stock" class="form-control" type="number" name="keranjang_jumlah" value="1" min="10" max="1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Tambahkan ke Keranjang</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if (session('msg'))
        <!-- Message Modal-->
        <div class="modal fade" id="message-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Message</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-@if(session('msg')['success']){{ 'success' }}@else{{ 'danger' }}@endif">
                            {{ session('msg')['msg'] }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6"></div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Tentang Kami</h6>
                        <p>
                            Taniku Jember, Jawa Timur
                        </p>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Ikuti Kami</h6>
                        <p>Di sosial media anda!</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="ti-email"></i></a>
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"><i class="ti-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6"></div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>&nbsp;<b>Taniku</b> All rights reserved.
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->
    @include('templates.script')
    <script src=”https://code.jquery.com/jquery-3.4.1.min.js” integrity=”sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=” crossorigin=”anonymous”></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ url('/assets/js/jquery.sticky.js') }}"></script>
	<script src="{{ url('/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('/assets/plugins/niceselect/jquery.nice-select.min.js') }}"></script>
	<script src="{{ url('/assets/plugins/nouislider/nouislider.min.js') }}"></script>
	<script src="{{ url('/assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
	<script src="{{ url('/assets/js/main.js') }}"></script>
    <script src="{{ url('/assets/js/agency.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#message-modal').modal('show');
        });
    </script>
    @yield('scripts')
</body>
</html>
