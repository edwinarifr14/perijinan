@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="card">
    <div class="card-header">Setting Profil</div>
        <form action="{{ url('/admin/'.session('login')['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input value="{{ $currentdata->admin_username }}" class="form-control" type="text" id="username" name="username"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('username') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="nama">Nama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-user-circle"></i>
                                </span>
                            </div>
                            <input value="{{ $currentdata->admin_nama }}" class="form-control" type="text" id="nama" name="nama"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('nama') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="password">Ganti Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input class="form-control" type="password" id="password" name="password"/>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="kontak">Kontak (Optional)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-phone"></i>
                                </span>
                            </div>
                            <input value="{{ $currentdata->admin_kontak }}" class="form-control" type="text" id="kontak" name="kontak"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    <span>Simpan Perubahan</span>
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-danger">
                    <i class="fas fa-back"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
