@extends('layouts.app')
@section('title','Home')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/popupvideo.css') }}">
@endsection
@section('banner')
<!-- Carousel Start -->
@include('layouts.partials.banner')
<!-- Carousel End -->
@endsection
@section('content')

<!-- Deals of the week -->

{{-- @include('layouts.partials.featureddeals') --}}
<!-- Reviews -->

{{-- @include('layouts.partials.reviews') --}}

<!-- Adverts -->

@include('layouts.partials.adverts')

<!-- Characteristics -->

@include('layouts.partials.characteristics')

<!-- Trends -->
@if(count($trending) > 0)
@include('layouts.partials.trends')
@endif

<!-- Popular Categories -->

@include('layouts.partials.popularcategories')

<!-- Banner -->

{{-- @include('layouts.partials.slider') --}}

<!-- Hot New Arrivals -->

{{-- @include('layouts.partials.newarrivals') --}}

<!-- Best Sellers -->

{{-- @include('layouts.partials.bestsellers') --}}
{{-- <div class="overlay">
    <div class="videoBox" id="videobox">
          <a class="close"></a>
        <iframe width="100%" height="400" 
            src="https://www.youtube.com/embed/UZP6cF3gZoM?rel=0&autoplay=1&controls=0" 
            title="Pantoneclo" 
            frameborder="0" 
            allow="autoplay">
        </iframe>
    </div>
  </div> --}}
@endsection

@section('script')
<script src="{{ asset('assets/js/custom.js') }}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<script>
$(function() {
  // CLOSE AND REMOVE ON ESC
  $(document).on('keyup',function(e) {
    if (e.keyCode == 27) {
      $('.overlay').remove();
    }
  });
  
  // CLOSE AND REMOVE ON CLICK
  $('body').on('click','.overlay, .close', function() {
    $('.overlay').remove();
  });
  
  // SO PLAYING WITH THE VIDEO CONTROLS DOES NOT
  // CLOSE THE POPUP
  $('body').on('click','.videoBox', function(e) {
    e.stopPropagation();
  });

  $('video').on('ended', function () {
    this.load();
    this.play();
  });

});

</script>
@endsection