@extends('layouts.app')

@section('title','title')

@section('heads')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="sidebar-categories">
                    <div class="head">
                        <i class="fas fa-shopping-cart"></i>
                        <span>tes</span>
                    </div>
                    <ul class="main-categories">
                        <li class="main-nav-list">
                            <a href="{{ url('/produk') }}">List Produk</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/keranjang') }}">Keranjang Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/pesanan') }}">Pesanan Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ url('/user/profil') }}">Profil Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}">Batal</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">tes</div>
                <form method="post" action="{{ action('HomeController@processShipping') }}" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <!-- text input -->
                  <div class="form-group">
                    <label>Origin</label>
                    <select id="origin" class="form-control" name="origin">
                      <option selected="selected" value="">Pilih Origin</option>
                      @foreach($city as $c)
                      <option value="{{ $c->id }}">{{ $c->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Destination</label>
                    <select id="destination" class="form-control" name="destination">
                      <option selected="selected" value="">Pilih Destination</option>
                      @foreach($city as $c)
                      <option value="{{ $c->id }}">{{ $c->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Weight</label>
                    <input type="text" name="weight" class="form-control" placeholder="Enter ...">
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>

                </form>
                </div>
        </div>
    </div>
@endsection
