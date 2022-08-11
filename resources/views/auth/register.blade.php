@extends('layouts.app')
@section('title','Register')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/register.css') }}">
@endsection
@section('banner')
@include('layouts.partials.pagebanner')
@endsection
@section('content')
<div class="register_form">
    <div class="form_wrapper">
        <div class="form_container">
          <div class="title_container">
            <h2>Register</h2>
          
          </div>
          <div class="row clearfix">
            <div class="">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input_field"> 
                    {{-- <span><i aria-hidden="true" class="fa fa-envelope"></i></span> --}}
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter Email Address..."/>
                    @error('email')
                        <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                    @enderror
                </div>
                <div class="input_field"> 
                    {{-- <span><i aria-hidden="true" class="fa fa-lock"></i></span> --}}
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                    placeholder="Password">
                    @error('password')
                    <p class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>
                <div class="input_field"> 
                    {{-- <span><i aria-hidden="true" class="fa fa-lock"></i></span> --}}
                    <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Repeat Password">
                </div>
                <div class="input_field">
                  {{-- <span class="input-group-addon">Phone</span> --}}
                  <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number">
                  @error('phone')
                  <p class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </p>
                  @enderror
                </div>
                
                <div class="row clearfix">
                  <div class="col_half">
                    <div class="input_field"> 
                        {{-- <span><i aria-hidden="true" class="fa fa-user"></i></span> --}}
                        <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" name="first_name" placeholder="First Name">
                        @error('first_name')
                        <p class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                  </div>
                  <div class="col_half">
                    <div class="input_field"> 
                        {{-- <span><i aria-hidden="true" class="fa fa-user"></i></span> --}}
                        <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror" name="last_name" placeholder="Last Name">
                        @error('last_name')
                        <p class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="input_field radio_option">
                  <input type="radio" name="gender" value="1" id="rd1">
                  <label for="rd1">Male</label>
                  <input type="radio" name="gender" value="0" id="rd2">
                  <label for="rd2">Female</label>
                  @error('gender')
                  <p class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </p>
                  @enderror
                </div>
                <div class="input_field select_option">
                  <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" required>
                    <option value="0">Select a country</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                  <div class="select_arrow"></div>
                    @error('country_id')
                    <p class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                  
                  </div>
                <div class="input_field checkbox_option">
                    <input type="checkbox" name="terms_conditions" value="1" class="@error('terms_conditions') is-invalid @enderror" id="cb1" required>
                    <label for="cb1">I agree with <a href="#">terms and conditions</a></label>
                    @error('terms_conditions')
                    <p class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>
                <div class="input_field checkbox_option">
                    <input type="checkbox" name="newsletter" value="1" class="@error('newsletter') is-invalid @enderror" id="cb2" required>
                    <label for="cb2">I want to receive the newsletter</label>
                    @error('newsletter')
                    <p class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>
                <input class="button" type="submit" value="{{ __('Register Pantoneclo Account') }}" />
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.7/js/intlTelInput.js"></script>
<script src="{{ asset('assets/js/register.js') }}"></script>
@endsection

