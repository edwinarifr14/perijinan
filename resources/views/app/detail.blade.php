@extends('layouts.app')

@section('title', $produk->produk_nama)

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="sidebar-categories">
                    <div class="head">Detail produk</div>
                    <ul class="main-categories">
                        <li class="main-nav-list">
                            <a href="{{ url('/produk') }}">List Produk</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}">Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                @if ($produk)
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 pr-0">
                            <img class="img-fluid" src="{{ $produk->produk_gambar ? url('/uploads/images/produk/'.$produk->produk_gambar) : url('/assets/img/no image2.jpg') }}"/>
                        </div>
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 pl-0">
                            <div class="card">
                                <div class="card-header bg-primary text-white" style="background-color: #828BB3 !important">{{ $produk->produk_nama }}</div>
                                <div class="card-body">
                                    <div class="my-1">
                                        <div class="text-secondary">Harga produk</div>
                                        <div class="text-dark">
                                            <i class="fas fa-tags"></i>
                                            <span>{{ rupiah($produk->produk_harga) }}/{{ $produk->kemasan->kemasan_kode }}</span>
                                        </div>
                                    </div>
                                    <div class="my-1">
                                        <div class="text-secondary">Kategori Produk</div>
                                        <div class="text-dark">
                                            <i class="fas fa-info"></i>
                                            <span>{{ $produk->kategori->kategori_nama }}</span>
                                        </div>
                                    </div>
                                    <div class="my-1">
                                        <div class="text-secondary">Deskripsi produk</div>
                                        <div class="text-dark">
                                            <i class="fas fa-info"></i>
                                            <span>{{ $produk->produk_deskripsi }}</span>
                                        </div>
                                    </div>
                                    <div class="my-1">
                                        <div class="text-secondary">Penjual produk</div>
                                        <div class="text-dark">
                                            <i class="fas fa-info"></i>
                                            <span>{{ $user->pelanggan_nama }}</span>
                                        </div>
                                    </div>
                                    <div class="my-1">
                                        <div class="text-secondary">Daerah</div>
                                        <div class="text-dark">
                                            <i class="fas fa-info"></i>
                                            <span>{{ $city->name }}</span>
                                        </div>
                                    </div>
                                    <div class="my-1">
                                        <div class="text-secondary">Stok Produk</div>
                                        <div class="text-dark">
                                            <i class="fas fa-cubes"></i>
                                            <span>{{ $produk->produk_stok }} {{ $produk->kemasan->kemasan_kode }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @if (isset(session('login')['pelanggan']))
                                        @if ($produk->produk_stok !== 0)
                                            <form action="{{ url("/user/keranjang/{$produk->produk_id}") }}" method="post">
                                                @csrf
                                                <input type="hidden" name="keranjang_jumlah" value="10">
                                                <button type="submit" class="primary-btn" style="float: right">
                                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                                    <span>Masukkan Ke Keranjang</span>
                                                </button>
                                            </form>
                                        @else
                                            <h4 style="color: crimson">Stok Produk habis !</h4>
                                        @endif
                                    @else
                                        <h4 style="color: crimson">Anda Harus login terlebih dahulu sebelum memasukkan produk ke keranjang</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        Produk tidak ditemukan
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
