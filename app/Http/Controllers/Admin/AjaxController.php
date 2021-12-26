<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Purchase;
use App\Sold;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    
    // for code. to product
    public function product_code_ajax_book(Request $request)
    {
        $product_code = $request->product_code;
        $product = Product::where('product_code',$product_code)->select('id','title','eng','product_code')->first();
        $purchase = Purchase::where('product_id',$product->id)->sum('quantity');
        $sold = Sold::where('product_id',$product->id)->sum('quantity');
        $stock = $purchase-$sold;

        $result = null;

        if (isset($product)) {
            $result .= '<input type="hidden" name="product_code" id="product_code" value="'.$product->product_code.'">';
            $result .= '<input type="hidden" name="product_id" id="product_id" value="'.$product->id.'">';
            $result .= '<input type="hidden" name="eng" id="eng" value="'.$product->eng.'">';
            $result .= '<div class="form-group row">
                            <div class="col-xs-3">
                              <label for="name">Name</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="text" name="title" readonly class="form-control"  value="'.$product->title.'">
                            </div>
                        </div>';

            $result .= '<div class="form-group row">
                            <div class="col-xs-3">
                              <label for="name">In Stock</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="text" readonly class="form-control"  value="'.$stock.'">
                            </div>
                        </div>';

        }else {
            $result .= '<div class="form-group row">
                            <label for="firstname" class="col-xs-3 col-form-label"></label>
                            <div class="col-xs-9">
                                <span style="color:red;">Sorry, No result found.</span>
                            </div>
                        </div>';                        
        }

        return $result;
    }
    





}
