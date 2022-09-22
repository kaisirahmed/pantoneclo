<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 footer_col">
                <div class="footer_column footer_contact">
                    <div class="logo_container">
                        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/pantoneclo.png') }}" width="200px" height="60px"></a></div>
                    </div>
                    <div class="footer_title">Got Question? Call Us 24/7</div>
                    <div class="footer_phone"><a href="callto:+386 30 796 092">+386 30 796 092</a></div>
                    <div class="footer_contact_text">
                        <p>Pokopališka cesta 43000 </p>
                        <p>CeljeSlovenia</p>
                    </div>
                    <div class="footer_social">
                        <ul>
                            <li><a href="https://www.facebook.com/PantonecloEU/" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/pantone_clo/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCWGlFHHU_fvv01lO9IrTn5g" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="https://www.google.com.bd/search?q=Pantonclo&ludocid=12548668273068374647&lsig=AB86z5WTJsQ9lHO_2xwxm4jwjGvq" target="_blank"><i class="fa fa-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 offset-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Find it Fast</div>
                    <ul class="footer_list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Policy</div>
                    <ul class="footer_list">
                        <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                        <li><a href="#">FAQs</a></li>
                        {{-- <li><a href="#">Accessories</a></li>
                        <li><a href="#">Cameras & Photos</a></li>
                        <li><a href="#">Hardware</a></li>
                        <li><a href="#">Computers & Laptops</a></li> --}}
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Customer Care</div>
                    <ul class="footer_list">
                        <li><a href="{{ route('account') }}">My Account</a></li>
                        <li><a href="{{ route('account.orders') }}">My Orders</a></li>
                        {{-- <li><a href="#">Wish List</a></li>
                        <li><a href="#">Customer Services</a></li>
                        <li><a href="#">Returns / Exchange</a></li>
                        <li><a href="#">Product Support</a></li> --}}
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>