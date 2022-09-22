@extends('layouts.app')
@section('title','Payment Policy')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/payment_policy.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/contact_responsive.css') }}">         
@endsection
@section('content')
@section('banner')
@include('layouts.partials.pagebanner')
@endsection
	<!-- Contact Info -->

	<div class="contact_info">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
                    <h4 align="center">Payment Policy</h4>
                    <br>
                    <p>When you are ready to purchase your items, click the Proceed to Checkout button. Please log in
                    if you have an account with us, if you do not already have an account you will be prompted to
                    create one, or you can check out as a guest only.
                    On your payment screen you will see the total amount of items. Please add your payment
                    method and billing address.</p>
                    <br>
                    <h6>Pantoneclo accepts a number of payment methods:</h6>
                    
                    <ul>
                         <li style="text-align: justify;">Visa</li>
                         <li style="text-align: justify;">MasterCard</li>
                         <li style="text-align: justify;">Amex</li>
                         <li style="text-align: justify;">Discover</li>
                         <li style="text-align: justify;">JCB</li>
                         <li style="text-align: justify;">Diners Club</li>
                         <li style="text-align: justify;">Apple Pay</li>
                         <li style="text-align: justify;">PayPal</li>
                    </ul>
                    
                    <br>
                    <h6>How do I know my payment transaction is secure?</h6>
                    <p>We ensure that every credit card transaction occurs within a secure environment. The
                    Pantoneclo payment system has a 128-bit SSL security encryption. You can see the transaction
                    is secure if you see a key lock at the bottom right of your web browser. We do not retain your
                    credit card information after your order is complete. Rather, it is submitted directly to our
                    banks. You can rest assured that with each purchase your credit card or bank account
                    information will be secure.</p>
                    <p>Pantoneclo is committed to a safe, enjoyable and smooth online shopping experience for all
                    customers. For your safety, Pantoneclo has implemented a payment security screening process.
                    Confirmation of customer details on certain orders may be required prior to the order being
                    
                    processed. Please ensure that you provide accurate and up to date contact information should
                    we need to confirm the security of your order.</p>

                    <h6>For further inquiries:</h6>
                    <ul>
                         <li>Address: Pokopali&scaron;ka cesta 4, 3000 Celje, Slovenia</li>
                         <li>Phone: +38630796092</li>
                         <li>Email: info@pantoneclo.com</li>
                    </ul>
                    <br>
				</div>
			</div>
		</div>
	</div>
 
 
@endsection
@section('script')
<script src="{{ asset('assets/js/contact_custom.js') }}"></script>
@endsection