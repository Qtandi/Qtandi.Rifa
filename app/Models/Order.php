<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Order
    protected $fillable = [
        'id',
        'order_id',
        'order_data'
    ];

    protected $hidden = [
        'order_id',
        'order_data'
    ];
}
