<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Brand;
use App\Category;
use App\Contact_us;
use App\Policy;
use App\Product;
use App\Slider;
use App\Website;
use App\Services;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        $sliders = Slider::all();
        $menu_categories = Category::where('parent_id', null)->where('feature', 1)->orderBy('order', 'asc')->get();
        $categories = Category::where('feature', 1)->select('id','name', 'slug', 'image')->latest()->inRandomOrder()->orderBy('order', 'asc')->take(4)->get();
        $home_categories = Category::where('home', 1)->orderBy('order', 'asc')->get();
        $brands = Brand::where('feature', 1)->select('name', 'slug', 'image')->get();

        $feature_product = Product::where('product_type', 'Feature')->latest()->inRandomOrder()->limit(3)->get();

        $new_arrival = Product::where('product_type', 'New Arrival')->latest()->inRandomOrder()->get();
        $feature = Product::where('product_type', 'Feature')->latest()->inRandomOrder()->get();
        $tranding = Product::where('product_type', 'Tranding')->latest()->inRandomOrder()->get();
        $popular_product = Product::where('product_type', 'Popular Product')->latest()->inRandomOrder()->get();
        $best_selling = Product::where('product_type', 'Best Selling')->latest()->inRandomOrder()->get();


        $new_product = Product::where('product_type', 'New')->latest()->inRandomOrder()->limit(3)->get();
        $bestsell_product = Product::where('product_type', 'Best Seller')->latest()->inRandomOrder()->limit(3)->get();
        $trending_product = Product::where('product_type', 'Trending')->latest()->inRandomOrder()->limit(3)->get();
        $services = Services::where('status', 1)->latest()->get();

        return view('welcome', compact('services', 'new_arrival', 'feature', 'tranding', 'popular_product', 'best_selling','sliders', 'menu_categories', 'categories', 'bestsell_product', 'brands', 'home_categories', 'feature_product', 'new_product', 'bestsell_product', 'trending_product'));
    }
    public function BestSelling()
    {
        $title = "Best Selling Product";
        $best_selling = Product::where('product_type', 'Best Selling')->latest()->inRandomOrder()->get();
        return view('best_selling', compact('best_selling', 'title'));
    }
    public function NewArrival()
    {
        $title = "New Arrival Product";
        $new_arrival = Product::where('product_type', 'New Arrival')->latest()->inRandomOrder()->get();
        return view('new_arrival', compact('new_arrival', 'title'));
    }
    public function popularProdcut()
    {
        $title = "Popular Products";
        $popular_product = Product::where('product_type', 'Popular Product')->latest()->inRandomOrder()->get();
        return view('popular_product', compact('popular_product', 'title'));
    }
    public function FeatureProdcut()
    {
        $title = "Feature Products";
        $feature = Product::where('product_type', 'Feature')->latest()->inRandomOrder()->get();
        return view('feature', compact('feature', 'title'));
    }
    public function TrandingProdcut()
    {
        $title = "Tranding Products";
        $tranding = Product::where('product_type', 'Tranding')->latest()->inRandomOrder()->get();
        return view('trending_product', compact('tranding', 'title'));
    }
    public function all_category()
    {
        $title = 'Categories';
        $categorys = Category::select('name', 'slug', 'image')->orderBy('order', 'asc')->paginate(48);

        return view('all_category', compact('title', 'categorys'));
    }

    public function all_brand()
    {
        $title = 'Brands';
        $brands = Brand::select('name', 'slug', 'image')->paginate(48);

        return view('all_brand', compact('title', 'brands'));
    }

    public function brand($slug)
    {
        $brand = Brand::where('slug', $slug)->select('id', 'name')->first();

        $title = $brand->name;
        $products = Product::where('brand_id', $brand->id)->select('id', 'title', 'slug', 'sell_price', 'regular_price', 'cover_photo', 'discount', 'size_id', 'colour_id')->latest()->paginate(20);

        return view('brand_product', compact('title', 'products'));
    }

    public function product_type($slug)
    {
        $title = $slug;
        $products = Product::where('product_type', $slug)->select('id', 'title', 'slug', 'sell_price', 'regular_price', 'cover_photo', 'discount', 'size_id', 'colour_id')->latest()->paginate(20);

        return view('product_type', compact('title', 'products'));
    }

    public function blog()
    {
        $title = 'Blog';
        $blogs = Blog::select('title', 'slug', 'cover_photo', 'short_description', 'created_at')->paginate(20);

        return view('blog', compact('title', 'blogs'));
    }

    public function blog_details($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $title = $blog->title;

        return view('blog_details', compact('title', 'blog'));
    }

    public function policy($slug)
    {
        $policy = Policy::where('slug', $slug)->first();
        $title = $policy->name;

        return view('policy', compact('title', 'policy'));
    }

    // for contuct_us
    public function contuct_us()
    {
        $title = 'Contact us';

        $website = Website::get()->last();

        return view('contuct_us', compact('title', 'website'));
    }

    // for contuct_form
    public function contuct_form(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        $contact_us = new Contact_us();
        $contact_us->name = $request->name;
        $contact_us->phone = $request->phone;
        $contact_us->email = $request->email;
        $contact_us->message = $request->message;
        $contact_us->save();

        Toastr::success('Messege successfully send.', 'Success');

        return redirect()->back();
    }
    public function Price(Request $request)
    {
        $title = 'Price List For Product';
        $products = Product::whereBetween('sell_price',[$request->min_price, $request->max_price])->paginate(3);
        return view('price_product', compact('products', 'title'));
    }
    public function OurServices()
    {
        $services = Services::where('status', 1)->latest()->get();
        $title = "Our Services";
        return view('our_services', compact('services', 'title'));
    }
    public function servicesDetails($slug)
    {
        $name = Services::where('slug', $slug)->first();
        $title = $name->title;
        $services = Services::where('slug', $slug)->first();

        return view('services_details', compact('title', 'services'));
    }
}
