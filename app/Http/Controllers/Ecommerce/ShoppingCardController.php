<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCardController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    public function update(Request $request)
    {
        $shoppingCard = ShoppingCart::getSessionShoppingCart();
        foreach ($shoppingCard->shopping_cart_details as $key => $detail) {
            $result[] = ['quantity' => $request->quantity[$key]];
            $detail->update($result[$key]);
        }

        return back();

    }

    public function destroy($id)
    {
        //
    }
}
