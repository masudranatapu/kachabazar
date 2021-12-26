<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Purchase;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Product;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::latest()->paginate(15);
        $from = null;
        $to = null;
        $search = null;
        $title = 'Purchase Product';
        
        $stock_product = Purchase::pluck('product_id')->toArray();
        $products = Product::whereNotIn('id',$stock_product)->get();
        return view('admin.stock.purchase', compact('products', 'purchases', 'search', 'title', 'from', 'to'));
    }

    public function purchase_search(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $search = $request->search;

        $query = Purchase::query();
        if (isset($search)) {
            $query = $query->where('product_code', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('title', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('eng', 'LIKE', '%'.$search.'%');
        }

        if ($from && $to) {
            $query = $query->whereBetween('created_at', [$from, $to]);
        }

        $query = $query->latest()->paginate(15);
        $query->withPath('?from='.$from.'&to='.$to.'&search='.$search);

        $purchases = $query;

        $title = 'Purchase Products';

        return view('admin.stock.purchase', compact('purchases', 'search', 'title', 'from', 'to'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|max:5',
            'title' => 'required|max:150',
            'eng' => 'nullable|max:200',
            'product_code' => 'required|max:12',
            'quantity' => 'required|max:12',
        ]);

        $purchase = new Purchase();
        $purchase->product_id = $request->product_id;
        $purchase->title = $request->title;
        $purchase->eng = $request->eng;
        $purchase->product_code = $request->product_code;
        $purchase->quantity = $request->quantity;
        $purchase->save();

        Toastr::success('Purchase successfully saved.', 'Success');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        
        $stock_product = Purchase::pluck('product_id')->toArray();
        $products = Product::whereNotIn('id',$stock_product)->get();

        return view('admin..stock.purchase_update', compact('purchase', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request, [
            'product_id' => 'required|max:5',
            'title' => 'required|max:150',
            'eng' => 'nullable|max:200',
            'product_code' => 'required|max:12',
            'quantity' => 'required|max:12',
        ]);

        $purchase->product_id = $request->product_id;
        $purchase->title = $request->title;
        $purchase->eng = $request->eng;
        $purchase->product_code = $request->product_code;
        $purchase->quantity = $request->quantity;
        $purchase->save();

        Toastr::success('Purchase successfully saved.', 'Success');

        return redirect()->back();
    }
}
