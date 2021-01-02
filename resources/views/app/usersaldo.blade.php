  @extends('layouts.app')

  @section('title', 'Saldo')

  @section('content')
      <div class="container">
          <div class="row">
              <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="sidebar-categories">
                      <div class="head">Saldo Saya</div>
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
                          <li class="main-nav-list">
                              <a href="{{ url('/user/penjualan') }}">Penjualan Saya</a>
                          </li>
                          <li class="main-nav-list">
                              <a href="{{ url('/user/profil') }}">Profil Saya</a>
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
              <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                  <div class="login_form_inner py-4">




                      <h3>Saldo Anda Rp {{$user->saldo}}</h3>

                      @if(session('msg'))
                          <div class="alert alert-@if(session('msg')['success']){{ 'success' }}@else{{ 'danger' }}@endif">
                              {{ session('msg')['msg'] }}
                          </div>
                      @endif
                      <form class="row login_form" style="max-width: 450px" action="{{ url('/user/saldo/req') }}" method="POST" id="saldoform">
                          @csrf
                          <div class="col-md-12 form-group">
                              <input required type="number" value="" class="form-control" id="nominal" name="nominal" placeholder="Nominal Top Up" min="10000" step="5000" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nominal Top Up'">
                          </div>

                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="bank" id="BRI" value="BRI" checked>
                              <label class="form-check-label" for="exampleRadios1">
                                BRI
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="bank" id="BNI" value="BNI">
                              <label class="form-check-label" for="exampleRadios2">
                                BNI
                              </label>
                            </div>
                            <div class="form-check disabled">
                              <input class="form-check-input" type="radio" name="bank" id="BCA" value="BCA">
                              <label class="form-check-label" for="exampleRadios3">
                                BCA
                              </label>
                            </div>


                          <div class="col-md-12 form-group pb-5">
                              <button type="submit" value="submit" class="primary-btn">Top Up Sekarang</button>
                          </div>
                          <!-- <div class="col-md-12 form-group pb-5">
                          <a href="{{ url('/user/saldo/konfirmasi') }}" class="btn btn-primary">Konfirmasi Pembayaran</a>
                          </div> -->
                      </form>
                  </div>
              </div>
          </div>
      </div>
  @endsection
