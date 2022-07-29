<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>

@include('layouts.partials.meta')
@include('layouts.partials.style')
@yield('style')

</head>

<body>

<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		@include('layouts.partials.header')

	</header>
	
	<!-- Banner -->

	@yield('banner')

	@yield('content')

	<!-- Recently Viewed -->

	@include('layouts.partials.recentlyviews')

	<!-- Brands -->

	@include('layouts.partials.brands')

	<!-- Newsletter -->

	@include('layouts.partials.newsletter')

	<!-- Footer -->

	@include('layouts.partials.footer')

	<!-- Copyright -->

	@include('layouts.partials.copyright')

</div>

@include('layouts.partials.script')
@yield('script')

</body>

</html>

<script>
$(function () {
  $.scrollUp({
    scrollName: 'scrollUp', // Element ID
    topDistance: '300', // Distance from top before showing element (px)
    topSpeed: 500, // Speed back to top (ms)
    animation: 'fade', // Fade, slide, none
    animationInSpeed: 1000, // Animation in speed (ms)
    animationOutSpeed: 1000, // Animation out speed (ms)
    scrollText: 'Scroll to top', // Text for element
    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
  });
});
</script>