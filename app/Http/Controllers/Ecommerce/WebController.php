<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function about()
    {
        return view('web.about');
    }

    public function products()
    {
        $products = Product::where('status', 'ACTIVE')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('web.shop-grid', compact('products'));
    }
    public function detailsProduct(Product $product)
    {
        return view('web.product_details',compact('product'));
    }
    public function cart()
    {
        return view('web.cart');
    }
    public function checkout()
    {
        return view('web.checkout');
    }
    public function blog()
    {
        return view('web.blog');
    }
    public function contact()
    {
        return view('web.contact');
    }
    public function login_register()
    {
        return view('web.login_register');
    }
    public function account()
    {
        return view('web.account');
    }
    public function details()
    {
        return view('web.product_detail');
    }
    public function index()
    {
        return view('welcome');
    }
}
