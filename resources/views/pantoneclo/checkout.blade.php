@extends('layouts.app')
@section('title','Checkout')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/checkout.css') }}">
@endsection
@section('banner')
@include('layouts.partials.pagebanner')
@endsection
@section('content')
<div class="checkout_section">
  <div class="container">
    {{-- <div class="py-5 text-center">
      <h2>Checkout</h2>
      
    </div> --}}
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your Orders</span>
            <span class="badge badge-secondary badge-pill">{{ $cartTotalQuantity }}</span>
          </h4>
          <ul class="list-group mb-3">
            <table class="table" id="cartTable">
            @foreach ($cartitems as $item)
              <tr>
                <td style="vertical-align: middle;width: 30%;" align="left"><img width="50%" src="{{ $item->attributes->image }}" alt=""></td>
                <td style="vertical-align: middle;width: 40%;" align="left">{{ mb_strimwidth($item->name,0,30,"...") }}</td>
                <td style="vertical-align: middle">{{ $item->attributes->variation }} | {{ $item->quantity }}</td>
                <td style="vertical-align: middle">{{ $item->attributes->currency }}{{ $item->price }}</td>
              </tr>
                {{-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0"><img width="30px" style="border-right: 1px solid #dfdfdf" src="{{ $item->attributes->image }}" alt=""> {{ $item->name }}</h6>
                    <small class="text-muted">{{ $item->attributes->options }} | {{ $item->quantity }}</small>
                  </div>
                  <span class="text-muted">{{ $item->attributes->currency }}{{ $item->price }}</span>
                </li> --}}
            @endforeach
            </table>
            {{-- <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li> --}}
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>{{ $cartTotal }}</strong>
            </li>
          </ul>

          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form>
        </div>


        <div class="col-md-8 order-md-1">
          <form class="needs-validation form-box" novalidate="" method="POST" action="{{ route('checkout.store') }}">
            @csrf
          @if($user->billing() != null)
          <div class="alert alert-soft-warning d-flex align-items-center card-margin" role="alert">
            <input type="checkbox" value="{{ $user->billing()->id }}" name="billing_id" id="billingId">
            <div class="text-body">
              &nbsp;{{ $user->billing() != null ? $user->billing()->street .", ".$user->billing()->street2.", ".$user->billing()->state->name.", ".($user->billing()->city != 0 ? $user->billing()->city->name : '')." ".$user->billing()->country->name : 'Not Added Yet' }}
            </div>
            <button class="btn btn-outline-primary btn-sm ml-auto" disabled>Billing Address</button>
          </div>
          @endif
          @if($user->shipping() != null)
          <div class="alert alert-soft-warning d-flex align-items-center card-margin" role="alert">
            <input type="checkbox" value="{{ $user->shipping()->id }}" name="shipping_id" id="shippingId">
            <div class="text-body">
              &nbsp;{{ $user->shipping() != null ? $user->shipping()->street .", ".$user->shipping()->street2.", ".$user->shipping()->state->name.", ".($user->shipping()->city != 0 ? $user->shipping()->city->name : '')." ".$user->shipping()->country->name : 'Not Added Yet' }}
            </div>
            <button class="btn btn-outline-primary btn-sm ml-auto" disabled>Shipping Address</button>
          </div>
          @endif
          <h6 class="text-muted">If you want to add use new billing or shipping please fillup the fields. Otherwise set the default address automatically.</h6>
          <hr class="mb-4">
          @if($user->billing() != null && $user->shipping() != null)
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="default_address" class="custom-control-input" id="default-address" value="1">
            <label class="custom-control-label" for="default-address"><b>Place order with default address</b></label>
          </div>
          <hr class="mb-4">
          @endif
          <div id="billing-address">
            <h5 class="mb-3">Billing Address</h5>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" name="billing_first_name" class="form-control" id="billing_firstName" placeholder="" value="">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" name="billing_last_name" class="form-control" id="billing_lastName" placeholder="" value="">
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            {{-- <div class="mb-3">
              <label for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div> --}}
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" name="billing_email" class="form-control" id="billing_email" placeholder="you@email.com">
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phone">Mobile</span></label>
                <input type="text" name="billing_mobile" class="form-control" id="billing_mobile" placeholder="+xxx-xxxxxxx" value="">
                <div class="invalid-feedback">
                  Valid phone is required.
                </div>
              </div>
            </div>
         
            <div class="mb-3">
              <label for="street">Street</label>
              <input type="text" name="billing_street" class="form-control" id="billing_street" placeholder="">
              <div class="invalid-feedback">
                Please enter your street.
              </div>
            </div>

            <div class="mb-3">
              {{-- <label for="street">Street 2 <span class="text-muted">(Optional)</span></label> --}}
              <input type="text" name="billing_street2" class="form-control" id="billing_street2" placeholder="">
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" name="billing_country_id" id="billing_country">
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
                <select class="custom-select d-block w-100" name="billing_state_id" id="billing_state">
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
                <select class="custom-select d-block w-100" name="billing_city_id" id="billing_city" >
                  <option value="0">Choose...</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="billing_zip" id="billing_zip" placeholder="">
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="is_same" class="custom-control-input" id="same-address" value="1">
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div>
            {{-- <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div> --}}

          <hr class="mb-4">
          
            <div class="shipping-address">
              <h5 class="mb-3">Shipping address</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" name="shipping_first_name" class="form-control" id="shipping_first_name" placeholder="" value="">
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" name="shipping_last_name" class="form-control" id="shipping_last_name" placeholder="" value="">
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
              </div>

              {{-- <div class="mb-3">
                <label for="username">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" class="form-control" id="username" placeholder="Username" required>
                  <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                  </div>
                </div>
              </div> --}}
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="email">Email</label>
                  <input type="email" name="shipping_email" class="form-control" id="shipping_email" placeholder="">
                  <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="phone">Phone <span class="text-muted">(Optional)</span></label>
                  <input type="text" name="shipping_mobile" class="form-control" id="shipping_mobile" placeholder="" value="">
                  <div class="invalid-feedback">
                    Valid phone is required.
                  </div>
                </div>
              </div>
          
              <div class="mb-3">
                <label for="street">Street</label>
                <input type="text" name="shipping_street" class="form-control" id="shipping_street" placeholder="1234 Main St">
                <div class="invalid-feedback">
                  Please enter your street.
                </div>
              </div>

              <div class="mb-3">
                {{-- <label for="street">Street 2 <span class="text-muted">(Optional)</span></label> --}}
                <input type="text" name="shipping_street2" class="form-control" id="shipping_street2" placeholder="Apartment or suite">
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="country">Country</label>
                  <select class="custom-select d-block w-100" name="shipping_country_id" id="shipping_country">
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
                  <select class="custom-select d-block w-100" name="shipping_state_id" id="shipping_state">
                    <option value="">Choose...</option>
                  </select>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="state">City</label>
                  <select class="custom-select d-block w-100" name="shipping_city_id" id="shipping_city" >
                    <option value="">Choose...</option>
                  </select>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="zip">Zip</label>
                  <input type="text" class="form-control" name="shipping_zip" id="shipping_zip" placeholder="">
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>
                </div>
              </div>
              <hr class="mb-4">
            </div>  
          </div>
            <button class="btn btn-primary btn-sm" type="submit">Place Order</button>
          </form>
        </div>
        

      <footer class="my-5 pt-5 text-muted text-center text-small">
      
      </footer>
  </div>
</div>
@endsection
@section('script')
@include('pantoneclo.ajax.checkout')
<script src="{{ asset('assets/js/checkout.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
 