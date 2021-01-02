@extends('layouts.app')

@section('title','Produk Saya')

@section('heads')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="sidebar-categories">
                    <div class="head">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Produk saya</span>
                    </div>
                    <ul class="main-categories">
                        <li class="main-nav-list">
                            <a href="{{ url('/produk') }}">List Produk</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/keranjang') }}">Keranjang Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/pesanan') }}">Pesanan Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/profil') }}">Profil Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}">Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card mb-3 col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Data Produk
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data-produkku" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Gambar Produk</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Kemasan</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Pemilik</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach($produk as $p)
                                <tr>
                                  <td>{{$p->produk_id}}</td>
                                  <!-- <td>{{$p->produk_gambar}}</td> -->
                                  <td><img class="img-thumbnail mx-auto d-block" width="125" height="125" src="{{ $p->produk_gambar ? url('/uploads/images/produk/'.$p->produk_gambar) : url('/assets/img/no image2.jpg') }}"/>
                                  </td>
                                  <td>{{$p->produk_nama}}</td>
                                  <td>{{$p->produk_kategori}}</td>
                                  <td>{{$p->produk_kemasan}}</td>
                                  <td>{{$p->produk_harga}}</td>
                                  <td>{{$p->produk_stok}}</td>
                                  <td>{{$p->produk_deskripsi}}</td>
                                  <td>{{$p->pemilik}}</td>
                                  <td>
                                    <a
                                        href="{{ $p->produk_id }}/edit"
                                        class="btn btn-sm btn-primary"
                                    >
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form style="display: inline-block" id="form-delete" class="mr-auto" action="/user/produkku/{{$p->produk_id}}" method="POST">
                                    @method('delete')
                                    @csrf

                                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda yakin ingin menghapus data ini ?\') ? $(\'#form-delete\').submit() : false">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                  </td>
                                </tr>
                                @endforeach
                                <a href="{{ url('/user/produkku/tambah') }}" class="btn btn-secondary">Upload Produk</a>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted"></div>
            </div>

        </div>
    </div>
@endsection
