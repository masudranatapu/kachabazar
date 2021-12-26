<!-- modal area start-->
<div class="modal fade" id="{{ $product->slug }}_modal_{{ $key+1 }}" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="modal_tab">
                                <div class="tab-content product-details-large">
                                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
                                        <div class="modal_tab_img">
                                            <a href="#"><img src="{{ URL::to($product->cover_photo) }}" alt=""></a>
                                        </div>
                                    </div>
                                    @if ($product->others_photo)
                                        @php
                                            $post_image = explode("|",$product->others_photo);
                                        @endphp
                                        @foreach($post_image as $key=>$image)
                                            <div class="tab-pane fade" id="tab{{ $key+2 }}" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="{{ URL::to($image) }}" alt=""></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="modal_tab_button">
                                    <ul class="nav product_navactive owl-carousel" role="tablist">
                                        <li >
                                            <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false">
                                                <img src="{{ URL::to($product->cover_photo) }}" alt="">
                                            </a>
                                        </li>
                                        @if ($product->others_photo)
                                            @php
                                                $post_image = explode("|",$product->others_photo);
                                            @endphp
                                            @foreach($post_image as $key=>$image)
                                                <li>
                                                    <a class="nav-link" data-toggle="tab" href="#tab{{ $key+2 }}" role="tab" aria-controls="tab{{ $key+2 }}" aria-selected="false"><img src="{{ URL::to($image) }}" alt=""></a>
                                                </li>
                                            @endforeach
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="modal_right">
                                <div class="modal_title mb-10">
                                    <h2>{{ $product->title }}</h2>
                                </div>
                                <div class="modal_price mb-10">
                                    <span class="new_price">৳ {{ $product->sell_price }}.00</span>
                                    <span class="old_price" >৳ {{ $product->regular_price }}.00</span>
                                </div>
                                <div class="modal_content mb-10">
                                    <p>{!! $product->meta_description !!}</p>
                                </div>
                                <div class="modal_add_to_cart mb-15">
                                    <form action="{{ route('add_to_cart_with_quentity') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <div class="row">
                                                <div class="form-group col-md-4 col-6" style="margin-bottom: 0;">
                                                    <div class="input-group">
                                                        <span class="input-group-btn" style="padding: 8px;">
                                                            <button style="border-radius: 50%;"  type="button" class="btn btn-number qty-btn-minus h-45px"  data-type="minus" data-field="quantity">
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="quantity" class="form-control input-number input-qty" value="1" min="1" max="100" style="width: 100px;">
                                                        <span class="input-group-btn" style="padding: 8px;">
                                                            <button style="border-radius: 50%;"  type="button" class="btn btn-number qty-btn-plus h-45px" data-type="plus" data-field="quantity">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    {{-- <input min="1" value="1" id="qty"  name="quantity" class="form-control" type="number"> --}}
                                                </div>
                                            </div>
                                        <button type="submit">add to cart</button>
                                    </form>
                                </div>
                                <div class="modal_social">
                                    <h2>Share this product</h2>
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal area start-->
