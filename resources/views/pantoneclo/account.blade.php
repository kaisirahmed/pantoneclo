@extends('layouts.app')
@section('title','Account')
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
        <main class="col-md-9">
    
            <article class="card mb-3">
                <div class="card-body">
                    
                    <figure class="icontext">
                            <div class="icon">
                                <img class="rounded-circle img-sm border" src="{{ asset('assets/images/user.png') }}">
                            </div>
                            <div class="text">
                                <strong class="account-name">{{ $user->name }}</strong> <br> 
                                <p class="mb-1 account-email"> {{ $user->email }} </p> 
                                <p class="mb-1 account-phone"> {{ $user->phone }} </p> 
                                <a href="#" class="btn btn-light btn-sm editUser" user-id="{{ $user->id }}">Edit</a>
                            </div>
                    </figure>
                    <hr>
                    <p>
                        <i class="fa fa-map-marker text-muted"></i> &nbsp; My address:  
                         <br>
                        <span>{{ count($addresses) > 0 ? $user->address->street .", ".$user->address->street2.", ".$user->address->state->name.", ".($user->address->city != 0 ? $user->address->city->name : '')." ".$user->address->country->name : 'Not Added Yet' }}</span>
                        <a href="#" class="btn-link"> Edit</a>
                    </p>
    
                    
    
                    <article class="card-group card-stat">
                        <figure class="card bg">
                            <div class="p-3">
                                 <h4 class="title">{{ $totalOrders }}</h4>
                                <span>Orders</span>
                            </div>
                        </figure>
                        <figure class="card bg">
                            <div class="p-3">
                                 <h4 class="title">{{ $paymentOrders }}</h4>
                                <span>Payment</span>
                            </div>
                        </figure>
                        <figure class="card bg">
                            <div class="p-3">
                                 <h4 class="title">{{ $awaitingDeliveryOrders }}</h4>
                                <span>Awaiting delivery</span>
                            </div>
                        </figure>
                        <figure class="card bg">
                            <div class="p-3">
                                 <h4 class="title">{{ $shippedOrders }}</h4>
                                <span>Delivered items</span>
                            </div>
                        </figure>
                    </article>
                    
    
                </div> <!-- card-body .// -->
            </article> <!-- card.// -->
    
            <article class="card  mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-4">Last orders </h5>	
    
                    <div class="row">
                        @foreach ($orders as $order)                        
                            @foreach ($order->items as $item)
                            <div class="col-md-6">
                                <figure class="itemside mb-3">
                                    <div class="aside"><img src="{{ $item->product->image }}" class="border img-sm"></div>
                                    <figcaption class="info">
                                        <span>{{ $item->size ? $item->size : '' }}</span>
                                        <span>{{ $item->color ? $item->color : '' }}</span>
                                        <a href="{{ route('product.show',$item->product->slug) }}" tabindex="0"><p>{{ $item->product->name }}</p></a>
                                        <span class="text-success">{{ config('orderstatus.'.$order->status) }}</span>
                                    </figcaption>
                                </figure>
                            </div> <!-- col.// -->
                            @endforeach
                         @endforeach
                    </div> <!-- row.// -->
    
                    <a href="{{ route('account.orders') }}" class="btn btn-outline-primary btn-block"> See all orders <i class="fa fa-chevron-down"></i>  </a>
                </div> <!-- card-body .// -->
            </article> <!-- card.// -->
    
        </main> <!-- col.// -->
    </div>
    
    </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->  
        
@endsection
@section('script')
@include('pantoneclo.ajax.account')
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection