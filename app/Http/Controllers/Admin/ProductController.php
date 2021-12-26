<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Colour;
use App\Http\Controllers\Controller;
use App\Product;
use App\Size;
use App\Unit;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(15);
        $search = null;

        return view('admin.product.index', compact('products', 'search'));
    }

    public function product_search(Request $request)
    {
        $search = $request->search;

        $query = Product::query();
        if (isset($search)) {
            $query = $query->where('product_code', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('title', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('eng', 'LIKE', '%'.$search.'%');
        }

        $query = $query->latest()->paginate(15);
        $query->withPath('?search='.$search);

        $products = $query;

        return view('admin.product.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $size = Size::where('status', 'Active')->get();
        $colour = Colour::where('status', 'Active')->get();
        $unit = Unit::where('status', 'Active')->get();

        return view('admin.product.create', compact('categorys', 'brands', 'size', 'colour', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:150',
            'eng' => 'nullable|max:200',
            'slug' => 'required|max:150|unique:products',
            'sell_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'regular_price' => 'nullable|numeric',
            'availability' => 'required',
            'product_type' => 'required',
            'status' => 'required',
            'cover_photo' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
        ]);

        // for cover photo
        $cover_photo = $request->file('cover_photo');
        $slug = $request->slug;
        if (isset($cover_photo)) {
            //make unique name for cover_photo
            $currentDate = Carbon::now()->toDateString();
            $cimagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$cover_photo->getClientOriginalExtension();

            $upload_path = 'assets/backend/img/product/';
            $image_url = $upload_path.$cimagename;
            $cover_photo->move($upload_path, $cimagename);
            $cimagename = $image_url;
        } else {
            $cimagename = 'default.png';
        }

        // others photo
        $images = $request->file('others_photo');
        if (isset($images)) {
            foreach ($images as $key => $image) {
                // make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $upload_path = 'assets/backend/img/product/';
                $image_url = $upload_path.$imagename;
                $image->move($upload_path, $imagename);
                $img_arr[$key] = $image_url;
            }

            $others_photo = trim(implode('|', $img_arr), '|');
        } else {
            $others_photo = null;
        }

        if ($request->size_id) {
            $size_id = trim(implode(',', $request->size_id), ',');
        } else {
            $size_id = null;
        }

        if ($request->colour_id) {
            $colour_id = trim(implode(',', $request->colour_id), ',');
        } else {
            $colour_id = null;
        }

        $last_ac = Product::select('id')->latest()->first();

        if (isset($last_ac)) {
            $code = 'P'.sprintf('%04d', $last_ac->id + 1);
        } else {
            $code = 'P'.sprintf('%04d', 1);
        }

        $product = new Product();
        $product->product_code = $code;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->title = $request->title;
        $product->eng = $request->eng;
        $product->slug = $request->slug;
        $product->sell_price = $request->sell_price;
        $product->discount = $request->discount;
        $product->regular_price = $request->regular_price;
        $product->long_description = $request->long_description;
        $product->availability = $request->availability;
        $product->meta_description = $request->meta_description;
        $product->meta_keyword = $request->meta_keyword;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->cover_photo = $cimagename;
        $product->others_photo = $others_photo;
        $product->user_id = Auth::user()->id;
        $product->save();

        Toastr::success('Product successfully upload.', 'Success');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categorys = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $size = Size::where('status', 'Active')->get();
        $colour = Colour::where('status', 'Active')->get();
        $unit = Unit::where('status', 'Active')->get();

        return view('admin.product.edit', compact('product', 'categorys', 'brands', 'size', 'colour','unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:150',
            'eng' => 'nullable|max:200',
            'slug' => 'required|max:150',
            'sell_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'regular_price' => 'nullable|numeric',
            'availability' => 'required',
            'product_type' => 'required',
            'status' => 'required',
            'cover_photo' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
        ]);

        // for cover photo
        $cover_photo = $request->file('cover_photo');
        $slug = $request->slug;
        if (isset($cover_photo)) {
            //make unique name for cover_photo
            $currentDate = Carbon::now()->toDateString();
            $cimagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$cover_photo->getClientOriginalExtension();
            //check product dir is exists
            // if (!Storage::disk('public')->exists('product')) {
            //     Storage::disk('public')->makeDirectory('product');
            // }

            //delete old cover_photo
            // if (Storage::disk('public')->exists('product/'.$product->cover_photo)) {
            //     Storage::disk('public')->delete('product/'.$product->cover_photo);
            // }

            // resize cover_photo for product and upload
            // $resize_image = Image::make($cover_photo)->resize(800, 800, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->stream();
            // Storage::disk('public')->put('product/'.$cimagename, $resize_image);
            if ($product->cover_photo) {
                  if(file_exists($product->cover_photo)){
                    unlink($product->cover_photo);
                  }
            }
            $upload_path = 'assets/backend/img/product/';
            $image_url = $upload_path.$cimagename;
            $cover_photo->move($upload_path, $cimagename);
            $cimagename = $image_url;
        } else {
            $cimagename = $product->cover_photo;
        }

        // others photo
        $images = $request->file('others_photo');
        if (isset($images)) {
            $post_image = explode('|', $product->others_photo);
            foreach ($post_image as $key => $image) {
                if ($key > 0) {
                  if(file_exists($image)){
                      unlink($image);
                  }
                }
            }

            foreach ($images as $key => $image) {
                // make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                $upload_path = 'assets/backend/img/product/';
                $image_url = $upload_path.$imagename;
                $image->move($upload_path, $imagename);
                $img_arr[$key] = $image_url;
            }

            $others_photo = trim(implode('|', $img_arr), '|');
        } else {
            $others_photo = $product->others_photo;
        }

        if ($request->size_id) {
            $size_id = trim(implode(',', $request->size_id), ',');
        } else {
            $size_id = null;
        }

        if ($request->colour_id) {
            $colour_id = trim(implode(',', $request->colour_id), ',');
        } else {
            $colour_id = null;
        }

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->title = $request->title;
        $product->eng = $request->eng;
        $product->slug = $request->slug;
        $product->sell_price = $request->sell_price;
        $product->discount = $request->discount;
        $product->regular_price = $request->regular_price;
        $product->long_description = $request->long_description;
        $product->availability = $request->availability;
        $product->meta_description = $request->meta_description;
        $product->meta_keyword = $request->meta_keyword;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->cover_photo = $cimagename;
        $product->others_photo = $others_photo;
        $product->save();

        Toastr::success('Product successfully update.', 'Success');

        return redirect()->back();
    }
}
