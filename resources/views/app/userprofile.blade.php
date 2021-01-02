@extends('layouts.app')

@section('title', 'Profil Saya')

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
                        <li class="main-nav-list">
                            <a href="{{ url('/user/penjualan') }}">Penjualan Saya</a>
                        </li>
                        <li class="main-nav-list">
                            <a style="color: crimson" href="{{ url('/user/delete') }}">Hapus Akun</a>
                        </li>
                        <li class="main-nav-list">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}">Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                <div class="login_form_inner py-4">
                    <h3>Setting Profil</h3>
                    @if(session('msg'))
                        <div class="alert alert-@if(session('msg')['success']){{ 'success' }}@else{{ 'danger' }}@endif">
                            {{ session('msg')['msg'] }}
                        </div>
                    @endif
                    <form class="row login_form" style="max-width: 450px" action="{{ url('/user/'.$user->pelanggan_id) }}" method="POST" id="contactForm">
                        @method('PUT')
                        @csrf
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                        @endif
                        <div class="col-md-12 form-group">
                            <input required type="text" value="{{ $user->pelanggan_nama }}" class="form-control" id="nama" name="nama" placeholder="Nama" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama'">
                        </div>
                        <p class="text-danger">{{ $errors->first('nama') }}</p>
                        <div class="col-md-12 form-group">
                            <input required type="email" value="{{ $user->pelanggan_email }}" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                        </div>
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        <div class="col-md-12 form-group">
                            <input required type="number" value="{{ $user->pelanggan_kontak }}" class="form-control" id="kontak" name="kontak" placeholder="Nomor Kontak" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nomor Kontak'">
                        </div>
                        <p class="text-danger">{{ $errors->first('kontak') }}</p>
                        <div class="col-md-12 form-inline">
                          <select class="form-control col-md-6" name="provinsi" id="provinsi">
                              <option disabled selected>--Provinsi Asal--</option>
                              @foreach ($province as $p)
                                  <option value="{{ $p->id }}">{{ $p->name }}</option>
                              @endforeach
                          </select>
                          <!-- </div>
                          <div class="col-md-12 form-group"> -->
                          <select class="form-control col-md-6" name="kota" id="kota">
                              @foreach ($city as $c)
                              <option value="{{ $c->id }}">{{ $c->name }}</option>
                              @endforeach
                          </select>
                          </div>
                          <p class="text-danger">{{ $errors->first('provinsi') }}</p>
                          <p class="text-danger">{{ $errors->first('kota') }}</p>
                        <div class="col-md-12 form-group">
                            <input type="text" value="{{ $user->pelanggan_alamat }}" class="form-control" id="alamat" name="alamat" placeholder="Alamat" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat'">
                        </div>
                        <p class="text-danger">{{ $errors->first('alamat') }}</p>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ganti Password (Kosongkan jika tidak ingin mengganti)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ganti Password (Kosongkan jika tidak ingin mengganti)'">
                        </div>
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        <div class="col-md-12 form-group pb-5">
                            <button type="submit" value="submit" class="primary-btn">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
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
$(document).ready(function() {
    $('#provinsi').val('{{ $user->pelanggan_province }}')
    $('#kota').val('{{ $user->pelanggan_city }}')
})

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
