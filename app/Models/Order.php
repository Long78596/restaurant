<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'sales_invoice_code',
        'total_amount',
        'discount',
        'table_id',
        'customer_id',
        'status',
        'payment_type_id',
        'is_confirmed',
        'payment_date',

    ];
}
