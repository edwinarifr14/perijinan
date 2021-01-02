@extends('layouts.app')

@section('title','Pemesanan')

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
                        <span>Pemesanan</span>
                    </div>
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
                            <a href="{{ url('/user/profil') }}">Profil Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}">Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card mb-3 col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
              <form action="/user/ongkir/simpan" method="post">
                @csrf
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Pemesanan
                </div>
                <div class="card-body">
                  <?php $k = 0; ?>
                  @foreach($alamatpenjual as $ap)
                  <input hidden type="text" id="alamatpenjual[]" name="alamatpenjual[]" value="{{$ap->pelanggan_alamat}} {{$ap->city}}  {{$ap->province}}">
                  <?php $k = $k+1; ?>
                  @endforeach
                  <?php $e = 0; ?>
                  @foreach($produk as $pr)

                  <input hidden type="text" id="idbarang[]" name="idbarang[]" value="{{$pr->produk_id}}">
                  <input hidden type="text" id="hargabarang[]" name="hargabarang[]" value="{{($pr->keranjang_jumlah * $pr->produk_harga) }}">
                  <input hidden type="text" id="penjual[]" name="penjual[]" value="{{$pr->pemilik}}">
                  <input hidden type="text" id="jumlahbarang[]" name="jumlahbarang[]" value="{{$pr->keranjang_jumlah}}">



                  <?php $e = $e+1; ?>
                  @endforeach
                  <input hidden type="text" class="tot" id="tot" name="tot">
                  <input hidden type="text" id="alamatpengiriman" name="alamatpengiriman" value="{{$alamat}} {{$kota1->name}} {{$provinsi1->name}}">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data-pembelian" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Pengiriman</th>
                                </tr>
                                <?php
                                   $i = 0;
                                ?>


                                @foreach($produk as $p)



                                <tr>
                                  <td>{{($i + 1)}}</td>
                                  <td><img class="img-thumbnail mx-auto d-block" width="70" height="70" src="{{ $p->produk_gambar ? url('/uploads/images/produk/'.$p->produk_gambar) : url('/assets/img/no image2.jpg') }}"/></td>
                                  <td>{{$p->produk_nama}}</td>
                                  <td>{{$p->keranjang_jumlah}} {{$p->kemasan_kode}}</td>
                                  <td>{{ rupiah($p->keranjang_jumlah * $p->produk_harga) }}</td>
                                  <td>
                                    <select class="form-control col-md-12 tes" onchange="getOption()" name="ongkir[]" id="ongkir[]">

                                        <?php if(isset($jne[$i]["rajaongkir"]["results"][0]["costs"])) { ?>
                                        <?php for($a=0; $a<count($jne[$i]["rajaongkir"]["results"][0]["costs"]); $a++){ ?>
                                            <option value="<?php echo $jne[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["value"] ?>">
<?php echo $jne[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["value"] ?> JNE <?php echo $jne[$i]["rajaongkir"]["results"][0]["costs"][$a]["service"] ?> <?php echo $jne[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["etd"] ?> Hari
                                                </option>
                                          <?php } } ?>
                                          <?php if(isset($pos[$i]["rajaongkir"]["results"][0]["costs"])) { ?>
                                          <?php for($a=0; $a<count($pos[$i]["rajaongkir"]["results"][0]["costs"]); $a++){ ?>
                                              <option value="<?php echo $pos[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["value"] ?>">
  <?php echo $pos[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["value"] ?> POS <?php echo $pos[$i]["rajaongkir"]["results"][0]["costs"][$a]["service"] ?> <?php echo $pos[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["etd"] ?> Hari
                                                  </option>
                                            <?php } } ?>
                                            <?php if(isset($tiki[$i]["rajaongkir"]["results"][0]["costs"])) { ?>
                                            <?php for($a=0; $a<count($tiki[$i]["rajaongkir"]["results"][0]["costs"]); $a++){ ?>
                                                <option value="<?php echo $tiki[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["value"] ?>">
    <?php echo $tiki[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["value"] ?> TIKI <?php echo $tiki[$i]["rajaongkir"]["results"][0]["costs"][$a]["service"] ?> <?php echo $tiki[$i]["rajaongkir"]["results"][0]["costs"][$a]["cost"][0]["etd"] ?> Hari
                                                    </option>
                                              <?php } } ?>
                                    </select>
                                  </td>
                                </tr>
                                <?php
                                   $i = $i+1;
                                ?>
                                @endforeach

                            </thead>
                            <tfoot>
                              <tr>
                                <th colspan="4">Total Harga</td>
                                <th colspan="2" name="total" id="total" class="total"></td>
                              </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="btn btn-primary">Bayar</button>
                    </div>
                </div>
                <div class="card-footer small text-muted"></div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script src=”https://code.jquery.com/jquery-3.4.1.min.js” integrity=”sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=” crossorigin=”anonymous”></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">


function getOption() {
  var sum = <?php echo $total;?>;
  $('.tes').each(function(){
    sum += parseFloat(this.value);
  })
  document.querySelector('.total').textContent = sum;
  $("#tot").val(sum);
    }
    window.onload = getOption;

	$(document).ready(function(){

		$(document).on('change','#provinsi',function(){
			// console.log("hmm its change");

			var p_id=$(this).val();
			// console.log(cat_id);
			var div=$(this).parent();

			var op=" ";

			$.ajax({
				type:'get',
				url:'{!!URL::to('cityprofil')!!}',
				data:{'id':p_id},
				success:function(data){
					//console.log('success');

					//console.log(data);

					//console.log(data.length);
					op+='<option value="0" selected disabled>--Kota Alamat Pengiriman--</option>';
					for(var i=0;i<data.length;i++){
					op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
				   }

				   div.find('#kota').html(" ");
				   div.find('#kota').append(op);
				},
				error:function(){

				}
			});
		});
	});
</script>
@endsection
