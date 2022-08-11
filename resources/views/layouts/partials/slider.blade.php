<div class="banner_2">
    <div class="banner_2_background" style="background-image:url({{ asset('assets/images/slider/banner_2_background.jpg') }})"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->

        <div class="owl-carousel owl-theme banner_2_slider">
            @foreach ($products as $product)
            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-8 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">{{ implode(', ', $product->categories()->pluck('name')->toArray()) }}</div>
                                    <div class="banner_2_title">{{ $product->name }}</div>
                                    <div class="banner_2_text">{{ mb_strimwidth($product->description,0,60,".") }}</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Shop Now</a></div>
                                </div>
                                
                            </div>
                            <div class="col-lg-8 col-md-4 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{ $product->image }}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
            </div>
            @endforeach
            <!-- Banner 2 Slider Item -->
            {{-- <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">Laptops</div>
                                    <div class="banner_2_title">MacBook Air 13</div>
                                    <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Explore</a></div>
                                </div>
                                
                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{ asset('assets/images/slider/girl2.png') }}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
            </div> --}}

            <!-- Banner 2 Slider Item -->
            {{-- <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">Laptops</div>
                                    <div class="banner_2_title">MacBook Air 13</div>
                                    <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Explore</a></div>
                                </div>
                                
                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{ asset('assets/images/slider/girl3.png') }}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
            </div> --}}

        </div>
    </div>
</div>