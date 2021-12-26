<form action="{{ route('filter') }}" method="get">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href=""> Category</a>
                </h4>
            </div>
            <div id="collapse1">
                <div class="panel-body">
                    <input type="hidden" name="cat" value="{{$cat->id}}">
                    @php
                        $categorys = App\Category::where('parent_id',$cat->id)->get();
                    @endphp

                    @foreach ($categorys as $category)
                        <div class="checkbox">
                            <label><input type="checkbox" name="category[]" value="{{$category->id}}" />{{$category->name}}</label>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href=""> Brand</a>
                </h4>
            </div>
            <div id="collapse1">
                <div class="panel-body">
                    @php
                        $brands = App\Brand::all();
                    @endphp
                    @foreach ($brands as $brand)
                        <div class="checkbox">
                            <label><input type="checkbox" name="brand[]" value="{{$brand->id}}" />{{$brand->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href=""> Price</a>
                </h4>
            </div>
            <div id="collapse3">
                <div class="panel-body">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="price" value="all-price"  checked>
                      <label class="form-check-label"> 
                        All
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="price" value="0-1000" >
                      <label class="form-check-label"> 
                        0-1000
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="price" value="1000-5000" >
                      <label class="form-check-label"> 
                        1000-5000
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="price" value="5000-10000" >
                      <label class="form-check-label"> 
                        5000-10000
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="price" value="10000-50000" >
                      <label class="form-check-label"> 
                        10000-50000
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="price" value="50000+" >
                      <label class="form-check-label"> 
                        50000+
                      </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-sm">Filter</button>
</form>
