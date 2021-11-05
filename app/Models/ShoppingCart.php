<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'order_date', 'user_id'];

    public function shopping_cart_details()
    {
        return $this->hasMany(ShoppingCartDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quantityProducts()
    {
        return $this->shopping_cart_details->sum('quantity');
    }

    public function totalPrice()
    {
        $total = 0;

        foreach ($this->shopping_cart_details as $key => $shopping_cart_detail) {
            $total += $shopping_cart_detail->price * $shopping_cart_detail->quantity;
        }

        return $total;
    }

    public static function  getSessionShoppingCart()
    {
        $sessionName = 'shopping_card_id';
        $shoppingCartId = Session::get($sessionName);
        $shoppingCart = self::findOrCreateBySession($shoppingCartId);

        return $shoppingCart;
    }

    public static function findOrCreateBySession($shopping_cart_id)
    {
        if ($shopping_cart_id) {
            return ShoppingCart::find($shopping_cart_id);
        } else {
            return ShoppingCart::create();
        }
    }
    public function createCart($product,$request)
    {
        $this->shopping_cart_details()->create([
            'product_id' => $product,
            'price' => $product->sell_price,
            'quantity' => $request->quantity
        ]);
    }
    public function createProduct($product)
    {
        $this->shopping_cart_details()->create([
            'product_id' => $product,
            'price' => $product->sell_price
        ]);
    }
}
