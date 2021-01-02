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
                            <a href="{{ url('/user/pesanan') }}">Pesanan Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/profil') }}">Profil Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}">Batal</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Update Data Produk</div>
                    <form action="{{ url('/produkku/'.$produk->produk_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-12 ">
                                    <label for="nama">Nama Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-address-card"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="text" id="nama" name="nama" value="{{ $produk->produk_nama }}" />
                                    </div>
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-12 ">
                                    <label for="kategori">Kategori Produk</label>
                                    <div class="input-group">
                                        <select class="form-control" name="kategori" id="kategori">
                                            <option disabled selected>--Pilih Kategori Produk--</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                      <p class="text-danger">{{ $errors->first('kategori') }}</p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-12 ">
                                    <label for="kemasan">Kemasan Produk</label>
                                    <div class="input-group">
                                        <select class="form-control" name="kemasan" id="kemasan">
                                            <option disabled selected>--Pilih Kemasan Produk--</option>
                                            @foreach ($kemasan as $item)
                                                <option value="{{ $item->kemasan_id }}">{{ $item->kemasan_kode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                      <p class="text-danger">{{ $errors->first('kemasan') }}</p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-12 ">
                                    <label for="harga">Harga Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                Rp.
                                            </span>
                                        </div>
                                        <input class="form-control" type="number" id="harga" name="harga" value="{{ $produk->produk_harga }}"/>
                                    </div>
                                      <p class="text-danger">{{ $errors->first('harga') }}</p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6">
                                    <label for="stok">Stok Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                Qty
                                            </span>
                                        </div>
                                        <input min="10" class="form-control" type="number" id="stok" name="stok" value="{{ $produk->produk_stok }}"/>
                                    </div>
                                      <p class="text-danger">{{ $errors->first('stok') }}</p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-12 ">
                                    <label for="deskripsi">Deskripsi Produk (Optional)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                &nbsp;
                                            </span>
                                        </div>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $produk->produk_deskripsi }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-12 ">
                                    <label for="gambar">Gambar Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                &nbsp;
                                            </span>
                                        </div>
                                        <input accept="image/*" class="form-control" type="file" id="gambar" name="gambar" />
                                    </div>
                                    <p class="text-danger">{{ $errors->first('gambar') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                <span>Bersihkan Form</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>





@endsection


@section('scripts')
<script src=”https://code.jquery.com/jquery-3.4.1.min.js” integrity=”sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=” crossorigin=”anonymous”></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kategori').val('{{ $produk->produk_kategori }}')
        $('#kemasan').val('{{ $produk->produk_kemasan }}')
    })
</script>
@endsection
