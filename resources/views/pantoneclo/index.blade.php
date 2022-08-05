@extends('layouts.app')
@section('title','Pentoneclo')
@section('style')
@endsection
@section('banner')
<!-- Carousel Start -->
@include('layouts.partials.banner')
<!-- Carousel End -->
@endsection
@section('content')
<!-- Adverts -->

{{-- @include('layouts.partials.adverts') --}}

<!-- Trends -->

{{-- @include('layouts.partials.trends') --}}

<!-- Reviews -->

@include('layouts.partials.reviews')
<!-- Characteristics -->

@include('layouts.partials.characteristics')

<!-- Deals of the week -->

{{-- @include('layouts.partials.featureddeals') --}}

<!-- Popular Categories -->

@include('layouts.partials.popularcategories')

<!-- Banner -->

@include('layouts.partials.slider')

<!-- Hot New Arrivals -->

{{-- @include('layouts.partials.newarrivals') --}}

<!-- Best Sellers -->

{{-- @include('layouts.partials.bestsellers') --}}

@endsection

@section('script')

@endsection