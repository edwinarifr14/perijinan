@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="sidebar-categories">
                    <div class="head">Hapus Akun</div>
                    <ul class="main-categories">
                        <li class="main-nav-list">
                            <a href="{{ url('/user/profil') }}">Profil Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}">Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                <div class="login_form_inner py-4">
                    <h3>Anda Yakin ini menghapus akun ini ?</h3>
                    <div class="row login_form">
                        <div class="col-12">
                            <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-lg btn-block">Hapus Akun Saya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin ini menghapus akun ini ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Semua data tidak bisa dikembalikan dan anda akan otomatis ter-logout setelah menghapus akun.</div>
                <div class="modal-footer">
                    <form action="{{ url('/user/'.session('login')['id']) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Hapus Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
