@extends('layouts.app')
@section('title',$slug)
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/shop_responsive.css') }}">
@endsection
@section('banner')
<!-- Page Header Start -->
@include('layouts.partials.pagebanner')
@endsection
@section('content')
<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @foreach ($categories as $category)
                            <li><a href="{{ route('category.products',$category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <input class="form-check-input" type="radio" name="priceRange" id="priceRange1" value="$10 - $50">
                            <label class="form-check-label" for="priceRange1">
                              10$-50$
                            </label>
                        </div>
                        <div class="filter_price">
                            <input class="form-check-input" type="radio" name="priceRange" id="priceRange2" value="$50 - $150">
                            <label class="form-check-label" for="priceRange2">
                              50$-150$
                            </label>
                        </div>
                        <div class="filter_price">
                            <input class="form-check-input" type="radio" name="priceRange" id="priceRange3" value="$150 - $300">
                            <label class="form-check-label" for="priceRange3">
                              150$-300$
                            </label>
                        </div>
                        <div class="filter_price">
                            <input class="form-check-input" type="radio" name="priceRange" id="priceRange4" value="$300 - 1000">
                            <label class="form-check-label" for="priceRange4">
                              300$-1000
                            </label>
                        </div>
                    </div>
                    {{-- <div class="sidebar_section">
                        <div class="sidebar_subtitle color_subtitle">Color</div>
                        <ul class="colors_list">
                            <li class="color"><a href="#" style="background: #b19c83;"></a></li>
                            <li class="color"><a href="#" style="background: #000000;"></a></li>
                            <li class="color"><a href="#" style="background: #999999;"></a></li>
                            <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
                            <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
                            <li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
                        </ul>
                    </div> --}}
                    {{-- <div class="sidebar_section">
                        <div class="sidebar_subtitle brands_subtitle">Brands</div>
                        <ul class="brands_list">
                            <li class="brand"><a href="#">Apple</a></li>
                            <li class="brand"><a href="#">Beoplay</a></li>
                            <li class="brand"><a href="#">Google</a></li>
                            <li class="brand"><a href="#">Meizu</a></li>
                            <li class="brand"><a href="#">OnePlus</a></li>
                            <li class="brand"><a href="#">Samsung</a></li>
                            <li class="brand"><a href="#">Sony</a></li>
                            <li class="brand"><a href="#">Xiaomi</a></li>
                        </ul>
                    </div> --}}
                </div>

            </div>

            <div class="col-lg-9">
                
                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span>{{ count($products) }}</span> products found</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">Highest rated<i class="fa fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>Highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>Name</li>
                                        <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>Price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid">
                        <div class="product_grid_border"></div>
                        @foreach($products as $product)
                        <!-- Product Item -->
                        <div class="product_item discount">
                            {{-- <div class="product_border"></div> --}}
                            
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ $product->image }}" alt=""></div>
                            <a href="{{ route('product.show',$product->slug) }}" tabindex="0">
                                <div class="product_content">
                                    <div class="product_price">&#36;{{ $product->sale_price }}<span>&#36;{{ $product->price }}</span></div>
                                    <div class="product_name"><p>{{ mb_strimwidth($product->name,0,30,"...") }}</p></div>
                                </div>
                            </a>
                            <div class="product_fav"><i class="fa fa-heart"></i></div>
                            <ul class="product_marks">
                                @if($product->discount_amount != 0)
                                    <li class="product_mark product_discount">-{{ $product->discount_amount }}$</li>
                                @elseif($product->discount_percentage !=0)
                                    <li class="product_mark product_discount">-{{ $product->discount_percentage }}%</li>
                                @endif
                                <li class="product_mark product_new">new</li>
                            </ul>
                            <div class="product_extras">
                                <a href="{{ route('product.show',$product->slug) }}"><button class="product_cart_button" tabindex="0">Details</button></a>
                            </div>
                            {{-- <a href="javascript:void(0);" class="addToCart" onclick="addToCart('{{ $product->slug }}')" >Add to Cart</a> --}}
                        </div>
                        @endforeach
                    </div>

                    <!-- Shop Page Navigation -->

                    <div class="shop_page_nav d-flex flex-row">
                        {!! $products->links() !!}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('assets/js/shop_custom.js') }}"></script>
@include('pantoneclo.ajax.addToCart')
@endsection