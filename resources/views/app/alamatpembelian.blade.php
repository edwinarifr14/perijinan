@extends('layouts.app')

@section('title','Alamat Pengiriman')

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
                        <span>Alamat Pengiriman</span>
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
              <form action="/user/ongkir" method="post">
                @csrf
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Alamat Pengiriman
                </div>
                <div class="card-body">
                  <div class="col-md-12 form-group">
                    <label for="pembeli" class="col-form-label">Nama Pembeli:</label>
                      <input disabled type="text" value="{{ $pelanggan->pelanggan_nama }}" class="form-control" id="nama" name="nama" placeholder="Nama" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama'">
                  </div>
                  <div class="col-md-12 form-group">
                    <label for="alamat" class="col-form-label">Alamat:</label>
                      <input disabled type="text" value="{{ $pelanggan->pelanggan_alamat }} {{$pelanggan->city}} {{$pelanggan->province}}" class="form-control" id="alamat" name="alamat" placeholder="Alamat" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat'">
                  </div>
                  <div class="col-md-12 form-group">
                    <label for="alamatpengiriman" class="col-form-label">Alamat Pengiriman:</label>
                      <input required type="text" class="form-control" id="alamatpengiriman" name="alamatpengiriman" placeholder="Alamat Pengiriman" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat Pengiriman'">
                  </div>
                  <div class="col-md-12 form-inline">
                    <select class="form-control col-md-4" name="provinsi" id="provinsi">
                        <option disabled selected>--Provinsi Alamat Pengiriman--</option>
                        @foreach ($province as $pr)
                            <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                        @endforeach
                    </select>
                    <!-- </div>
                    <div class="col-md-12 form-group"> -->
                    <select class="form-control col-md-4" name="kota" id="kota">
                        <option>--Kota Alamat Pengiriman--</option>
                    </select>
                    </div>
                    <br>
                    <div class="col-md-12 form-group pb-5">
                        <button type="submit" value="submit" class="btn btn-primary">Selanjutnya</button>
                    </div>
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
					op+='<option value="0" selected disabled>--Kota Asal--</option>';
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
