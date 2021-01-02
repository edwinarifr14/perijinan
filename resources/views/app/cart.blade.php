@extends('layouts.app')

@section('title','Keranjang Saya')

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
                        <span>Keranjang saya</span>
                    </div>
                    <ul class="main-categories">
                        <li class="main-nav-list">
                            <a href="{{ url('/produk') }}">List Produk</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/produkku') }}">Produk Saya</a>
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
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
              <form action="{{ url('/user/alamatPembelian') }}" method="get">
                @if ($produk)

                        <div class="row">
                            @foreach ($produk as $p)
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 p-1">
                                    <div class="card">
                                        <img class="img-fluid" style="object-fit: cover" src="{{ $p->produk_gambar ? url('/uploads/images/produk/'.$p->produk_gambar) : url('/assets/img/no image2.jpg') }}"/>

                                        <div class="card-body">
                                          <!-- <div class="checkbox">
                                            <label class="checkbox" style="font-size: 1.7em">
                                              <input type="checkbox" value="{{$p->produk_id}}">
                                              <span class="cr"><i class="cr-icon fa fa-check"></i></span>Pilih Pembelian
                                            </label>
                                          </div> -->
                                            <div class="my-1">
                                                <div class="text-secondary">Nama Produk</div>
                                                <div class="text-dark">
                                                    <i class="fas fa-tags"></i>
                                                    <span>{{$p->produk_nama}}</span>
                                                </div>
                                            </div>
                                            <div class="my-1">
                                                <div class="text-secondary">Penjual</div>
                                                <div class="text-dark">
                                                    <i class="fas fa-tags"></i>
                                                    <span>{{$p->pemilik}}</span>
                                                </div>
                                            </div>
                                            <div class="my-1">
                                                <div class="text-secondary">Harga</div>
                                                <div class="text-dark">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                    <span>{{ rupiah($p->produk_harga) }}/{{ $p->kemasan_kode }}</span>
                                                </div>
                                            </div>
                                            <div class="my-1">
                                                <div class="text-secondary">Jumlah Beli</div>
                                                <div class="text-dark">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                    <span>{{ $p->keranjang_jumlah.' '.$p->kemasan_kode }} ({{ rupiah($p->keranjang_jumlah * $p->produk_harga) }})</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <!-- <form action="{{ url('/user/keranjang/'.$p->keranjang_id) }}" method="post"> -->
                                                <!-- @method('DELETE')
                                                @csrf -->
                                                <a class="btn btn-primary" href="{{ url("/produk/{$p->produk_id}") }}">Detail</a>
                                                <a href="{{ url("/user/keranjang/delete/{$p->keranjang_id}") }}" class="btn btn-outline-danger">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                    Hapus
                                                </a>

                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- <input type="hidden" name="produks[]" value="{{ $p->produk_id.'-'.$p->keranjang_jumlah }}"> -->

                            @endforeach

                                @csrf
                            <div class="container my-3">
                                <h5 class="text-right mr-2">Total: {{ $totalproduk }} Produk</h5>
                                <button type="submit" class="primary-btn" style="float: right">
                                    <i class="far fa-credit-card"></i>
                                    <span>Proses Checkout: {{ rupiah($totalharga) }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="container my-3">
                        <h5 class="text-center">Keranjang Masih Kosong</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
