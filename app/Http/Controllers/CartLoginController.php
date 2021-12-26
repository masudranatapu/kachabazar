<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartLoginController extends Controller
{
    public function index()
    {
        return view('customer.cart_login');
    }
    public function register()
    {
        return view('customer.cart_register');
    }
}
