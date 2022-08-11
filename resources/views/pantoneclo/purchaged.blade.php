@extends('layouts.app')
@section('title','Checkout')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/purchaged.css') }}">
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
      
        <div class="col-md-12 order-md-1">
          <article class="card"> 
            <div class="card-body"> 
              <div class="mt-4 mx-auto text-center" style="max-width:600px"> 
                <svg width="96px" height="96px" viewBox="0 0 96 96" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> 
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> 
                    <g id="round-check"> 
                      <circle id="Oval" fill="#D3FFD9" cx="48" cy="48" r="48"></circle> 
                      <circle id="Oval-Copy" fill="#87FF96" cx="48" cy="48" r="36"></circle> 
                      <polyline id="Line" stroke="#04B800" stroke-width="4" stroke-linecap="round" points="34.188562 49.6867496 44 59.3734993 63.1968462 40.3594229"></polyline> 
                    </g> 
                  </g> 
                </svg> 
                <div class="my-3"> 
                  <h4>Thank you for order</h4> 
                  <p>{{ $message }}</p> 
                </div> 
              </div> 
              <ul class="steps-wrap mx-auto" style="max-width: 600px"> 
                <li class="step active"> 
                  <span class="icon">1</span> 
                  <span class="text">Order received</span> 
                </li> <!-- step.// --> 
                <li class="step "> 
                  <span class="icon">2</span> 
                  <span class="text">Confirmation</span> 
                </li> <!-- step.// --> 
                <li class="step "> 
                  <span class="icon">3</span> 
                  <span class="text">Delivery</span> 
                </li> <!-- step.// --> </ul> <!-- tracking-wrap.// --> <br> 
              </div>
              <a href="{{ route('shop') }}" class="btn btn-warning btn-sm float-right">Continue Shopping</a>
          </article>

        </div>
        

      <footer class="my-5 pt-5 text-muted text-center text-small">
      
      </footer>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
 