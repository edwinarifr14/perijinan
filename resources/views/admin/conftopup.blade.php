@extends('layouts.admin')

@section('title', 'Data Top Up')

@section('content')
<div class="card">
    <div class="card-header">Konfirmasi Top Up</div>
        <form action="{{ url('/admin/conf/'.$transaksi->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12">
                        <label for="nama">Kode</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-address-card"></i>
                                </span>
                            </div>
                            <input required class="form-control" type="text" id="kode" name="kode" value="{{$transaksi->transaksi_id}}" disabled/>
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12">
                        <label for="harga">Nominal Top Up</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    Rp.
                                </span>
                            </div>
                            <input min="0" step="2500" value="{{$transaksi->transaksi_nominal}}" required class="form-control" type="number" id="harga" name="harga" disabled/>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12">
                        <label for="gambar">Gambar</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <!-- <span class="input-group-text bg-primary text-white">
                                    &nbsp;
                                </span>
                            </div> -->
                            <img class="img-fluid" src="{{ $transaksi->gambar ? url('/uploads/images/bukti/'.$transaksi->gambar) : url('/assets/img/no image2.jpg') }}"/>



                            <!-- <img src="{{ url('/assets/img/hasiltani.jpg') }}" alt="Logo Taniku"></a> -->
                            <!-- <input required accept="image/*" class="form-control" type="file" id="gambar" name="gambar" /> -->
                        </div>
                        <p class="text-danger">{{ $errors->first('gambar') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">

              @if(is_null($transaksi->gambar) OR $transaksi->transaksi_bayar === "Tidak Valid")
              <a href="/admin/datatopup" type="button" class="btn btn-danger">Pelanggan Belum Melakukan Konfirmasi</a>
              @elseif($transaksi->transaksi_bayar === "Sudah Dibayar")
              <a href="/admin/datatopup" type="button" class="btn btn-success">Konfirmasi Sudah Dilakukan</a>
              @else

                <button type="submit" name="konfirmasi" value="konfirmasi" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    <span>Konfirmasi</span>
                </button>
                <button type="submit" name="tolak" value="tolak" class="btn btn-secondary">
                    <i class="fas fa-close"></i>
                    <span>Tidak Valid</span>
                </button>
                <!-- <a href="/admin/datatopup" type="button" class="btn btn-secondary"><i class="fa fa-close"></i><span>Tidak Valid</span></a> -->


                @endif
            </div>
        </form>
    </div>

@endsection
