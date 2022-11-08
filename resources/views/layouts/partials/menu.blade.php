<!-- Main Nav Menu -->

<div class="main_nav_menu ml-auto">
    <ul class="standard_dropdown main_nav_dropdown">
        <li><a href="{{ route('home') }}">Home</a></li>
        {{-- @foreach ($categories as $category)
        <li>
            <a href="{{ route('category.products',$category->slug) }}">{{ $category->name }}</a>
        </li>
        @endforeach
       --}}
        @foreach($categories as $category)
            @if($category->parent_id == 0) 
            <li class="{{ count($category->subcategory) > 0 ? 'hassubs' : '' }}">
                <a href="{{ route('category.products',$category->slug) }}">{{ $category->name }}</a>
                @if(count($category->subcategory) > 0)
                <ul>
                    @include('layouts.partials.subcategories', ['subcategories' => $category->subcategory])
                </ul>
                @endif
            </li>
            @endif
        @endforeach
           
        
        @if(auth()->check())
        <li>
            <a href="{{ route('account') }}">{{ auth()->user()->name }}</a>
        </li>
        @else
        <li>
            <a href="{{ route('login') }}">Login</a>
        </li>
        <li>
            <a href="{{ route('register') }}">Register</a>
        </li>
        @endif
        <!-- Cart -->
        <li>
            <div class="cart">
                <a href="{{ route('cart') }}">
                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                        <div class="cart_icon">
                            <img src="{{ asset('assets/images/cart.png') }}" alt="">
                            <div class="cart_count"><span>{{ $cartTotalQuantity}}</span></div>
                        </div>
                        
                        {{-- <div class="cart_content">
                            <div class="cart_price">{{ $cartTotal > 0 ? $cartTotal : }}</div>
                        </div> --}}
                    </div>
                </a>
            </div>
        </li>
    </ul>
</div>  