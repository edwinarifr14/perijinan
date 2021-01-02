@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="login_box_area section_gap" style="padding: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="{{ url('/assets/img/hasiltani.jpg') }}" alt="">
                    <div class="hover">
                        <h4>Sudah punya akun?</h4>
                        <p>Silahkan login disini</p>
                        <a class="primary-btn" href="{{ url('/login') }}">Login</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner py-2">
                    <h3>Buat Akun</h3>
                    @if(session('msg'))
                        <div class="alert alert-@if(session('msg')['success']){{ 'success' }}@else{{ 'danger' }}@endif">
                            {{ session('msg')['msg'] }}
                        </div>
                    @endif
                    <form class="row login_form" action="{{ url('/user/register') }}" method="POST" id="contactForm">
                        @csrf
                        <!-- @if (count($errors) > 0)
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                        @endif -->
                        <div class="col-md-12 form-group">
                            <input value="{{ old('nama') }}" type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anda" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Anda'">

                        </div>
                        <p class="text-danger">{{ $errors->first('nama') }}</p>
                        <div class="col-md-12 form-group">
                            <input value="{{ old('email') }}" type="text" class="form-control" id="email" name="email" placeholder="Email Anda" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Anda'">
                        </div>
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        <div class="col-md-12 form-group">
                            <input type="password" value="{{ old('password') }}" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        <div class="col-md-12 form-group">
                            <input type="number" class="form-control" value="{{ old('kontak') }}" id="kontak" name="kontak" placeholder="Nomor Kontak" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nomor Kontak'">

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
                              <option>--Kota Asal--</option>
                          </select>
                          </div>
                          <p class="text-danger">{{ $errors->first('provinsi') }}</p>
                          <p class="text-danger">{{ $errors->first('kota') }}</p>
                          <div class="col-md-12 form-group">
                            <input type="text" class="form-control" value="{{ old('alamat') }}" id="alamat" name="alamat" placeholder="Alamat Anda" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat Anda'">
                        </div>
                        <p class="text-danger">{{ $errors->first('alamat') }}</p>
                        <div class="col-md-12 form-group pb-5">
                            <button type="submit" value="submit" class="primary-btn">Buat Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
				url:'{!!URL::to('city')!!}',
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
