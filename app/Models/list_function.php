<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_function extends Model
{
    use HasFactory;
    protected $table= "list_functions";
    protected $fillable=[
            "list_name",
    ];
}
