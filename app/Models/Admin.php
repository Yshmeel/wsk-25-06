<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    use HasFactory;

    public $table = 'admin';
    public $timestamps = false;

    public $fillable = [
        'id',
        'username',
        'password'
    ];

    public $visible = [
        'username',
    ];
}
