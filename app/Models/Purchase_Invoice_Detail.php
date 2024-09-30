<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Invoice_Detail extends Model
{
    use HasFactory;
    protected $table = "purchase__invoice__details";
    protected  $fillable = [
        'food_id',
        'food_name',
        'input_quantity',
        'import_price',
        'total_amount',
        'purchase_invoice_id',
        'note',
        'status',
    ];
}
