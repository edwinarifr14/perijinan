@extends('layouts.admin')

@section('title', 'Tambah Kategori Produk')

@section('content')
<div class="card">
    <div class="card-header">Tambah Kategori Produk</div>
        <form action="{{ url('/kategori') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="nama">Nama Kategori</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-quote-right"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="nama" name="nama" />
                        </div>
                        <p class="text-danger">{{ $errors->first('nama') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="deskripsi">Deskripsi Kategori (Optional)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    &nbsp;
                                </span>
                            </div>
                            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    <span>Tambah Kategori Produk</span>
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    <span>Bersihkan Form</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
