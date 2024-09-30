<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Invoices extends Model
{
    use HasFactory;
    protected $table = "purchase__invoices";
    protected  $fillable = [
        'supplier_id',
        'total_purchase_amount',
        'purchase_invoice_code',
        'purchase_date',
    ];
}
