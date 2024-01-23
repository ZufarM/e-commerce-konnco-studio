<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'product_price',
        'qty',
        'user_id'
    ];

    protected $casts = [
        'id' => 'string'
    ];
}
