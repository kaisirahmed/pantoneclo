@section('style')


<!-- Start Slick Slider HEAD section -->
<link rel="stylesheet" type="text/css" href="https://wowslider.com/sliders/demo-75/engine1/style.css" />
<script type="text/javascript" src="https://wowslider.com/images/demo/jquery.js"></script>
<script type="text/javascript" src="https://wowslider.com/styles/a.js"></script>
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End Slick Slider.com section -->
@endsection

<div class="banner">
    {{-- <div class="banner_background" style="background-image:url(images/banner_background.jpg)"></div> --}}
        <div class="container fill_height">
            <div id="wowslider-container1">
                <div class="ws_images">
                    <ul>
                        <li><img src="https://images-eu.ssl-images-amazon.com/images/G/31/prime/Augart/Store-Header_PC_a_eng.jpg" alt="slick image slider " title="Blueberry" id="wows1_0" /></li>
                        <li><img src="https://wowslider.com/sliders/demo-75/data1/images/2anita_foto.jpg" alt="Raspberries slick slider example " title="Raspberries" id="wows1_1" /></li>
                        <li><img src="https://wowslider.com/sliders/demo-75/data1/images/blackberries9390_1280.jpg" alt="Blackberries carousel jquery" title="Blackberries" id="wows1_2" /></li>
                        <li><img src="https://wowslider.com/sliders/demo-75/data1/images/background2277_1280_1.jpg" alt="Mix html5 slickslider" title="Mix" id="wows1_3" /></li>
                    </ul>
                </div>
                <div class="ws_bullets">
                    <div>
                        <a href="#" title="Blueberry"><img width="50px" height="50px" src="https://images-eu.ssl-images-amazon.com/images/G/31/prime/Augart/Store-Header_PC_a_eng.jpg" alt="Blueberry" />slick responsive slider </a>
                        <a href="#" title="Raspberries"><img width="50px" height="50px" src="https://wowslider.com/sliders/demo-75/data1/tooltips/2anita_foto.jpg" alt="Raspberries" />slick</a>
                        <a href="#" title="Blackberries"><img width="50px" height="50px" src="https://wowslider.com/sliders/demo-75/data1/tooltips/blackberries9390_1280.jpg" alt="Blackberries" /> slick slides</a>
                        <a href="#" title="Mix"><img width="50px" height="50px" src="https://wowslider.com/sliders/demo-75/data1/tooltips/background2277_1280_1.jpg" alt="Mix" />slick slider cdn</a>
                    </div>
                </div>
                {{-- <div class="ws_shadow"></div> --}}
            </div>
            
            {{-- <div id="effbuttons" class="control-buttons"></div> --}}
        </div>
    </div>
</div>
@section('script')
<script>var SITE_URL = 'http://wowslider.com/';</script>
<script type="text/javascript" src="{{ asset('assets/js/wowslider.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/wowscript.js') }}"></script>        <!-- End WOWSlider.com BODY section -->
@endsection