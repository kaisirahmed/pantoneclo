<div class="trends">
    <div class="trends_background" style="background-image:url(images/trends_background.jpg)"></div>
    <div class="trends_overlay"></div>
    <div class="container">
        <div class="row">

            <!-- Trends Content -->
            <div class="col-lg-3">
                <div class="trends_container">
                    <h2 class="trends_title">Trends 2022</h2>
                    <div class="trends_text"><p>Our tranding products</p></div>
                    <div class="trends_slider_nav">
                        <div class="trends_prev trends_nav"><i class="fa fa-angle-left ml-auto"></i></div>
                        <div class="trends_next trends_nav"><i class="fa fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>

            <!-- Trends Slider -->
            <div class="col-lg-9">
                <div class="trends_slider_container">

                    <!-- Trends Slider -->

                    <div class="owl-carousel owl-theme trends_slider">
                        @foreach ($trending as $trend)
                        
                        <!-- Trends Slider Item -->
                        <div class="owl-item">
                            <div class="trends_item is_new">
                                <div class="trends_image d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ $trend->image }}" alt="">
                                </div>
                                <div class="trends_content">
                                    <div class="trends_category"><a href="#">{{ implode(', ', $trend->categories()->pluck('name')->toArray()) }}</a></div>
                                    <div class="trends_info clearfix">
                                        <a href="{{ route('product.show',$trend->slug) }}"><div class="trends_name">{{ mb_strimwidth($trend->name,0,50,"...") }}</div></a>
                                        <div class="trends_price">&#36;{{ $trend->sale_price }}<span></div>
                                    </div>
                                </div>
                                {{-- <ul class="trends_marks">
                                    <li class="trends_mark trends_discount">-25%</li>
                                    <li class="trends_mark trends_new">new</li>
                                </ul> --}}
                                <div class="trends_fav"><i class="fa fa-heart"></i></div>
                            </div>
                        </div>
                            
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>