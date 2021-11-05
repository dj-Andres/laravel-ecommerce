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

    public function shop_grid()
    {
        $products = Product::where('status', 'ACTIVE')
            ->orderBy('id', 'desc')
            ->paginate(12)
            ->get();

        return view('web.shop_grid', compact('products'));
    }
    public function detailsProduct(Product $product)
    {
        return view('web.product_details',compact('product'));
    }
    public function cart()
    {
        return view('web.cart');
    }
}
