<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartDetail extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','shopping_cart_id','price','quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getTotal()
    {
        return $this->quantity*$this->price;
    }
}
