@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="login_box_area section_gap" style="padding: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="{{ url('/assets/img/hasiltani.jpg') }}" alt="">
                    <div class="hover">
                        <h4>Belum punya akun?</h4>
                        <p>Silahkan daftar disini</p>
                        <a class="primary-btn" href="{{ url('/register') }}">Buat Akun</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner py-2">
                    <h3>Log in Akun</h3>
                    @if(session('msg'))
                        <div class="alert alert-@if(session('msg')['success']){{ 'success' }}@else{{ 'danger' }}@endif">
                            {{ session('msg')['msg'] }}
                        </div>
                    @endif
                    <form class="row login_form" action="{{ url('/user/login') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input required type="email" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input required type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        {{-- <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div> --}}
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Log In</button>
                            {{-- <a href="#">Forgot Password?</a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
