<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-row">
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('assets/images/phone.png') }}" alt=""></div><a href="callto:+386 307 96092">PANTONECLO® Apparel </a></div>
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('assets/images/mail.png') }}" alt=""></div><a href="mailto:info@pantoneclo.com">info@pantoneclo.com</a></div>

                {{-- <div class="Eone">
                    <div><h3>Pantoneclo</h3></div>
                </div> --}}
                
                <div class="top_bar_menu ml-auto">

                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown">
                            <li>
                                <a href="#">English<i class="fas fa-chevron-down"></i></a>
                                {{-- <ul>
                                    <li><a href="#">Italian</a></li>
                                    <li><a href="#">Spanish</a></li>
                                    <li><a href="#">Japanese</a></li>
                                </ul> --}}
                            </li>
                            <li>
                                <a href="#">$ US dollar<i class="fas fa-chevron-down"></i></a>
                                {{-- <ul>
                                    <li><a href="#">EUR Euro</a></li>
                                    <li><a href="#">GBP British Pound</a></li>
                                    <li><a href="#">JPY Japanese Yen</a></li>
                                </ul> --}}
                            </li>
                        </ul>
                    </div>
                    <div class="top_bar_user">
                        <div class="user_icon"><img src="{{ asset('assets/images/user.svg') }}" alt=""></div>
                        <div><a href="{{ auth()->check() ? Auth::user()->name : route('register') }}">{{ auth()->check() ? Auth::user()->name : "Register" }}</a></div>
                        <div><a href="{{ auth()->check() ? route('logout') : route('login') }}" @if(auth()->check()) onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" @endif>{{ auth()->check() ? "Sign out" : "Sign in" }}</a></div>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>		
</div>