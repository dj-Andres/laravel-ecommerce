<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use Illuminate\Http\Request;

class ShoppingCartDetailController extends Controller
{
    public function store(Request $request,Product $product)
    {
        $shoppingCart = ShoppingCart::getSessionShoppingCart();
        $shoppingCart->createCart($product,$request);

        return back();
    }

    public function storeProduct(Product $product)
    {
        $shoppingCart = ShoppingCart::getSessionShoppingCart();
        $shoppingCart->createProduct($product);
    }

    public function update(Request $request, ShoppingCartDetail $shoppingCartDetail)
    {
    }

    public function destroy(ShoppingCartDetail $shoppingCartDetail)
    {
    }
}
