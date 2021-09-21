<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'sale_date',
        'impuesto',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
    public function scopeDetalle($query)
    {
        return $query->join('clients', 'clients.id', 'sales.client_id')
            ->join('users', 'users.id', 'sales.user_id');
    }
}
