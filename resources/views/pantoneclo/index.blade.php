@extends('layouts.app')
@section('title','Pentoneclo')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
@endsection
@section('banner')
<!-- Carousel Start -->
@include('layouts.partials.banner')
<!-- Carousel End -->
@endsection
@section('content')

<!-- Characteristics -->

@include('layouts.partials.characteristics')

<!-- Deals of the week -->

{{-- @include('layouts.partials.featureddeals') --}}
<!-- Reviews -->

{{-- @include('layouts.partials.reviews') --}}

<!-- Adverts -->

{{-- @include('layouts.partials.adverts') --}}

<!-- Trends -->

@include('layouts.partials.trends')


<!-- Popular Categories -->

@include('layouts.partials.popularcategories')

<!-- Banner -->

{{-- @include('layouts.partials.slider') --}}

<!-- Hot New Arrivals -->

{{-- @include('layouts.partials.newarrivals') --}}

<!-- Best Sellers -->

{{-- @include('layouts.partials.bestsellers') --}}

@endsection

@section('script')
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection