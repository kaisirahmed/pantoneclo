<div class="banner_2">
    {{-- <div class="banner_2_background" style="background-image:url({{ asset('assets/images/slider/banner_2_background.jpg') }})"></div>
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
                            <div class="col-lg-6 col-md-8 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">{{ implode(', ', $product->categories()->pluck('name')->toArray()) }}</div>
                                    <div class="banner_2_title">{{ $product->name }}</div>
                                    <div class="banner_2_text">{!! mb_strimwidth($product->description,0,60,".") !!}</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="{{ route('product.show',$product->slug) }}">Shop Now</a></div>
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-md-4 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{ $product->image }}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
            </div>
            @endforeach
           
        </div>
    </div> --}}
 
      
    {{-- <iframe width="100%" height="1000" 
            src="https://www.youtube.com/embed/UZP6cF3gZoM?Version=3&showinfo=0&loop=1&rel=0&autoplay=1&autohide=1&controls=0&modestbranding=0&mute=1&playlist=UZP6cF3gZoM" 
            title="Pantoneclo" 
            frameborder="0" 
            allow="autoplay">
        </iframe> --}}
        <video style="margin-top: -18px;" width="100%" height="1000" autoplay muted playsinline>
            <source src="{{ asset('assets/videos/pantoneclo.mp4') }}" type="video/mp4">
        </video>
</div>