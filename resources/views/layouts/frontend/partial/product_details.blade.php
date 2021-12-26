<div class="breadcrumbs_area commun_bread py-3 grey-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul class="text-capitalize">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>Product Details</li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>{{ $product->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--single product wrapper start-->
<div class="single_product_wrapper pt-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="zoom-wrapper">
                    <div class="zoom-left">
                        <img class="zoom-img" id="zoom_03" src="{{ URL::to($product->cover_photo) }}" data-zoom-image="{{ URL::to($product->cover_photo) }}" width="480" />
                        <div id="gallery_01" style="margin-top: 10px;">
                            <a href="#" class="elevatezoom-gallery" data-update="" data-image="{{ URL::to($product->cover_photo) }}" data-zoom-image="{{ URL::to($product->cover_photo) }}">
                                <img src="{{ URL::to($product->cover_photo) }}" width="100" />
                            </a>
                            @if ($product->others_photo)
                                @php
                                    $post_image = explode("|",$product->others_photo);
                                @endphp
                                @foreach($post_image as $key=>$image)
                                    <a href="#" class="elevatezoom-gallery" data-update="" data-image="{{ URL::to($image) }}" data-zoom-image="{{ URL::to($image) }}">
                                        <img src="{{ URL::to($image) }}" width="100" />
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="product_details">
                    <h3>{{ $product->title }}</h3>
                    <div class="product_price">
                        <span class="current_price">৳ {{ $product->sell_price }} </span>
                        @if($product->discount)
                            <del class="old_price">৳ {{ $product->regular_price }}.00</del>
                        @endif
                    </div>
                    <div class="product_ratting">
                        <ul>
                            <li><a href="#"><i class="ion-star"></i></a></li>
                            <li><a href="#"><i class="ion-star"></i></a></li>
                            <li><a href="#"><i class="ion-star"></i></a></li>
                            <li><a href="#"><i class="ion-star"></i></a></li>
                            <li><a href="#"><i class="ion-star"></i></a></li>
                        </ul>
                        <ul>
                            <li><a href="#">{{ $total }}</a></li>
                        </ul>
                    </div>
                   <div class="product_description">
                    {!! $product->meta_description !!}
                   </div>
                    <div class="product_details_action">
                        <h3 style="margin-bottom: 15px;">Available Options</h3>
                        <form action="{{ route('add_to_cart_with_quentity') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="product_stock">
                                <div class="row">
                                    <div class="form-group col-md-4 col-6" style="margin-bottom: 0;">
                                        <div class="input-group">
                                            <span class="input-group-btn" style="padding: 8px;">
                                                <button style="border-radius: 50%;"  type="button" class="btn btn-number qty-btn-minus h-45px"  data-type="minus" data-field="quantity">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" name="quantity" class="form-control input-number input-qty" value="1" min="1" max="100">
                                            <span class="input-group-btn" style="padding: 8px;">
                                                <button style="border-radius: 50%;"  type="button" class="btn btn-number qty-btn-plus h-45px" data-type="plus" data-field="quantity">
                                                    <span class="fa fa-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                        {{-- <input min="1" value="1" id="qty"  name="quantity" class="form-control" type="number"> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="product_action_link">
                                <ul>
                                    <li class="product_cart"><button type="submit" title="Buy Now" class="btn btn-success btn-buy-now">Buy Now</button></li>
                                </ul>
                            </div>
                        </form>
                        <div class="social_sharing">
                            <span>Share</span>
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--single product wrapper end-->
 <!--product info start-->
