<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table= "customers";
    protected $fillable=[
        'full_name',
        'middle_name',
        'first_name',
        'phone_number',
        'email',
        'note',
        'birth_date',
        'tax_code',
    ];
}
