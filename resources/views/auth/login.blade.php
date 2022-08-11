@extends('layouts.app')
@section('title','Login')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('assets/styles/login.css') }}">
@endsection
@section('banner')
@include('layouts.partials.pagebanner')
@endsection
@section('content')
<div class="login_form">
    <div class="container">
        <div class="row">
            <div class="col-md-11 mt-60 mx-md-auto">
                <div class="login-box bg-white pl-lg-5 pl-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-6">
                            <div class="form-wrap bg-white">
                                <h4 class="btm-sep pb-3 mb-5">Login</h4>
                                <form class="form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group position-relative">
                                                {{-- <span class="zmdi zmdi-account"></span> --}}
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}"
                                                placeholder="Enter Email Address...">
                                                @error('email')
                                                <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group position-relative">
                                                {{-- <span class="zmdi zmdi-email"></span> --}}
                                                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                                                placeholder="Password">
                                                @error('password')
                                                    <p class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-lg-right">
                                            <a href="{{ route('password.request') }}" class="c-black">Forgot password ?</a>
                                        </div>
                                        <div class="col-12 mt-30">
                                            <button type="submit" id="submit" class="btn btn-lg btn-custom btn-dark btn-block">Sign In
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content text-center">
                                <div class="border-bottom pb-5 mb-5">
                                    <h3 class="c-black">First time here?</h3>
                                    <a href="{{ route('register') }}" class="btn btn-custom">Sign up</a>
                                </div>
                                <h5 class="c-black mb-4 mt-n1">Or Sign In With</h5>
                                <div class="socials">
                                    <a href="#" class="zmdi zmdi-facebook"></a>
                                    <a href="#" class="zmdi zmdi-twitter"></a>
                                    <a href="#" class="zmdi zmdi-google"></a>
                                    <a href="#" class="zmdi zmdi-instagram"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/login.js') }}"></script>
@endsection

