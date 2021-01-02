  @extends('layouts.app')

  @section('title', 'Saldo')

  @section('content')
      <div class="container">
          <div class="row">
              <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="sidebar-categories">
                      <div class="head">Profil Saya</div>
                      <ul class="main-categories">
                          <li class="main-nav-list">
                              <a href="{{ url('/produk') }}">List Produk</a>
                          </li>
                          <li class="main-nav-list">
                              <a href="{{ url('/user/produkku') }}">Produk Saya</a>
                          </li>
                          <li class="main-nav-list">
                              <a href="{{ url('/user/keranjang') }}">Keranjang Saya</a>
                          </li>
                          <li class="main-nav-list">
                              <a href="{{ url('/user/pesanan') }}">Pesanan Saya</a>
                          </li>
                          <!-- <li class="main-nav-list">
                              <a style="color: crimson" href="{{ url('/user/delete') }}">Hapus Akun</a>
                          </li> -->
                          <li class="main-nav-list">
                              <a href="{{ redirect()->getUrlGenerator()->previous() }}">Kembali</a>
                          </li>
                      </ul>
                  </div>
              </div>



              <div class="card">
                  <div class="card-header">Konfirmasi Top Up</div>

                      <form action="{{ url('/user/saldo/'.$transaksi->transaksi_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        @if ($transaksi->transaksi_bayar == "Tidak Valid")

                        <div class="alert alert-danger alert-block">

	                         <button type="button" class="close" data-dismiss="alert">×</button>

                           <strong>Konfirmasi Anda Sebelumnya Dianggap Tidak <br>Valid oleh Admin, Lakukan Konfirmasi Ulang</strong>

                         </div>

                         @endif



                          <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-12">
                                    <label for="saldo">Saldo Saya</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                Rp.
                                            </span>
                                        </div>
                                        <input min="0" step="2500" value="{{$user->saldo}}" required class="form-control" type="number" id="harga" name="harga" disabled/>
                                    </div>
                                </div>
                            </div>

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
                                  <span>Konfirmasi</span>
                              </button>

                          </div>
                      </form>
                  </div>

          </div>
      </div>
  @endsection
