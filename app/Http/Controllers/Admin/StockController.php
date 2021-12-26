<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Sold;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function sold_out()
    {
    	$solds = Sold::latest()->paginate(15);
    	$from = null;
    	$to = null;
    	$search = null;
    	$title = "Sold Out Books";
    	return view('admin.stock.sold',compact('solds','search','title','from','to'));
    }

    public function sold_search(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $search = $request->search;

        $query = Sold::query();
        if (isset($search)) {
            $query = $query->where('product_code','LIKE','%'.$search.'%');
            $query = $query->orWhere('order_code', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('title', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('eng', 'LIKE', '%'.$search.'%');
        }

        if ($from && $to) {
            $query = $query->whereBetween('created_at',[$from,$to]);
        }

        $query = $query->latest()->paginate(15);
        $query->withPath('?from='.$from.'&to='.$to.'&search='.$search);

        $solds = $query;

        $title = "Sold Out Books";
        return view('admin.stock.sold',compact('solds','search','title','from','to'));
    }

    public function stock_report()
    {
    	$products = Product::paginate(15);
    	$search = null;
    	return view('admin.stock.report',compact('products','search'));
    }

    public function stock_search(Request $request)
    {

        $search = $request->search;

        $query = Product::query();
        if (isset($search)) {
            $query = $query->where('product_code','LIKE','%'.$search.'%');
            $query = $query->orWhere('title', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('eng', 'LIKE', '%'.$search.'%');
        }

        $query = $query->latest()->paginate(15);
        $query->withPath('?search='.$search);

        $products = $query;

        return view('admin.stock.report',compact('products','search'));
    }
}
