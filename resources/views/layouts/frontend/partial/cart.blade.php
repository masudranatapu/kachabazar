<li class="dropdown phone">

    <a href="" class="top-cart" data-toggle="dropdown">
        <i class="fa fa-shopping-bag phone" aria-hidden="true"></i>
        <span class="top-cart-item">
            @if (session('cart'))
                {{count(session('cart'))}}
            @else
                0
            @endif
        </span>
    </a>
    @if (session('cart'))
    @php
        $total = 0;
    @endphp
        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="min-width: 200px;">
            @foreach (session('cart') as $id => $details)
            @php
                $total += $details['sell_price'] * $details['quantity'];
            @endphp
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="#">{{ $details['title'] }} <span></span></a>
                    <small>
                        {{ $details['quantity'] }} x ৳{{ $details['sell_price'] }}
                        <span class="btn btn-danger btn-xs remove-from-cart pull-right" data-id="{{ $id }}">x</span>
                    </small>
                </li>

            @endforeach

            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Total: <strong>৳ {{ $total }}</strong></a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation" class="clearfix">
                <div class="col-md-6 text-left">
                    <a role="menuitem" class="btn btn-xs btn-success" style="display:block;padding:5px;color:#FFF;" tabindex="-1" href="{{ route('cart') }}">View</a>
                </div>
                <div class="col-md-6 text-right">
                    @auth
                        <a href="{{ route('customer.checkout.index') }}" class="btn btn-xs btn-success" style="display:block;padding:5px;width:70px;color:#FFF;">Checkout</a>
                    @else
                        <button data-toggle="modal" data-target="#checkout" class="btn btn-xs btn-success" style="display:block;padding:5px;width:70px;color:#FFF;"  onclick="
                        @php
                            session()->put('checkout','yes');
                        @endphp ">Checkout</button>
                    @endauth
                </div>                
            </li>
        </ul>
    @endif
    
</li>
