<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Authenticatable
{
    use HasFactory;
    protected $table= "admins";
    protected $fillable=[
           'username',
            'email',
            'password',
        'role_id',

    ];
}
