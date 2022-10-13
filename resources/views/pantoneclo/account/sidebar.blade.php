<aside class="col-md-3">
    <nav class="list-group">
        <a class="list-group-item active" href="{{ route('account') }}"> Account overview  </a>
        {{-- <a class="list-group-item" href="page-profile-address.html"> My Address </a> --}}
        <a class="list-group-item" href="{{ route('account.orders') }}"> My Orders </a>
        {{-- <a class="list-group-item" href="page-profile-wishlist.html"> My wishlist </a> --}}
        {{-- <a class="list-group-item" href="page-profile-seller.html"> My Selling Items </a> --}}
        <a class="list-group-item" href="{{ route('account.address') }}"> Address </a>
        <a class="list-group-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('sidebar-logout').submit();"> Log out </a>
        <form id="sidebar-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</aside> <!-- col.// -->