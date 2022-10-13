@extends('layouts.app')
@section('title','Address Create')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/account.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/header.css') }}">
@endsection
@section('banner')
<!-- Page Header Start -->
@include('layouts.partials.pagebanner')
@endsection
@section('content')
   <!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            @include('pantoneclo.account.sidebar')
            <main class="col-md-9 order-md-1">
                <h4 class="mb-3">Address</h4>
                <form class="needs-validation form-box" novalidate="" method="POST" action="{{ route('account.address.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="" value="{{ old('first_name') }}" required>
                            <div class="invalid-feedback">
                            Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="" value="{{ old('last_name') }}" required>
                            <div class="invalid-feedback">
                            Valid last name is required.
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="you@email.com" value="{{ old('email') }}">
                            <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="phone" placeholder="+xxx-xxxxxxx" value="{{ old('mobile') }}" required>
                            <div class="invalid-feedback">
                            Valid phone is required.
                            </div>
                        </div>
                    </div>
                
                    <div class="mb-3">
                        <label for="street">Street</label>
                        <input type="text" name="street" class="form-control" id="street" placeholder="" value="{{ old('street') }}" required>
                        <div class="invalid-feedback">
                            Please enter your street.
                        </div>
                    </div>
        
                    <div class="mb-3">
                    {{-- <label for="street">Street 2 <span class="text-muted">(Optional)</span></label> --}}
                    <input type="text" name="street2" class="form-control" id="street2" placeholder="" value="{{ old('street2') }}">
                    </div>
        
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" name="country_id" id="billing_country" required>
                            <option value="">Choose...</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                            </select>
                            <div class="invalid-feedback">
                            Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" name="state_id" id="billing_state">
                            <option value="0">Choose...</option>
                            </select>
                            <div class="invalid-feedback">
                            Please provide a valid state.
                            </div>
                        </div>
                    
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="state">City</label>
                            <select class="custom-select d-block w-100" name="city_id" id="billing_city" >
                            <option value="0">Choose...</option>
                            </select>
                            <div class="invalid-feedback">
                            Please provide a valid state.
                            </div>
                        </div>
            
                        <div class="col-md-6 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" name="zip" id="billing_zip" placeholder="" value="{{ old('zip') }}" required>
                            <div class="invalid-feedback">
                            Zip code required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="state">Type</label>
                            <select class="custom-select d-block w-100" name="type" >
                                <option value="0">Billing/Shipping</option>
                                <option value="1">Billing</option>
                                <option value="2">Shipping</option>
                            </select>
                            <div class="invalid-feedback">
                            Please provide a valid Type.
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="default">Default</label>
                            <br>
                            <input type="checkbox" value="1" name="is_default">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                           <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </main> <!-- col.// -->
        </div>
    </div>
</section>
    
@endsection
@section('script')
@include('pantoneclo.ajax.checkout')
@endsection