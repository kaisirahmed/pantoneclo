
<div class="home">
    {{-- <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('assets/images/shop_background.jpg') }}"></div> --}}
    <div class="home_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="home_content d-flex flex-column">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
        
