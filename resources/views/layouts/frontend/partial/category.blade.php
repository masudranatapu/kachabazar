<h4>Top Categories</h4>
<ul class="f">
    <li class="mbl"><img src="assets/logo.png" /></li>
    <li class="mbl">
        <div class="dv">
            <a href="contact-us.php">HOME</a>
            <a href="contact-us.php">VENDOR</a>
            <a href="contact-us.php">WISHLIST</a>
        </div>
    </li>
    <li class="mbl t">TOP CATEGORIES</li>
    
    @php
        $categorys = App\Category::where('parent_id',null)->get();
    @endphp
    @foreach ($categorys as $category)
    @php
        $s_categorys = App\Category::where('parent_id',$category->id)->get();
    @endphp
        <li class="main-l">
            <a href="{{route('category',$category->slug)}}">{{$category->name}} @if ($s_categorys->count()>0)
                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
            @endif</a>
            @if ($s_categorys->count()>0)
                <div class="sec-l">
                    <div class="container-fluid">
                        <div class="row">
                            @foreach ($s_categorys as $category)
                                <div class="col-md-4">
                                    <ul>
                                        <li><a href="{{route('category',$category->slug)}}">{{$category->name}}</a></li>
                                        @php
                                            $t_categorys = App\Category::where('parent_id',$category->id)->get();
                                        @endphp
                                        @if ($t_categorys->count()>0)
                                            @foreach ($t_categorys as $category)
                                                <li><a href="{{route('category',$category->slug)}}"><i class="fa fa-long-arrow-right"></i> {{$category->name}}</a></li>
                                            @endforeach
                                        @endif
                                        
                                        
                                    </ul>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif
            
        </li>
    @endforeach

</ul>
<h5><a href="#">+ More Categories</a></h5>