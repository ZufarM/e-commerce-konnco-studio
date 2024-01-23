<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_id',
        'user_id',
        'delivery_address',
        'bank',
        'va_number',
        'sub_total',
        'delivery_fee',
        'total',
        'order_status',
        'payment_status'
    ];

    protected $casts = [
        'id' => 'string'
    ];
}
