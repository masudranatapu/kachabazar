@php
    $menu_categories = App\Category::where('parent_id', null)->where('feature', 1)->orderBy('order', 'asc')->get();
    $website = App\Website::latest()->first();
@endphp
<!--header area start-->
<header class="header_area">
    <!--header top start-->
    <div class="header_top top_three d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="welcome_text">
                        <p>Welcome to Garden Cloud </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="top_right text-right">
                        <ul>
                            <li class="top_links">
                                <a href="#">
                                    My Account <i class="ion-chevron-down"></i>
                                </a>
                                <ul class="dropdown_links">
                                    @auth
                                        @if(Auth::check() && auth()->user()->role_id == 1)
                                            <li><a href="{{ route('admin.dashboard') }}" target="_blank">My Dashboard</a></li>
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @endif
                                    @endauth
                                    @auth
                                        @if(Auth::check() && auth()->user()->role_id == 2)
                                            <li><a href="{{ route('customer.wishlist.index') }}">My Profile </a></li>
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @endif
                                    @else
                                        <li><a href="{{ route('login') }}">Sign In</a></li>
                                        {{-- <li><a href="{{ route('register') }}" >Sign Up</a></li> --}}
                                    @endauth
                                </ul>
                            </li>
                            {{-- <li class="language"><a href="#">English <i class="ion-chevron-down"></i></a>
                                <ul class="dropdown_language">
                                    <li><a href="javascript:;">বাংলা </a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header top start-->
    <!--header middel start-->
    <div class="header_middel middel_three">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 d-md-block d-none">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ URL::to($website->logo) }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="search_bar d-none d-md-block">
                        <form action="{{ route('search') }}" id="search_form" method="get">
                            <input placeholder="Search entire store here..." type="text">
                            <button type="submit"><i class="ion-ios-search-strong"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="cart_area">
                        <div class="logo-bar mb-0 mr-3 d-md-none d-block">
                            <div class="logo">
                                <a href="{{ route('home') }}"><img src="{{ URL::to($website->logo) }}" alt=""></a>
                            </div>
                        </div>
                        <div class="search_bar mb-0 mr-3 d-md-none d-block">
                            <a href="#" class="open-close"><i class="ion-ios-search-strong"></i></a>
                            <form action="{{ route('search') }}" method="get" id="mobile-search">
                                <input placeholder="Search entire store here..." type="text">
                                <button type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        @if(Auth::check() && auth()->user()->role_id == 2)
                            <div class="wishlist_link">
                                <a href="javascript:;">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif
                        <div class="cart_link">
                            <a href="javascript:void(0)" class="d-flex align-items-center">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="cont">My Cart</span>
                            </a>
                            <span class="cart_count">
                                @if (session('cart'))
                                    {{count(session('cart'))}}
                                @else
                                    0
                                @endif
                            </span>
                            <!--mini cart-->
                                <div class="mini_cart">
                                <div class="items_nunber">
                                    <span>
                                        @if (session('cart'))
                                            {{count(session('cart'))}}
                                        @else
                                            0
                                        @endif
                                        Items in Cart
                                    </span>
                                </div>
                                @if(session('cart'))
		                            @foreach(session('cart') as $id => $details)
                                    <div class="cart_item">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img style="width: 50px; height: 50px;" src="{{ URL::to($details['image']) }}" alt=""></a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="#">{{ $details['title'] }}</a>
                                            </div>
                                            <div class="col-md-2">
                                                <span>&#x9f3; {{ $details['sell_price'] }}</span>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="close-circle">
                                                    <a class="remove-from-cart" data-id="{{ $id }}">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                <div class="cart_button view_cart">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @auth
                                                <a style="background-color: #0D7E40; color: white;" href="{{ route('customer.checkout.index') }}">Checkout</a>
                                            @else
                                                <!-- <a style="background-color: #0D7E40; color: white;" href="{{ url('/cart-login') }}">Checkout</a> -->
                                                <a style="background-color: #0D7E40; color: white;" href="{{ route('customer.checkout.index') }}">Checkout</a>
                                            @endauth
                                        </div>
                                        <div class="col-md-6">
                                            <a style="background-color: #0D7E40; color: white;" href="{{ route('cart') }}">View Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--mini cart end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header middel end-->
    <!--header bottom satrt-->
    <div class="header_bottom bottom_three">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="categories_menu">
                        <div class="categories_title">
                            <h2 class="categori_toggle"> All categories</h2>
                        </div>
                        <div class="categories_menu_inner">
                            <ul>
                                @foreach ($menu_categories as $menu_category)
                                    @php
                                        $child_cats = App\Category::where('parent_id', $menu_category->id)->get();
                                    @endphp
                                    @if (count($child_cats) > 0)
                                        <li class="has-submenu">
                                            <a href="{{ route('category',$menu_category->slug) }}">
                                                {{ $menu_category->name }}
                                            </a>
                                            <ul class="submenu">
                                                @foreach ($child_cats as $child_cat)
                                                    <li class="has-submenu">
                                                        <a href="{{ route('category',$child_cat->slug) }}">{{ $child_cat->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('category',$menu_category->slug) }}">
                                                {{ $menu_category->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-7">
                    <div class="mobile-menu mobail_menu_three d-lg-none">
                            <nav>
                                <ul>
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="javascript:;">About</a></li>
                                    <li><a href="javascript:;">Campaign</a></li>
                                    <li><a href="{{route('contuct_us')}}">Contact Us</a></li>
                                </ul>
                            </nav>
                    </div>
                    <div class="main_menu_inner">
                        <div class="main_menu d-none d-lg-block">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li><a href="javascript:;">About</a></li>
                                <li><a href="javascript:;">Campaign</a></li>
                                <li><a href="{{route('contuct_us')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="contact_phone">
                        <div class="contact_icone">
                            <span class="pe-7s-headphones"></span>
                        </div>
                        <div class="contact_number">
                            <p>Call Us:</p>
                            <span> 01676-333288</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header bottom end-->
</header>
<!--header area end-->
