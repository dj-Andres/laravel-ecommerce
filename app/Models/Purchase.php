<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //use HasFactory;

    protected $fillable = [
        'provider_id',
        'user_id',
        'purchase_date',
        'impuesto',
        'total',
        'status',
        'picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function shoppingDatails()
    {
        return $this->hasMany(PurchaseDetails::class, 'pruchase_id');
    }
    public function scopeProviders($query)
    {
        return $query->join('providers', 'providers.id', 'purchases.provider_id');
    }
}
