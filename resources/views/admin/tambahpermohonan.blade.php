@extends('layouts.admin')

@section('title', 'Tambah Permohonan')

@section('content')
<div class="card">
    <div class="card-header">Tambah Permohonan</div>
        <form action="{{ url('/admin') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="pemohon">Nama Pemohon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="username" name="username"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('username') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="alamat">Alamat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="nama" name="nama"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('nama') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="NIK">NIK</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input class="form-control" type="number" id="kontak" name="kontak"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('kontak') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="kontak">No HP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-phone"></i>
                                </span>
                            </div>
                            <input class="form-control" type="number" id="kontak" name="kontak"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('kontak') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Jenis Permohonan</label>
                        <div class="input-group">
                            <select class="form-control" name="level" id="level">
                                <option value="SIP">SIP</option>
                                <option value="SIPP">SIPP</option>
                                <option value="SIPB">SIPB</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Peninjauan Lapangan</label>
                        <div class="input-group">
                            <select class="form-control" name="level" id="level">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Status</label>
                        <div class="input-group">
                            <select class="form-control" name="level" id="level">
                                <option value="Diterima">Diterima</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    <span>Simpan</span>
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
