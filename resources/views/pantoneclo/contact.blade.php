@extends('layouts.app')
@section('title','Contact')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/contact_responsive.css') }}">         
@endsection
@section('banner')
@include('layouts.partials.pagebanner')
@endsection
@section('content')

	<!-- Contact Info -->

	<div class="contact_info">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{ asset('assets/images/contact_1.png') }}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Phone</div>
								<div class="contact_info_text"><a href="callto:+386 30 796 092">+386 30 796 092</a></div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{ asset('assets/images/contact_2.png') }}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Email</div>
								<div class="contact_info_text"><a href="mailto:info@pantoneclo.com">info@pantoneclo.com</a></div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{ asset('assets/images/contact_3.png') }}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Address</div>
								<div class="contact_info_text">Pokopališka cesta 4, 3000, CeljeSlovenia</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact Form -->

	<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title">Get in Touch</div>

						<form action="#" id="contact_form">
							<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
								<input type="text" id="contact_form_name" class="contact_form_name input_field" placeholder="Your name" required="required" data-error="Name is required.">
								<input type="text" id="contact_form_email" class="contact_form_email input_field" placeholder="Your email" required="required" data-error="Email is required.">
								<input type="text" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Your phone number">
							</div>
							<div class="contact_form_text">
								<textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message."></textarea>
							</div>
							<div class="contact_form_button">
								<button type="submit" class="button contact_submit_button">Send Message</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>

	<!-- Map -->

	<div class="contact_map">
		<div id="google_map" class="google_map">
			<div class="map_container">
				<div class="mapouter">
					<div class="gmap_canvas">
						<iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Pokopali%C5%A1ka%20cesta%204,%203000,%20CeljeSlovenia&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
						<style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}</style>
						<style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
{{-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script> --}}
<script src="{{ asset('assets/js/contact_custom.js') }}"></script>
@endsection