<div class="product_d_info">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <li >
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">More info</a>
                            </li>
                            <li>
                               <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" >
                            <div class="product_info_content">
                                {!! $product->long_description !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" >
                            @foreach($reviews as $review)
                                <div class="product_info_content">
                                    <p>{{$review->opinion}}</p>
                                </div>
                                <div class="product_info_inner">
                                    <div class="product_ratting mb-10">
                                        <ul>
                                            @if($review->rating == 1)
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            @elseif($review->rating == 2)
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;"  class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            @elseif($review->rating == 3)
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i  style="color: red;"class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            @elseif($review->rating == 4)
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            @elseif($review->rating == 5)
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                                <li><a href="#"><i style="color: red;" class="ion-star"></i></a></li>
                                            @endif
                                        </ul>
                                        <strong>{{$review->name}}</strong>
                                        <p>09/07/2018</p>
                                    </div>
                                    <div class="product_demo">
                                        @if($review->rating == 1)
                                            <strong>Opinion</strong>
                                            <p>Very Bad</p>
                                        @elseif($review->rating == 2)
                                            <strong>Opinion</strong>
                                            <p>Not Bad</p>
                                        @elseif($review->rating == 3)
                                            <strong>Opinion</strong>
                                            <p>Good!</p>
                                        @elseif($review->rating == 4)
                                            <strong>Opinion</strong>
                                            <p>Better!</p>
                                        @elseif($review->rating == 5)
                                            <strong>Opinion</strong>
                                            <p>Best !</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="product_review_form">
                                <form action="{{ route('customer.review') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div style="padding: 10px;">
                                        <h2>Add a review </h2>
                                        <p>Your email address will not be published. Required fields are marked </p>
                                    </div>
                                    <div class="row" style="padding: 10px;">
                                        <div class="col-md-12 form-group">
                                            <label for="review_comment">Your review </label>
                                            <textarea name="opinion" class="form-control" id="review_comment"></textarea>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="author">Name</label>
                                            <input id="author" class="form-control" name="name"  type="text">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            @auth
                                                <label for="email">Email </label>
                                                <input id="email" name="email" class="form-control" value="{{ Auth::user()->email }}"  type="email">
                                            @else
                                                <label for="email">Email </label>
                                                <input id="email" name="email" class="form-control"  type="email">
                                            @endauth
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="rating">Rating</label>
                                            <select name="rating" id="rating" class="form-control">
                                                <option value="" selected disabled >Select Rating Star</option>
                                                <option value="5">5 Star</option>
                                                <option value="4">4 Star</option>
                                                <option value="3">3 Star</option>
                                                <option value="2">2 Star</option>
                                                <option value="1">1 Star</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--New Related Product  start-->
<div class="new_arrival_section  py-4 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="categorie_banner_title">
                    <h3>Related Product</h3>
                </div>
            </div>
        </div>
        <div class="row cat">
            <div class="categorie_banner_active owl-carousel">
                @foreach ($related_product as $key=>$rlt_product)
                    <div class="col-lg-3">
                        <div class="product text-center mb-4 grey-section">
                            <figure class="product-media mb-0">
                                <a href="{{ route('product_details',$rlt_product->slug) }}">
                                    <img style="width: 263px; height: 263px;" src="{{ URL::to($rlt_product->cover_photo) }}" alt="{{ $rlt_product->title }}">
                                </a>
                                <div class="product-label-group">
                                    @if($rlt_product->discount)
                                        <span class="product-label label-sale">{{$rlt_product->discount}}% off</span>
                                    @endif
                                </div>
                                <div class="product-action-vertical">
                                    <!-- <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->
                                </div>
                            </figure>
                            <div class="Service-bottom py-3">
                                <h3 class="title" title="{{ $rlt_product->title }}">
                                    <a href="{{ route('product_details',$rlt_product->slug) }}">{{ $rlt_product->title }}</a>
                                </h3>
                                <div class="product-price">
                                    <ins class="new-price">৳ {{ $rlt_product->sell_price }}</ins>
                                    @if($rlt_product->discount)
                                        <del class="old-price">৳ {{ $rlt_product->regular_price }}</del>
                                    @endif
                                </div>
                                <div class="product-action">
                                    <a href="{{ route('add_to_cart',$rlt_product->id) }}" class="btn-product pbtn-sm ml-0 text-capitalize rounded-pill" title="Buy Now">buy now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--New Related end-->
<!--product info end-->
