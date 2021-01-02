@extends('layouts.app')

@section('title','aw')

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
              <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">

                        </div>
                        <div class="box-body">
                          <table class="table table-striped">
                            <thead>
                            <tr>
                              <th>Nama Layanan</th>
                              <th>Tarif</th>
                              <th>ETD (Estimates Days)</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php for($i=0; $i<count($array_result[0]["rajaongkir"]["results"][0]["costs"]); $i++){ ?>
                                <tr>
                                  <td><?php echo $array_result[0]["rajaongkir"]["results"][0]["costs"][$i]["service"] ?> </td>
                                  <td><?php echo $array_result[0]["rajaongkir"]["results"][0]["costs"][$i]["cost"][0]["value"] ?></td>
                                  <td><?php echo $array_result[0]["rajaongkir"]["results"][0]["costs"][$i]["cost"][0]["etd"] ?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                            <tfoot>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
        </div>
    </div>
@endsection
