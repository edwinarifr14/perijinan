@extends('layouts.app')

@section('title','Pesanan Saya')

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
                        <span>Pesanan Saya</span>
                    </div>
                    <ul class="main-categories">
                        <li class="main-nav-list">
                            <a href="{{ url('/produk') }}">List Produk</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/produkku') }}">Produk Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/keranjang') }}">Keranjang Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/penjualan') }}">Penjualan Saya</a>
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
                    Pesanan Saya
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data-produkku" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Gambar Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Penjual</th>
                                    <th>Alamat Tujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach($pemesanan as $p)
                                <tr>

                                  <!-- <td>{{$p->produk_gambar}}</td> -->
                                  <td><img class="img-thumbnail mx-auto d-block" width="125" height="125" src="{{ $p->produk_gambar ? url('/uploads/images/produk/'.$p->produk_gambar) : url('/assets/img/no image2.jpg') }}"/>
                                  </td>
                                  <td>{{$p->produk_nama}}</td>
                                  <td>{{$p->pesanan_jumlah}}</td>
                                  <td>{{$p->pesanan_harga}}</td>
                                  <td>{{$p->pelanggan_nama}}</td>
                                  <td>{{$p->pesanan_tujuan}}</td>
                                  <td>{{$p->pesanan_status}}</td>

                                  <td>
                                    @if ($p->pesanan_status === 'pengiriman')
                                    <a
                                        href="{{ $p->pesanan_id }}/sukses"
                                        class="btn btn-success"
                                    >
                                        <i>Terima Barang  </i>
                                    </a>
                                    @endif
                                  </td>
                                </tr>
                                @endforeach


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
