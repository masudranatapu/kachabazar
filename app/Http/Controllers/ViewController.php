<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Review;

class ViewController extends Controller
{
    public function product_details($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $reviews = Review::where('product_id', $product->id)->where('opinion', '!=', null)->latest()->get();
        $five_star = Review::where('product_id', $product->id)->where('rating', 5)->latest()->count();
        $four_star = Review::where('product_id', $product->id)->where('rating', 4)->latest()->count();
        $thr_star = Review::where('product_id', $product->id)->where('rating', 3)->latest()->count();
        $two_star = Review::where('product_id', $product->id)->where('rating', 2)->latest()->count();
        $one_star = Review::where('product_id', $product->id)->where('rating', 1)->latest()->count();
        $total = Review::where('product_id', $product->id)->sum('rating');

        return view('product_details', compact('product', 'reviews', 'five_star', 'four_star', 'thr_star', 'two_star', 'one_star', 'total'));
    }

    public function category($slug)
    {
        $cat = Category::where('slug', $slug)->select('id', 'name')->first();

        $title = $cat->name;

        if ($cat->parent_id) {
            return $this->get_product($cat, $title, $cat->id, $cat->parent_id);
        } else {
            return $this->get_product($cat, $title, $cat->id);
        }
    }

    private function get_product($cat, $title, $cat_id, $cat_parent_id = null)
    {
        if ($cat_parent_id) {
            $products = Product::where('category_id', $cat_id)->latest()->paginate(20);
        } else {
            $all_category = Category::where('id', $cat_id)->orwhere('parent_id', $cat_id)->select('id')->orderBy('order', 'ASC')->get();

            $products = Product::where(function ($q) use ($all_category) {
                foreach ($all_category as $category) {
                    $q->orWhere('category_id', $category->id);
                }
            })->latest()->paginate(9);
        }

        return view('product', compact('products', 'title', 'cat'));
    }
}
