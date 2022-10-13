<!-- Main Nav Menu -->

<div class="main_nav_menu ml-auto">
    <ul class="standard_dropdown main_nav_dropdown">
        <li><a href="{{ route('home') }}">Home</a></li>
        @foreach ($categories as $category)
        <li>
            <a href="{{ route('category.products',$category->slug) }}">{{ $category->name }}</a>
        </li>
        @endforeach
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
        @if(auth()->check())
        <li>
            <a href="{{ route('account') }}">{{ auth()->user()->name }}</a>
        </li>
        @endif
    </ul>
</div>  