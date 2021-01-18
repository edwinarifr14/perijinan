@extends('layouts.admin')

@section('title', 'Tambah Permohonan')

@section('content')
<div class="card">
    <div class="card-header">Tambah Permohonan</div>
        <form action="{{ url('/admin/addPermohonan') }}" method="POST">
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
                            <input class="form-control" type="text" id="pemohon" name="pemohon"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('pemohon') }}</p>
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
                            <input class="form-control" type="text" id="alamat" name="alamat"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('alamat') }}</p>
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
                            <input class="form-control" type="number" id="nik" name="nik"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('nik') }}</p>
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
                        <label for="pemohon">Jenis Permohonan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-archive"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" id="jenis" name="jenis"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('jenis') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Status</label>
                        <div class="input-group">
                            <select class="form-control" name="status" id="status">
                                <option value="Diterima">Diterima</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div>
                <!-- <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Peninjauan Lapangan</label>
                        <div class="input-group">
                            <select class="form-control dynamic" name="peninjauan" id="peninjauan" data-dependent="diteruskan">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('peninjauan') }}</p>
                    </div>
                </div> -->
                <!-- <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Jenis Permohonan</label>
                        <div class="input-group">
                            <select class="form-control" name="jenis" id="jenis">
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
                            <select class="form-control dynamic" name="peninjauan" id="peninjauan" data-dependent="diteruskan">
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
                            <select class="form-control" name="status" id="status">
                                <option value="Diterima">Diterima</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Diteruskan</label>
                        <div class="input-group">
                            <select class="form-control" name="diteruskan" id="diteruskan">
                            <option value="Kabid">Kabid</option>
                            <option value="Kasi Usaha">Kasi Usaha</option>
                            <option value="Non Usaha">Non Usaha</option>
                            <option value="Aris">Aris</option>
                            <option value="Rifki">Rifki</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div> -->
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">
                    <i class="fas fa-angle-double-right"></i>
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