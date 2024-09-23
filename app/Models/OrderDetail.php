<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $fillable = [
        'food_id',
        'order_id',
        'food_name',
        'quantity_sold',
        'sale_price',
        'discount_amount',
        'total_amount',
        'note',
        'is_prepared',
        'is_printed_to_kitchen',
        'preparation_time',
        'is_served',

    ];
}
