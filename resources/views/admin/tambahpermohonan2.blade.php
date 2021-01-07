@extends('layouts.admin')

@section('title', 'Tambah Permohonan')

@section('content')
<div class="card">
    <div class="card-header">Tambah Permohonan</div>
        <form action="{{ url('/admin/addPermohonan2') }}" method="POST">
            @csrf
            <div class="card-body">
                
                            <input hidden value="{{$data1}}" class="form-control" type="text" id="pemohon" name="pemohon"/>
                            <input hidden value="{{$data2}}" class="form-control" type="text" id="alamat" name="alamat"/>
                            <input hidden value="{{$data3}}" class="form-control" type="number" id="nik" name="nik"/>
                            <input hidden value="{{$data4}}" class="form-control" type="number" id="kontak" name="kontak"/>
                            <input hidden value="{{$data5}}" class="form-control" type="text" id="jenis" name="jenis"/>
                            <input hidden value="{{$data6}}" class="form-control" type="text" id="peninjauan" name="peninjauan"/>

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
                @if($data6 === "Ya")
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Diteruskan</label>
                        <div class="input-group">
                            <select class="form-control" name="diteruskan1" id="diteruskan1">
                            <option value="-">-</option>
                            <option value="Kabid">Kabid</option>
                            <option value="Kasi Usaha">Kasi Usaha</option>
                            <option value="Non Usaha">Non Usaha</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div>
                @else
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Diteruskan</label>
                        <div class="input-group">
                            <select class="form-control" name="diteruskan2" id="diteruskan2">
                            <option value="-">-</option>
                            <option value="Aris">Aris</option>
                            <option value="Rifki">Rifki</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('level') }}</p>
                    </div>
                </div>
                @endif
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