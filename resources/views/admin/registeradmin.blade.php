@extends('layouts.admin')

@section('title', 'Register Admin')

@section('content')
<div class="card">
    <div class="card-header">Register Admin</div>
        <form action="{{ url('/admin') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="username">Masukkan Username Admin</label>
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
                        <label for="nama">Nama Admin</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-user-circle"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="nama" name="nama"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('nama') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="password">Password Admin</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input class="form-control" type="password" id="password" name="password"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Level Admin</label>
                        <div class="input-group">
                            <select class="form-control" name="level" id="level">
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="kontak">Kontak Admin (Optional)</label>
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
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    <span>Register</span>
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
