<div  >
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">বিষয় <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
        
                        <div class="container">
                            <div class="row">
                                @php
                                    $subject = App\Subject::where('menu',1)->select('name','slug')->limit(12)->get();
                                @endphp

                                @for ($i = 0; $i <$subject->count(); $i++)
                                    <ul class="list-unstyled col-md-4">
                                        @for ($a = $i; $a <$i+4 ; $a++)
                                        @break($a==$subject->count())
                                            <li><a href="{{ route('subject_cat',$subject[$a]->slug) }}">{{$subject[$a]->name}}</a></li>
                                        @endfor
                                        @php
                                            $i=$a-1;
                                        @endphp
                                    </ul>
                                @endfor
                                
                            </div>
                            <h5 align="right"><a href="{{ route('subject') }}" class="btn btn-default btn-sm">আরো দেখুন</a></h5>
                        </div>

                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">লেখক <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>

                        <div class="container">
                            <div class="row">
                                @php
                                    $author = App\Author::where('menu',1)->select('name','slug')->limit(12)->get();
                                @endphp

                                @for ($i = 0; $i <$author->count(); $i++)
                                    <ul class="list-unstyled col-md-4">
                                        @for ($a = $i; $a <$i+4 ; $a++)
                                        @break($a==$author->count())
                                            <li><a href="{{ route('author_cat',$author[$a]->slug) }}">{{$author[$a]->name}}</a></li>
                                        @endfor
                                        @php
                                            $i=$a-1;
                                        @endphp
                                    </ul>
                                @endfor

                            </div>
                            <h5 align="right"><a href="{{ route('author') }}" class="btn btn-default btn-sm">আরো দেখুন</a></h5>
                        </div>

                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">প্রকাশনী <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>

                        <div class="container">
                            <div class="row">
                                @php
                                    $publisher = App\Publisher::where('menu',1)->select('name','slug')->limit(12)->get();
                                @endphp

                                @for ($i = 0; $i <$publisher->count(); $i++)
                                    <ul class="list-unstyled col-md-4">
                                        @for ($a = $i; $a <$i+4 ; $a++)
                                        @break($a==$publisher->count())
                                            <li><a href="{{ route('publisher_cat',$publisher[$a]->slug) }}">{{$publisher[$a]->name}}</a></li>
                                        @endfor
                                        @php
                                            $i=$a-1;
                                        @endphp
                                    </ul>
                                @endfor
                            </div>
                            <h5 align="right"><a href="{{ route('publisher') }}" class="btn btn-default btn-sm">আরো দেখুন</a></h5>
                        </div>

                    </li>
                </ul>
            </li>
            
            <li><a href="{{ route('cagegory','book-fair') }}">বইমেলা ২০২০</a></li>
            <li><a href="{{ route('cagegory','offer') }}">পেপার রাইম আকর্ষণী অফার</a></li>
            <li><a href="/subject/islami-book">ইসলামী বই</a></li>
            <li><a href="{{ route('cagegory','best-seller') }}">বেস্ট সেলার</a></li>
            <li><a href="{{ route('cagegory','new-published') }}">নতুন প্রকাশিত বই</a></li>
        </ul>

    </div>
</div>
<!--/.nav-collapse -->