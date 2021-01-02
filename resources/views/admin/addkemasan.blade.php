@extends('layouts.admin')

@section('title', 'Tambah Kemasan Produk')

@section('content')
<div class="card">
    <div class="card-header">Tambah Kemasan Produk</div>
        <form action="{{ url('/kemasan') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="kode">Kode Kemasan Produk</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-quote-right"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="kode" name="kode" />
                        </div>
                        <p class="text-danger">{{ $errors->first('kode') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="kode">Satuan Dalam Gram</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-quote-right"></i>
                                </span>
                            </div>
                            <input class="form-control" type="number" id="satuan" name="satuan" />
                        </div>
                        <p class="text-danger">{{ $errors->first('satuan') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="deskripsi">Deskripsi Kemasan Produk (Optional)</label>
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
                    <span>Tambah Kemasan Produk</span>
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
