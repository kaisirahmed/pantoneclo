@extends('layouts.app')
@section('title',$product->name)
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/product_responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery.ez-plus.css') }}"/>
@endsection
@section('content')
@section('banner')
@include('layouts.partials.pagebanner')
@endsection
<!-- Single Product -->

<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Images -->
            <div class="col-lg-1 order-lg-1 order-2">
                <ul class="image_list" id="product_gallery">
                    <li data-image="{{ $product->front_side_image }}" data-zoom-image="{{ $product->front_side_image }}">
                        <img src="{{ $product->front_side_image }}" alt=""/>
                    </li>
                    <li data-image="{{ $product->back_side_image }}" data-zoom-image="{{ $product->back_side_image }}">
                        <img src="{{ $product->back_side_image }}" alt="">
                    </li>
                    <li data-image="{{ $product->left_side_image }}" data-zoom-image="{{ $product->left_side_image }}">
                        <img src="{{ $product->left_side_image }}" alt="">
                    </li>
                    <li data-image="{{ $product->image }}" data-zoom-image="{{ $product->image }}">
                        <img src="{{ $product->image }}" alt="">
                    </li>
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="image_selected">
                    <img id="product_zoom" src="{{ $product->image }}" data-zoom-image="{{ $product->image }}"/>
                </div>
            </div>            
 
            <!-- Description -->
            <div class="col-lg-5 order-3">
                <div class="product_description">
                    <div class="product_category">{{ implode(', ', $product->categories()->pluck('name')->toArray()) }}</div>
                    <div class="product_name">{{ $product->name }}</div>
                    <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                    <div class="product_text"><p>{{ $product->description }}</p></div>
                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="clearfix" style="z-index: 1000;">
                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix">
                                    <span>Quantity: </span>
                                    <input id="quantity_input" name="quantity" type="text" pattern="[0-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down"></i></div>
                                    </div>
                                </div>

                                <!-- Product Size -->
                                <ul class="product_size">
                                    <li>
                                        <span>Size: </span>
                                        <select name="size[]" class="size_list" id="size">
                                            <option disabled selected></option>
                                            @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->code }}</option>    
                                            @endforeach                                            
                                        </select>
                                    </li>
                                </ul>
                                
                                <!-- Product Color -->
                               
                                {{-- <ul class="product_color">
                                    <li>
                                        <span>Color: </span>
                                        <div class="color_mark_container"><div id="selected_color" class="color_mark"></div></div>
                                        <div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

                                        <ul class="color_list">
                                            <li><div class="color_mark" style="background: #999999;"></div></li>
                                            <li><div class="color_mark" style="background: #b19c83;"></div></li>
                                            <li><div class="color_mark" style="background: #000000;"></div></li>
                                        </ul>
                                    </li>
                                </ul> --}}

                            </div>

                            <div class="product_price discount">&#36;{{ $product->sale_price }} </div>
                            <span> &#36;{{ $product->price }} ({{ $product->discount_amount != 0 ? $product->discount_amount : $product->discount_percentage }}&#37; off)</span>
                            <div class="button_container">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="addToCart('{{ $product->slug }}')" >Add to Cart</a>
                                <a href="{{ $product->affiliate_link }}" class="btn btn-info btn-sm" ><i class="fa">&#xf270;</i> Buy From Amazon</a>
                                <div class="product_fav"><i class="fa fa-heart"></i></div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script src='{{ asset('assets/js/jquery.ez-plus.js') }}'></script>
<script src="{{ asset('assets/js/product_custom.js') }}"></script>
@include('pantoneclo.ajax.addToCart')
@endsection