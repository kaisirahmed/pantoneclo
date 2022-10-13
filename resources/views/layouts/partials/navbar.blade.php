<nav class="main_nav">
    <div class="container">
        <div class="row">
            <div class="col">
                
                <div class="main_nav_content d-flex flex-row">

                    <!-- Categories Menu -->
                    <div class="logo"><a href="#"><img src="{{ asset('assets/images/pantoneclo.png') }}" width="200px" height="60px"></a></div>
                    {{-- <div class="cat_menu_container">
                        <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                            <div class="cat_burger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </div>
                            <div class="cat_menu_text">categories</div>
                        </div>
 
                        <ul class="cat_menu">
                            @foreach($categories as $category)
                                @if($category->parent_id == 0) 
                                <li class="{{ count($category->subcategory) > 0 ? 'hassubs' : '' }}">
                                    <a href="{{ route('category.products',$category->slug) }}">{{ $category->name }}<i class="fa fa-chevron-right ml-auto"></i></a>
                                    @if(count($category->subcategory) > 0)
                                    <ul>
                                        @include('layouts.partials.subcategories', ['subcategories' => $category->subcategory])
                                    </ul>
                                    @endif
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div> --}}

                    <!-- Menu -->

                    @include('layouts.partials.menu')
                    

                    <!-- Menu Trigger -->

                    <div class="menu_trigger_container ml-auto">
                        <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                            <div class="menu_burger">
                                {{-- <div class="menu_trigger_text">menu</div> --}}
                                <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>

<div class="page_menu">
    <div class="container">
        <div class="row">
            <div class="col">
                
                <div class="page_menu_content">
                    
                    <div class="page_menu_search">
                        <form action="#">
                            <input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
                        </form>
                    </div>
                    <ul class="page_menu_nav">
                        <li class="page_menu_item has-children">
                            <a href="#">Language<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection">
                                <li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
                                {{-- <li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li> --}}
                            </ul>
                        </li>
                        <li class="page_menu_item has-children">
                            <a href="#">Currency<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection">
                                <li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
                                {{-- <li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li> --}}
                            </ul>
                        </li>
                        <li class="page_menu_item">
                            <a href="{{ route('home') }}">Home<i class="fa fa-angle-down"></i></a>
                        </li>
                        @foreach ($categories as $category)
                        <li class="page_menu_item">
                            <a href="{{ route('category.products',$category->slug) }}">{{ $category->name }}<i class="fas fa-chevron-down"></i></a>
                        </li>
                        @endforeach
                        <li class="page_menu_item">
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
                        <li class="page_menu_item">
                            <a href="{{ route('account') }}">{{ auth()->user()->name }}<i class="fas fa-chevron-down"></i></a>
                        </li>
                        @endif
                    </ul>
                    
                    <div class="menu_contact">
                        <div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{ asset('assets/images/phone_white.png') }}" alt=""></div><a href="callto:+386 30 796 092">+386 30 796 092</a></div>
                        <div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{ asset('assets/images/mail_white.png') }}" alt=""></div><a href="mailto:info@pantoneclo.com">info@pantoneclo.com</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>