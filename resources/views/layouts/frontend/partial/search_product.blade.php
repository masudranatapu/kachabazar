<div class="row">
    @if ($products->count() > 0)
        @foreach ($products as $key=>$product)
            @php
                $stock = App\Purchase::where('product_id',$product->id)->get();
            @endphp
            @if ($stock->count() > 0)
                <div class="col-lg-3 col-md-3 col-sm-6 col-6 mb-3">
                    <div class="single_product">
                        <div class="product_thumb">
                            <a href="{{ route('product_details',$product->slug) }}">
                                <img style="width: 263px; height: 263px;" src="{{ URL::to($product->cover_photo) }}" alt="{{ $product->title }}">
                            </a>
                            <div class="btn_quickview">
                                <a href="#" data-toggle="modal" data-target="#{{ $product->slug }}_modal_{{ $key+1 }}"  title="Quick View"><i class="ion-ios-eye"></i></a>
                            </div>
                        </div>
                        <div class="product_content">
                            <h3><a href="{{ route('product_details',$product->slug) }}">{{ $product->title }}</a></h3>
                            <div class="product_price">
                                @if($product->discount)
                                    <span class="new-price mr-10">৳ {{ $product->sell_price }}</span>
                                    <del class="old-price">৳ {{ $product->regular_price }}</del>
                                @else 
                                    <del class="old-price">৳ {{ $product->regular_price }}</del>
                                @endif
                            </div>
                            <div class="product_action">
                                <ul>
                                    <li class="product_cart"><a href="{{ route('add_to_cart',$product->id) }}" title="Add to Cart">Add to Cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
            <h1 class="text-danger" style="text-align: center; width: 100%;">No products available</h1>
    @endif
    
    @if ($products->count() > 0)
        @foreach ($products as $key=>$product)
            @include('layouts.frontend.partial.quick-view')
        @endforeach
    @endif
</div>
