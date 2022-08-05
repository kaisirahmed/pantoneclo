@extends('layouts.app')
@section('title','Cart')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/cart_responsive.css') }}">
@endsection
@section('content')
<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
                    <div class="cart_items">
                        @if(!Cart::isEmpty())
                        <ul class="cart_list">
                                                    
                            <li class="cart_item clearfix">
                                
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            {{-- <th scope="col">#</th> --}}
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total</th>
                                            <th scope="col" width="14%">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach ($cartitems as $item)   
                                          <tr id="{{ $item->id }}">
                                            {{-- <th scope="row">{{ $i++ }}</th> --}}
                                            <td><div class="cart_item_image"><img src="{{ $item->attributes->image }}" alt=""></div></td>
                                            <td><div class="cart_item_text"><p title="{{ $item->name }}">{{ $item->name }}</p></div></td>
                                            <td><div class="cart_item_text"><p>{{ $item->attributes->color }}</p></div></td>
                                            <td><div class="cart_item_text"><p>{{ $sizes[$item->attributes->size] }}</p></div></td>
                                            <td>
                                                <div class="product_quantity cart_item_text clearfix">
                                                    <strong>Qty: </strong>
                                                    <input id="quantity_input" name="quantity" type="text" pattern="[0-9]*" value="{{ $item->quantity }}">
                                                    <div class="quantity_buttons">
                                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div class="cart_item_text">{{ $item->attributes->currency }}{{ $item->price }}</div></td>
                                            <td><div class="cart_item_text">{{ $item->attributes->currency }}{{ number_format($item->price * $item->quantity,2) }}</div></td>
                                            <td>
                                                <div class="cart_item_text">
                                                    <a href="javascript:void(0);" class="btn btn-outline-danger" onclick="cartDelete('{{ $item->id }}')" ><i class="fa fa-trash"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-refresh"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                  
                                </div>
                            </li>
                            
                        </ul>
                        @else
                        <div class="order_total">
                            <div class="order_total_content text-md-center">
                                <div class="order_total_title"><i class="fa fa-shopping-cart"></i> Empty Cart</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    @if(!Cart::isEmpty())
                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Sub Total:</div>
                            <div class="order_total_amount">&#36;{{ $total }}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="javascript:void(0);" class="button cart_button_clear" onclick="clearCart()">Clear Cart</a>
                        <button type="button" class="button cart_button_checkout">Update Cart</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/cart_custom.js') }}"></script>
@include('pantoneclo.ajax.addToCart')
@endsection