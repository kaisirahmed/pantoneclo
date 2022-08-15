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
            <span class="text-muted">Order Amount</span>
            <span class="badge badge-secondary badge-pill">{{ $order->quantity }}</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between">
              <span>Shipping (USD)</span>
              <strong>{{ $order->shipping_charge }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>{{ $order->total }}</strong>
            </li>
          </ul>

          {{-- <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form> --}}
        </div>


        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Payment</h4>
          <form class="needs-validation form-box" novalidate="" method="POST" action="{{ route('order.purchage') }}">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order_id }}">
            <div class="d-block my-3">
                {{-- <div class="custom-control custom-radio">
                  <input id="credit" name="payment_method" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="debit" name="payment_method" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="paypal" name="payment_method" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">Paypal</label>
                </div> --}}
                <div class="custom-control custom-radio">
                  <input id="cod" name="payment_method" value="COD" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="cod">COD(Cash On Delivery)</label>
                </div>
            </div>
            <hr class="mb-4">
            {{-- <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div> --}}
            <a href="{{ route('cart') }}" class="btn btn-warning btn-sm">Pay Later</a>
            <button class="btn btn-primary btn-sm" type="submit">Pay Now</button>
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
 