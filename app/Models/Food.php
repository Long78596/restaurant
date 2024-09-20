<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = "Foods";
    protected $fillable= [
        "title",
        "image",
        "price",
        "status",
        "category_id"
    ];
}
