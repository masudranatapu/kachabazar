@php
    $menu_categories = App\Category::latest()->limit(5)->get();
    $website = App\Website::latest()->first();
@endphp
<!--brand area start-->
<div class="how_to_buy bg-white py-4 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">   
                <div class="categorie_banner_title mt-2">
                    <h3 class="text-center">how to buy</h3>
                </div>
            </div>    
        </div>
        <div class="brand_inner">  
            <div class="row">
                <div class="col-md-3">
                    <div class="single-inner d-flex justify-content-center align-items-center py-3">
                        <div class="item-icon light-r mr-3">
                            <i aria-hidden="true" class="flaticon flaticon-grocery d-flex"></i>
                        </div>
                        <div class="item-holder">
                            <h5 class="item--title mb-0"> Select Product</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single-inner d-flex justify-content-center align-items-center py-3">
                        <div class="item-icon light-g mr-3">
                            <i aria-hidden="true" class="flaticon flaticon-checked d-flex"></i>
                        </div>
                        <div class="item-holder">
                            <h5 class="item--title mb-0"> Add To Cart</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single-inner d-flex justify-content-center align-items-center py-3">
                        <div class="item-icon light-r mr-3">
                            <i aria-hidden="true" class="flaticon flaticon-add-to-cart d-flex"></i>
                        </div>
                        <div class="item-holder">
                            <h5 class="item--title mb-0"> Check Out</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single-inner d-flex justify-content-center align-items-center py-3">
                        <div class="item-icon light-g mr-3">
                            <i aria-hidden="true" class="flaticon flaticon-delivery-truck d-flex"></i>
                        </div>
                        <div class="item-holder">
                            <h5 class="item--title mb-0"> Waiting to Delivery</h5>
                        </div>
                    </div>
                </div>                           
            </div>
        </div>     
    </div>
</div>
<!--brand area end-->
<!--shipping area start-->
<div class="py-4 grey-section border-bottom">
    <div class="container">
        <div class="shipping_contact">   
            <div class="row">
                <div class="col-sm-4">
                    <div class="single_shipping justify-content-start">
                        <div class="shipping_icone">
                            <span class="pe-7s-call"></span>
                        </div>
                        <div class="shipping_content">
                            <h3>{{$website->phone}}</h3>
                            <p>Free support line!</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <span class="pe-7s-mail"></span>
                        </div>
                        <div class="shipping_content">
                            <h3>{{$website->email}}</h3>
                            <p>Orders Support!</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single_shipping  justify-content-end column_3">
                        <div class="shipping_icone">
                            <span class="pe-7s-timer"></span>
                        </div>
                        <div class="shipping_content">
                            <h3>Mon - Fri / 8:00 - 18:00</h3>
                            <p>Working Days/Hours!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<!--shipping area end-->
<!--footer area start-->
<div class="footer_area footer_three pt-4 grey-section">
    <div class="container">
        <div class="footer_top">
            <div class="row">
                <div class="col-sm-4 col-6">
                    <div class="single_footer text-md-left text-center">
                        <div class="footer_contact">
                            <h3>contract address</h3>
                            <ul>
                                <li><i class="ion-location"></i>{{$website->address}}</li>
                                <li><i class="ion-ios-telephone"></i>{{$website->phone}}</li>
                                <li><i class="ion-ios-email"></i> <a href="#">{{$website->email}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-6">
                    <div class="single_footer text-md-left text-center">
                        <h3>Product Categories</h3>
                        <ul>
                            @foreach($menu_categories as $cate)
                                <li><a href="{{ route('category',$cate->slug) }}">{{$cate->name}}</a></li>
                            @endforeach 
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-6 d-none d-sm-block">
                    <div class="single_footer text-md-left text-center">
                        <h3>Privacy Policy</h3>
                        @php
                            $policys = App\Policy::get();
                        @endphp
                        <ul>
                            @foreach($policys as $policy)
                                <li><a href="{{ route('policy', $policy->slug)}}">{{$policy->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright_content text-center text-md-left">
                        <p>Copyright &copy; 2021, <a href="#">GardenCloud</a>. All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-dev text-center text-md-right">
                        <p class="mb-0 text-white">Designed and developed by <a href="https://www.projanmoit.com/" class="text-white"  style="text-decoration: none;">ProjanmoIT</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer area end-->