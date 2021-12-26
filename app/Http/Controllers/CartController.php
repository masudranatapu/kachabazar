<?php

namespace App\Http\Controllers;

use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CartController extends Controller
{
	public function cart()
	{
		// for header
		$title = 'Cart';
		return view('cart',compact('title'));
	}

    // for cart add_to_cart_with_size_color
    public function add_to_cart_with_quentity(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                    $product_id => [
                        "title" => $product->title,
                        "quantity" => $request->quantity,
                        "size_id" => $request->size_id,
                        "colour_id" => $request->colour_id,
                        "sell_price" => $product->sell_price,
                        "image" => $product->cover_photo
                    ]
            ];

            session()->put('cart', $cart);

            Toastr::success('Product added to cart successfully!','Success');
            return redirect()->back();
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product_id])) {

            // $cart[$product_id]['quantity']++;

            // session()->put('cart', $cart);

            Toastr::error('Product already added to cart!','Error');
            return redirect()->back();

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$product_id] = [
            "title" => $product->title,
            "quantity" => $request->quantity,
            "size_id" => $request->size_id,
            "colour_id" => $request->colour_id,
            "sell_price" => $product->sell_price,
            "image" => $product->cover_photo
        ];

        session()->put('cart', $cart);

        Toastr::success('Product added to cart successfully!','Success');
        return redirect()->back();
    }

    // for cart add_to_cart_with_size_color
    public function add_to_cart_with_size_color(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                    $product_id => [
                        "title" => $product->title,
                        "quantity" => 1,
                        "size_id" => $request->size_id,
                        "colour_id" => $request->colour_id,
                        "sell_price" => $product->sell_price,
                        "image" => $product->cover_photo
                    ]
            ];

            session()->put('cart', $cart);

            Toastr::success('Product added to cart successfully!','Success');
            return redirect()->back();
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product_id])) {

            $cart[$product_id]['quantity']++;

            session()->put('cart', $cart);

            Toastr::success('Product added to cart successfully!','Success');
            return redirect()->back();

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$product_id] = [
            "title" => $product->title,
            "quantity" => 1,
            "size_id" => $request->size_id,
            "colour_id" => $request->colour_id,
            "sell_price" => $product->sell_price,
            "image" => $product->cover_photo
        ];

        session()->put('cart', $cart);

        Toastr::success('Product added to cart successfully!','Success');
        return redirect()->back();
    }

     // for cart add_to_cart
	public function add_to_cart($product_id)
	{
		$product = Product::find($product_id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                    $product_id => [
                        "title" => $product->title,
                        "quantity" => 1,
                        "size_id" => null,
                        "colour_id" => null,
                        "sell_price" => $product->sell_price,
                        "image" => $product->cover_photo
                    ]
            ];

            session()->put('cart', $cart);

 			Toastr::success('Product added to cart successfully!','Success');
            return redirect()->back();
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product_id])) {

            $cart[$product_id]['quantity']++;

            session()->put('cart', $cart);

 			Toastr::success('Product added to cart successfully!','Success');
            return redirect()->back();

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$product_id] = [
            "title" => $product->title,
            "quantity" => 1,
            "size_id" => null,
            "colour_id" => null,
            "sell_price" => $product->sell_price,
            "image" => $product->cover_photo
        ];

        session()->put('cart', $cart);

 		Toastr::success('Product added to cart successfully!','Success');
        return redirect()->back();
	}

	public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            Toastr::success('Cart updated successfully!','Success');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            Toastr::success('Product added to cart successfully!','Success');
        }
    }


}
