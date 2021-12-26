<div class="alert panel_bg">
    <strong>
        My Account
    </strong>
</div>
<ul class="list-group">
	@if (Request::is('customer*'))
	    <li class="list-group-item" ><a style="color:{{ Request::is('customer/information') ? '#00331d' : 'green' }};" href="{{ route('customer.dashboard') }}">Account Information</a></li>
	    <li class="list-group-item"  ><a style="color:{{ Request::is('customer/wishlist') ? '#00331d' : 'green' }};" href="{{ route('customer.wishlist.index') }}">My Wishlist</a></li>
	    <li class="list-group-item" ><a style="color:{{ Request::is('customer/my-order') || Request::is('customer/order*') ? '#00331d' : 'green' }};" href="{{ route('customer.my_order') }}">My Orders</a></li>
	    <li class="list-group-item" >
	    	<i class="fa fa-sign-out" aria-hidden="true"></i>
	    	    <a role="menuitem" tabindex="-1" style="color: green;" href="#" onclick="event.preventDefault();
	    	document.getElementById('logout-form').submit();"> Logout</a>
	    </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

	@endif
</ul>
