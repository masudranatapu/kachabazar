<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // ajax product search
    public function ajax_search_to_product(Request $request)
    {
        if (!(empty($request->search))) {
            $result = null;
            
             $product = Product::where('title', 'LIKE', '%'.$request->search.'%')
                                     ->orWhere('eng', 'LIKE', '%'.$request->search.'%')
                                     ->latest()->get();
            if ($product->count()!=0) {
                $result.='<table class="table">';
                foreach ($product as $product) {
                 $image = 'storage/product/'.$product->cover_photo;
                    $result.='<tr style="cursor: pointer;" onclick="get_product_title(\'' .$product->title. '\')">
                                <td>
                                    <img src="'.asset($image).'" width="40xp" height="40xp" class="img-responsive"/>
                                </td>
                                <td>'.$product->title.'</td>
                             </tr>';
                }
                $result.='</table>';
            }

            return $result;
            
        }
        

    }

    public function search(Request $request)
    {
        $search = $request->search;
        $url = "search=".$search;

        $query = Product::query();
        if (isset($search)) {
            $query = $query->where('title', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('eng', 'LIKE', '%'.$search.'%');
        }
        $query = $query->select('id','title','slug','sell_price','regular_price','cover_photo','discount','size_id','colour_id')->latest()->paginate(20);
        $query->withPath('?'.$url);

        $products = $query;

        $title = $search;

        return view('search',compact('products','title'));

        
    }

    public function filter(Request $request)
    {
        // return $request;
        $fltr_cat = $request->cat;
        $fltr_category = $request->category;
        $fltr_brand = $request->brand;
        $fltr_price = $request->price;

        $path = null;
        $path .= "cat=".$fltr_cat;
        if (isset($fltr_category)) {
            foreach ($fltr_category as $url_id) {
                $path .= "&category%5B%5D=".$url_id;
            }
        }

        if (isset($fltr_brand)) {
            foreach ($fltr_brand as $url_id) {
                $path .= "&brand%5B%5D=".$url_id;
            }
        }

        if (isset($fltr_price)) {
            $path .= "&price=".$fltr_price;
        }
        
        $url = trim($path,'&');



        $query = Product::query();
        if (isset($fltr_category)) {
            $query = $query->where(function ($q) use ($fltr_category) {
                    foreach ($fltr_category as $id) {
                        $q->orWhere('category_id',$id);
                    }
                });
        }else {
            $all_category=Category::where('id',$fltr_cat)->orwhere('parent_id',$fltr_cat)->select('id')->orderBy('order','ASC')->get();

            $query = $query->where(function ($q) use ($all_category) {
                    foreach ($all_category as $category) {
                        $q->orWhere('category_id',$category->id);
                    }
                });
        }

        if (isset($fltr_brand)) {
            $query = $query->where(function ($q) use ($fltr_brand) {
                    foreach ($fltr_brand as $id) {
                        $q->orWhere('brand_id',$id);
                    }
                });
        }

        if (isset($fltr_price)) {
            if ($fltr_price!="all-price") {
                if ($fltr_price=="50000+") {
                    $query = $query->where('sell_price','>',50000);
                } else {
                    $price = explode("-",$fltr_price);
                    $min = (int)$price[0];
                    $max = (int)$price[1];
                    $query = $query->whereBetween('sell_price', [$min,$max]);
                }                
            }
        }

        $query = $query->latest()->paginate(20);
        $query->withPath('?'.$url);

        $products = $query;
        $title = "Filter";
        $cat = Category::find($fltr_cat);

        return view('filter',compact('products','title','cat','fltr_category','fltr_brand','fltr_price'));
    }

}
